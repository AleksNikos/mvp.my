<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 13.05.2019
 * Time: 5:04
 */

namespace app\models;


use function count;
use Yii;
use yii\base\Model;

class Cron extends Model
{
    /*
     * Обновляет статистику использованию ключей.
     * Запускать раз в день.
     *
     * Одна запись в бд - это статистика за один день конкретного пользователя.
     *
     * */
    public function updateTotalStatistics(){
        //Выбираем уникальные записи, чтобы не дергать всех имеющихся юзеров
       $users = UserAPIKeys::find()->select(['userID'])->distinct()->asArray()->all();
       $connector = new APIConnector(["typeClient"=>2]);
       foreach ($users as $user){
           $uid = UserAPIKeys::findOne(["userID"=> $user["userID"]]); //вытаскиваем uid

           //Вытаскиваем все ключи по uid
           $keys = APIKeys::find()->where(["userID"=>$uid->uid])->asArray()->all();
           //Составляем массив из id ключей для получения статистической информации
           $statArray = [];
           foreach ($keys as $key){
               $statArray[] = $key["key_id"];
           }
//           if($uid->uid==8){
//               $this->var_export($statArray);
//           }

           //Получаем статистику по ключам

           $keysInfo = $connector->keysInfo($statArray);
//            $this->var_export($keysInfo->getCalls());

           if($uid->uid==8){
               $this->var_export($keysInfo);
           }

           $total = 0;
            $calls = $keysInfo->getCalls();
//            $this->var_export($calls[0]->getForService());
           /*-----Это место заменить на конкретную статистику по Fd и Er ------------------------*/
           foreach ($calls as $count){
               $total = $total+$count->getTotal();
//               $this->var_export($count->getTotal());
           }
           /*-----Это место заменить на конкретную статистику по Fd и Er -------------------*/
//            $this->var_export($total);
           $currentUser = User::findOne(["id"=>$uid->userID]);
               //Создаем новую запись
               $totalStatisticsModel = new TotalStatistics();
               $totalStatisticsModel->fd_count = $total;
               $totalStatisticsModel->er_count = 0;
               $totalStatisticsModel->userID = $currentUser->id;
               $totalStatisticsModel->parentID = $currentUser->parent_unit_id;
               $totalStatisticsModel->date = time();

           $totalStatisticsModel->save(false);
       }
    }

    /*
     *  Запускает скрипт расчет по имеющимся данным
     *  Необходимо запускать раз в месяц
     *
     *  Повторный запуск приведет к перерасчету платежек.
     *  в следствии чего из оплаты выпадет столько дней насколько раньше был запущен скрипт
     * */
    public function startCalculation(){
        $currentTime = time();
        $currentDays = date("t"); //количество дней в текущем месяце.
        $moth = 24 * 60 * 60 * $currentDays; //месяц в unix; дни - последняя цифра 30

        //Вытаскиваем всех пользователей, которые с ключами
        $users = UserAPIKeys::find()->select(['userID'])->distinct()->asArray()->all();

        foreach ($users as $user){

            //вытаскиваем статистику по каждому пользователю
            $stats = TotalStatistics::find()->where([">","date",$currentTime-$moth])->andWhere(['userID'=>$user["userID"]])->asArray()->all();
            if(count($stats)!=0){
                //Производим расчет задолжности и создаем "платежку"
                $sumFd = 0;
                $sumEr = 0;
                foreach ($stats as $stat){
                    $sumFd = $sumFd + $stat["fd_count"];
                    $sumEr = $sumEr + $stat["er_count"];
                }

                $payment = new PaymentsInformation();
                $payment->er_count = $sumEr;
                $payment->fd_count = $sumFd;
                $payment->calculate();
                $payment->status = false;
                $payment->random_string = Yii::$app->security->generateRandomString(15);
                $payment->userID = $user["userID"];
                $payment->date=time();
                $parent = User::find()->select("parent_unit_id")->where(["id"=>$user["userID"]])->one();
                $payment->parentID = $parent->parent_unit_id;
                $payment->save(false);


            }
        }
//


    }

    /*
     * Списывает средства посредством Stripe
     * Выполнять после составления платежек, раз в месяц.
     * */
    public function startChange(){

        //Вытаскиваем всех пользователей у которых имеется непогашенная платежка.
        //у одного пользователя может быть 2 не оплаченные платежки
        // вызываются только те платежки у которых итоговая стоимость выше нуля
        $users = PaymentsInformation::find()->select(['userID'])->where(["status"=>false])->andWhere([">","total_price","0"])->distinct()->asArray()->all();

        foreach ($users as $user){
            $payment = PaymentsInformation::findOne(["userID"=>$user["userID"]]);
//            $this->var_export($payment->stripe);
            $stripe = new StripeSetChange();
            $change = $stripe->createCharge($payment->total_price."00",$payment->stripe->stripeID);
            if($change->status == "succeeded"){
                $payment->status = true;
                $payment->save(false);
            }
        }

    }
}
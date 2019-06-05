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
     * ��������� ���������� ������������� ������.
     * ��������� ��� � ����.
     *
     * ���� ������ � �� - ��� ���������� �� ���� ���� ����������� ������������.
     *
     * */
    public function updateTotalStatistics(){
        //�������� ���������� ������, ����� �� ������� ���� ��������� ������
       $users = UserAPIKeys::find()->select(['userID'])->distinct()->asArray()->all();
       $connector = new APIConnector(["typeClient"=>2]);
       foreach ($users as $user){
           $uid = UserAPIKeys::findOne(["userID"=> $user["userID"]]); //����������� uid

           //����������� ��� ����� �� uid
           $keys = APIKeys::find()->where(["userID"=>$uid->uid])->asArray()->all();
           //���������� ������ �� id ������ ��� ��������� �������������� ����������
           $statArray = [];
           foreach ($keys as $key){
               $statArray[] = $key["key_id"];
           }
//           if($uid->uid==8){
//               $this->var_export($statArray);
//           }

           //�������� ���������� �� ������

           $keysInfo = $connector->keysInfo($statArray);
//            $this->var_export($keysInfo->getCalls());

           if($uid->uid==8){
               $this->var_export($keysInfo);
           }

           $total = 0;
            $calls = $keysInfo->getCalls();
//            $this->var_export($calls[0]->getForService());
           /*-----��� ����� �������� �� ���������� ���������� �� Fd � Er ------------------------*/
           foreach ($calls as $count){
               $total = $total+$count->getTotal();
//               $this->var_export($count->getTotal());
           }
           /*-----��� ����� �������� �� ���������� ���������� �� Fd � Er -------------------*/
//            $this->var_export($total);
           $currentUser = User::findOne(["id"=>$uid->userID]);
               //������� ����� ������
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
     *  ��������� ������ ������ �� ��������� ������
     *  ���������� ��������� ��� � �����
     *
     *  ��������� ������ �������� � ����������� ��������.
     *  � ��������� ���� �� ������ ������� ������� ���� ��������� ������ ��� ������� ������
     * */
    public function startCalculation(){
        $currentTime = time();
        $currentDays = date("t"); //���������� ���� � ������� ������.
        $moth = 24 * 60 * 60 * $currentDays; //����� � unix; ��� - ��������� ����� 30

        //����������� ���� �������������, ������� � �������
        $users = UserAPIKeys::find()->select(['userID'])->distinct()->asArray()->all();

        foreach ($users as $user){

            //����������� ���������� �� ������� ������������
            $stats = TotalStatistics::find()->where([">","date",$currentTime-$moth])->andWhere(['userID'=>$user["userID"]])->asArray()->all();
            if(count($stats)!=0){
                //���������� ������ ����������� � ������� "��������"
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
     * ��������� �������� ����������� Stripe
     * ��������� ����� ����������� ��������, ��� � �����.
     * */
    public function startChange(){

        //����������� ���� ������������� � ������� ������� ������������ ��������.
        //� ������ ������������ ����� ���� 2 �� ���������� ��������
        // ���������� ������ �� �������� � ������� �������� ��������� ���� ����
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
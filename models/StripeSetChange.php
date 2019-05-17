<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 29.04.2019
 * Time: 23:19
 */

namespace app\models;


use Stripe\AccountTest;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Token;
use function var_export;
use Yii;
use yii\base\Model;

class StripeSetChange
{
    public $custormer;

    /*
     * При каждом запуске объекта подключаем библеотеку.
     * */
    public function __construct()
    {
        require_once(Yii::getAlias("@vendor/").'stripe/stripe-php/init.php');
        Stripe::setApiKey("sk_test_WvgbVGZc4qHh5lF78vUWfB9Z00ZtIRxK38");
    }

    public function createCustomer($id=null)
    {

        return Customer::create([
            "description" => "Customer for jenny.rosen@example.com",
            "source" => $id // obtained with Stripe.js
        ]);
    }

    public function createCard ($customerID=null){
        return
            $token = Token::create(
            array("card" => array(
                "number" => "4242424202424242",
                "exp_month" => 5,
                "exp_year" => date('Y') + 3,
                "cvc" => "314"
            ))
        );


    }

    public function cardInfo ($customerID) {
        $updatedCustomer = Customer::retrieve($customerID);
        $updatedCards = $updatedCustomer->sources->all();
        return $updatedCards;
    }


    /*
     * формирует объект списания средств.
     *
     * */
    public function createCharge($amount,$cus){
        $charge = Charge::create([
            "amount"=>$amount,
            "currency" => "usd",
            "description" => "Payment for using nlab service Nlab",
//            "balance_transaction"=>"txn_19XJJ02eZvKYlo2ClwuJ1rbA", //тестовое значение
//            "source"=>$cardID,
            "customer"=>$cus

        ]);

        return $charge;

    }
}
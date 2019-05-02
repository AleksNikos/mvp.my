<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 30.04.2019
 * Time: 21:19
 */

namespace app\models;


use function json_decode;
use PayPal\Api\CreditCard;
use PayPal\Api\WebProfile;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use function var_export;
use Yii;
use yii\httpclient\Exception;

class myPaypal2
{

    /*Входные параметры*/
    public $cardNumber;
    public $moth;
    public $year;
    public $cvc;

    /*Генерируемые параметры*/
    public $apiContext;

    public function var_export($var){
        echo "<pre>";
        var_export($var);
        echo "</pre>";
        die;
    }

    public function __construct()
    {
        $apiContext = new ApiContext( new OAuthTokenCredential(
            'ARSw9oNhK4DvRVEAXRGAS-NT0z6gDnL3pCTDZq_lgrEFTbfEq87U27C_WwOsQHM7Ia4JJwDZ9c0CYPyV',     // ClientID
            'EGRYJaVvZ_rhfl8kBjRjs8tErpJiewwpK4zHuITt49Nf652I7ZUNAoonT8-4EBgIs3dZ55T6VS0xOGhh'      // ClientSecret
        ));
        $apiContext->setConfig(array('mode' => 'sandbox',));
        $this->apiContext = $apiContext;

        $this->demo($apiContext);

//        try {
//            $card= CreditCard::get("CARD-9PV162078A5159229LTEN3YI",$apiContext);
//        } catch (PayPalConnectionException $ex) {
//            echo $ex->getCode(); // Prints the Error Code
//            $data = json_decode($ex->getData());
//            echo "<pre>";
//            var_export($data->message);
////            echo $ex->getData(); // Prints the detailed error message
//            die($ex);
//        } catch (Exception $ex) {
//            die($ex);
//        }
//
//
////        $card->create($apiContext);
//        $this->var_export($card);
//        $this->var_export($apiContext->getConfig());
////        $this->demo($apiContext);
    }

    public static function getJson()
    {
        return '{"number":"4111111111111111","type":"visa","expire_month":12,"expire_year":2020,"cvv2":"123","first_name":"TestSample","last_name":"TestSample","external_customer_id":"TestSample"}';
    }

    public function demo(ApiContext $apiContext) {
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal('1.00');
        $amount->setCurrency('USD');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl("https://example.com/your_redirect_url.html")
            ->setCancelUrl("https://example.com/your_cancel_url.html");

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        try {
            $payment->create($apiContext);
//            $this->var_export($apiContext);
            echo $payment;

            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }
    function getCardType($number){
        $types = [
            'electron' => '/^(4026|417500|4405|4508|4844|4913|4917)/',
            'interpayment' => '/^636/',
            'unionpay' => '/^(62|88)/',
            'discover' => '/^6(?:011|4|5)/',
            'maestro' => '/^(50|5[6-9]|6)/',
            'visa' => '/^4/',
            'mastercard' => '/^(5[1-5]|(?:222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720))/', // [2221-2720]
            'amex' => '/^3[47]/',
            'diners' => '/^3(?:0([0-5]|95)|[689])/',
            'jcb' => '/^(?:2131|1800|(?:352[89]|35[3-8][0-9]))/', // 3528-3589
            'mir' => '/^220[0-4]/',
        ];
        foreach($types as $type => $regexp){
            if( preg_match($regexp, $number) ){
                return $type;
            }
        }

        return 'undefined';
    }

    /*
     * Создает новую связь юзер - карта
     * */
    public function createNewConnect () {

        $type = $this->getCardType($this->cardNumber);
        $paypalID = Yii::$app->security->generateRandomString();
        $jsonCard = $this->getJsonCardData($type,$paypalID, $this->cardNumber, $this->moth,$this->year,$this->cvc, $paypalID);
        $card = $this->createCreditCard($jsonCard);

        /*заполняем модель недостоющими данными*/



    }

    /*
     * Получаем данные карты в формате json
     * */
    public function getJsonCardData($type,$number, $expireM, $expireY, $cvc, $customerID)
    {
        return '{"number":"'.$number.'","type":"'.$type.'","expire_month":'.$expireM.',"expire_year":'.$expireY.',"cvv2":"'.$cvc.'","first_name":"TestSample","last_name":"TestSample","external_customer_id":"'.$customerID.'"}';
    }

    public function createCreditCard ($jsonCard) {
        $card= new CreditCard($jsonCard);
        try {
            $card->create($this->apiContext);
        } catch (PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            $data = json_decode($ex->getData());
            echo "<pre>";
            var_export($data);
//            echo $ex->getData(); // Prints the detailed error message
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
        return $card;
    }
}
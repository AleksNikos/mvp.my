<?php

namespace app\models;

use Exception;
use PayPal\Api\CreditCard;
use PayPal\Api\Payer;
use PayPal\Api\WebProfile;
use PayPal\Exception\PayPalConnectionException;

use function substr;
use Yii;

/**
 * This is the model class for table "paypal".
 *
 * @property int $id
 * @property int $userID
 * @property string $paypalID
 * @property string $cardID
 * @property int $lastNumbers
 */
class myPaypal extends \yii\db\ActiveRecord
{
    /*Входные параметры*/
    public $cardNumber;
    public $moth;
    public $year;
    public $cvc;

    /*Генерируемые параметры*/
    public $apiContext;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paypal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'paypalID', 'cardID', 'lastNumbers'], 'required'],
            [['userID', 'lastNumbers'], 'integer'],
            [['paypalID', 'cardID'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userID' => 'User ID',
            'paypalID' => 'Paypal ID',
            'cardID' => 'Card ID',
            'lastNumbers' => 'Last Numbers',
        ];
    }

    /*
    * Создает новую связь юзер - карта
    * */
    public function createNewConnect()
    {

        /*передаем данные кредитной карты в payPal*/
        $type = $this->getCardType($this->cardNumber);


        $paypalID = Yii::$app->security->generateRandomString();
        $jsonCard = $this->getJsonCardData($type, $this->cardNumber, $this->moth, $this->year, $this->cvc);
//        $this->var_export($jsonCard);
        $card = $this->createCreditCard($jsonCard);

        /*заполняем модель недостоющими данными*/
        $this->cardID = $card->id; // обработать ошибку создания карты
        $this->lastNumbers = substr($this->lastNumbers, -4);
        $this->userID = Yii::$app->user->getId();
        $this->paypalID = $paypalID;


    }

    /*
     * Сохраняет данные карты на стороне payPal
     * */
    public function createCreditCard($jsonCard)
    {

        $card = new CreditCard($jsonCard);
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

    /*
    * Генерируем данные карты в формате json
    * */
    public function getJsonCardData($type, $number, $expireM, $expireY, $cvc)
    {
        return '{"number":"' . $number . '","type":"' . $type . '","expire_month":' . (int)$expireM . ',"expire_year":' . $expireY . ',"cvv2":"' . $cvc . '","first_name":"TestSample","last_name":"TestSample","external_customer_id":"TestSample"}';
    }

    /*Получает тип карты по первым цифрам номера карты
    * @param int $number - номер карты
     * @return string $type - тип карты в случае успеха (electron|interpayment|unionpay|discover|maestro|visa|mastercard|amex|diners|jcb|mir)
     * "undefined" - если не удалось определить тип карты.
    */
    function getCardType($number)
    {
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
        foreach ($types as $type => $regexp) {
            if (preg_match($regexp, $number)) {
                return $type;
            }
        }

        return 'undefined';
    }

    public function createWebProfile(){
        $webProfile = new WebProfile();
// Name of the web experience profile. Required. Must be unique
        $webProfile->setName("YeowZa! T-Shirt Shop" . uniqid());
        try {
            $webProfile->create($this->apiContext);
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
        return $webProfile;
    }
}

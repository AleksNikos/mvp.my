<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $purpose
 * @property string $country
 * @property string $city
 * @property int $user_type
 * @property string $access_token
 * @property string $name_organization
 * @property string $position
 * @property int $REQUESTED_FREE
 * @property string $FREE_STATUS
 * @property string $email_confirm_token
 * @property int $IS_ACTIVATED
 * @property int $IS_DEFAULT
 * @property int register_date
 * @property int last_visit
 * @property int update_at
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    const STATUS_WAIT = 5;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(["id"=>$id]);
    }

    /*
     * Àâòîğèçóåò ïîëüçîâàòåëÿ
     *
     * */
    public function login() {

        if(Yii::$app->user->login($this)){
            $this->last_visit = time();
            $this->save(false)  ;
            return true;
        }else{
            return false;
        }
    }

    /*
     *
     * */
    public function sendConfirmEmail(){
        Yii::$app->mailer->compose("confirm-email",["user"=>$this])
            ->setFrom('from@domain.com')
            ->setTo($this->email)
            ->setSubject('Confirm your password')
            ->send();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       //
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /*
     * Ãåíåğèğóåò õåø ïàğîëÿ
     *
     * @param string $password - ñòğîêà ñ íå õåøèğîâàííûì ïàğîëåì
     * @return string password_hash - õåø ïàğîëÿ
     * */
    public function generatePasswordHash ($password) {
        return Yii::$app->security->generatePasswordHash($password);
    }

    /*
     * Ãåíåğèğóåò êëş÷ àâòîğèçàöèè
     *
     * @return string access_token - ñãåíåğèğîâàííûé òîêåí.
     * */
    public function generateAccessToken() {
        return Yii::$app->security->generateRandomString();
    }

    /*
     * Ïîëó÷àåò êëş÷è êîòîğûå ïğèíàäëåæàò îäíîìó ïîëüçîâàòåëş
     *
     * */
    public function getKeys () {
        return $this->hasMany(Keys::className(),["user_id"=>"id"]);
    }


}

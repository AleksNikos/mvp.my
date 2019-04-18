<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
     * Авторизует пользователя
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
     * Генерирует хеш пароля
     *
     * @param string $password - строка с не хешированным паролем
     * @return string password_hash - хеш пароля
     * */
    public function generatePasswordHash ($password) {
        return Yii::$app->security->generatePasswordHash($password);
    }

    /*
     * Генерирует ключ авторизации
     *
     * @return string access_token - сгенерированный токен.
     * */
    public function generateAccessToken() {
        return Yii::$app->security->generateRandomString();
    }
}

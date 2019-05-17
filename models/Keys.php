<?php

namespace app\models;

use function count;
use function file_exists;
use Yii;
use ZipArchive;


/**
 * This is the model class for table "keys".
 *
 * @property int $id
 * @property int $created
 * @property int $updated
 * @property int $value //системное имя (индефикатор по которому выдаются ключи).
 * @property boolean $Fd
 * @property boolean $Er
 * @property int $user_id
 * @property string $name_key
 * @property int $IS_ACTIVATED
 * @property int $isDefault
 * @property int $disabled_by_user //указывает отключен ли ключ пользователем
 */
class Keys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'updated', 'user_id', 'IS_ACTIVATED'], 'integer'],
            [['value', 'user_id', 'name_key'], 'required'],
            [['Fd', 'Er'], 'boolean'],
            [['Fd', 'Er'], 'OneOrTwo',  'skipOnEmpty' => false],
            [['name_key','value',] , 'string'],
            ['name_key', 'nameValidation',  'skipOnEmpty' => false],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'value' => 'Value',
            'user_id' => 'User ID',
            'IS_ACTIVATED' => 'Is Activated',
        ];
    }

     /*
      * проводит комплекс действий по созданию ключа
      * @return boolean - результат валидации модели, если модель валидируется верно то она заполненна, и можно сохранять ключ в базе.
      * */
    public function createKey(){
        //создаем ключ на стороне API
        $user = User::find()->where(["id"=>Yii::$app->user->getId()])->one();
        $connector = new APIConnector(["typeClient"=>1]);
        $typeKeys = [];
        if($this->Fd==1 and $user->FdChecker==1){
            $typeKeys[] = 2;
        }else{
            $this->Fd=0;
        }
        if($this->Er == 1 and $user->ErChecker==1){
            $typeKeys [] = 4;
        }else{
            $this->Er=0;
        }

        if(count($typeKeys)===0){
            $arr = "array";
            return $arr;
        }

        $this->value = $connector->generateKey($user,$typeKeys);; //создает ключ в API

        //Вставляем недостающие поля
        $this->created = time();
        $this->updated = time();
        $this->user_id = Yii::$app->user->getId();
        $this->IS_ACTIVATED = 1;
        $this->isDefault = 0;
        if($this->validate()){
            if($this->validateFile() /*Если создалось 4 файл то команда с API прошла успешно*/){
                return true;
            }else{
                return "file";
            }

        }else{
            return "model";
        }
    }

    public function updateKey(){
        $user = Yii::$app->user->identity;
        $connector = new APIConnector(["typeClient"=>1]);
        $this->value= $connector->updateToken($user,$this);
        $this->updated = time();
        if($this->validateFile() /*Если создалось 4 файл то команда с API прошла успешно*/){
            return true;
        }else{
            return false;
        }


    }

    /*
     * Останавливает ключ
     *
     * @return boolean true - в случае успеха; false - в случае ошибки
     * */
    public function stopKey(){
        $connector = new APIConnector(["typeClient"=>1]);
        $this->IS_ACTIVATED = false;
        return $connector->stopToken($this);
    }

    /*Проводит валидацию созданных файлов*/
    public function validateFile(){
        if(
            file_exists(Yii::getAlias("@app/proto/tokens/root_".$this->value.".json"))
        and file_exists(Yii::getAlias("@app/proto/tokens/ca_".$this->value.".crt"))
        and file_exists(Yii::getAlias("@app/proto/tokens/client_".$this->value.".key"))
        and file_exists(Yii::getAlias("@app/proto/tokens/client_".$this->value.".crt"))
        ){
            return true;
        }else{
            return false;
        }
    }

    public function OneOrTwo($attribute, $params) {
        if(empty($this->Fd) and empty($this->Er)){
            $this->addError("ss", "Need selected one out of two types keys. Error field ".$attribute);
            return false;
        }else{
            return true;
        }
    }

    public function nameValidation($attribute) {
        if(static::find()->where(["name_key"=>$this->name_key])->andWhere(["user_id"=>Yii::$app->user->getId()])->exists()){
            $this->addError("name_key", "Key name alredy used");
            return false;
        }else{
            return true;
        }
    }

    /*
     * Генерирует архив с ключами для передачи его пользователю.
     * */
    public function generateZipArchive($value) {
        $zip = new ZipArchive();

        $files[] = [
            "local"=>"root_".$value.".json",
            "path"=>Yii::getAlias("@app/proto/tokens/root_$value.json")
        ];

        $files[] = [
            "path"=>Yii::getAlias("@app/proto/tokens/ca_$value.crt"),
            "local"=>"ca_$value.crt",
        ];

        $files[] = [
            "path"=>Yii::getAlias("@app/proto/tokens/client_$value.key"),
            "local"=>"client_$value.key",
        ];

        $files[] = [
            "path"=>Yii::getAlias("@app/proto/tokens/client_$value.crt"),
            "local"=>"client_$value.crt",
        ];

        /*Генерируем новый архив при каждой передаче ключей*/
        if(file_exists(Yii::getAlias("@app/proto/zips/$value.zip"))){
            unlink(Yii::getAlias("@app/proto/zips/$value.zip"));
        }

        if ($zip->open(Yii::getAlias("@app/proto/zips/$value.zip"), ZipArchive::CREATE) !== TRUE) {
            throw new \Exception('Cannot create a zip file');
        }
        foreach($files as $file){
//                $this->var_export($file);
            if(!file_exists($file["path"])){
                return false;
            }
            $zip->addFile($file["path"],$file["local"]);
        }

        $zip->close();
        return Yii::getAlias("@app/proto/zips/$value.zip");

    }

    public function getApiToken(){
        return $this->hasOne(APIKeys::className(),["systemID"=>"value"]);
    }

}

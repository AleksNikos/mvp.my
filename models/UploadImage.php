<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 26.04.2019
 * Time: 19:39
 */

namespace app\models;


use function file_exists;
use function mb_strtolower;
use function md5;
use function unlink;
use function var_export;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class UploadImage extends Model
{
    public $image;
    public $current_image;

    public function rules() {
       return [
//           [['image'],'required','message'=>''],
//           [['image'], 'each', 'rule' => ['file', 'extensions' => 'png, jpg, jpeg, gif']],
           [['image'],'file','skipOnEmpty'=>true,'extensions'=>'png, jpg, jpeg, gif']
       ];
    }

    public function upload(UploadedFile $file){
       if($this->validate()){
           $this->currentImage();//получили текущее значение изображения.

           $user = Yii::$app->user->identity;
           /*Удаляем старый файл если имеется*/
           $path = $this->getPath($user->image);
           if($this->current_image and file_exists($path)){
               unlink($path);
           }

           /*создаем новое имя файлу*/
           $file->name = mb_strtolower(md5(Yii::$app->security->generateRandomString())).".".$file->extension;

           $file->saveAs($this->getPath($file->name), true);
           $user->setImage($file->name);
           return $file->name;
       }
    }

    public function currentImage() {
        $user = Yii::$app->user->identity;
        if($user->image){
            $this->current_image = $user->image;
        }else{
            $this->current_image = null;
        }
    }
    public function getPath ($file_name){
        return Yii::getAlias("@web"). 'usersImage/'. $file_name;
    }




}
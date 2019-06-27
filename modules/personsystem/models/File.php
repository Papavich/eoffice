<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/25/2017
 * Time: 7:52 PM
 */

namespace app\modules\personsystem\models;


use Yii;
use yii\web\UploadedFile;
use yii\base\Model;

class File extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'],'required'],
            [['file'],'file','extensions'=>'xlsx','maxSize'=>1024 * 1024 * 5],
        ];
    }

    public function attributeLabels(){
        return [
            'file'=>'Select File',
        ];
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 5/4/2561
 * Time: 21:37
 */

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class File extends Model
{
    /**
     * @var UploadedFile
     */
    public $uploadPath = 'web_scb/uploads/import';

    public $file;

    public function rules()
    {
        return [
            [['file'],'required'],
            [['file'],'file','extensions'=>'xls,xlsx','maxSize'=>1024 * 1024 * 5],
        ];
    }

    public function attributeLabels(){
        return [
            'file'=>'Select File',
        ];
    }

}
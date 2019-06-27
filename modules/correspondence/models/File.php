<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 9/27/2017
 * Time: 10:28 PM
 */

namespace app\modules\correspondence\models;


use yii\base\Model;
use yii\web\UploadedFile;

class File extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 4],
        ];
    }

}
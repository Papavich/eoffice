<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 9/27/2017
 * Time: 10:28 PM
 */

namespace app\modules\scholar_b\models;


use yii\base\Model;
use yii\web\UploadedFile;

class FileUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $news_image;

    public function rules()
    {
        return [
            [['news_image'], 'file', 'skipOnEmpty' => false],
        ];
    }

}
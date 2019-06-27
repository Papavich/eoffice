<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 28/2/2561
 * Time: 19:17
 */

namespace app\modules\scholar_b\models;
use yii\base\Model;
use yii\web\UploadedFile;

class ScbFile extends Model
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
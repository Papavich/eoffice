<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 3/2/2561
 * Time: 14:13
 */

namespace app\modules\pms\models;
use Yii;

class File extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 10],
        ];
    }
}
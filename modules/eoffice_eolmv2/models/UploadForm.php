<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 1/5/2561
 * Time: 14:36
 */

namespace app\modules\eoffice_eolmv2\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['file'], 'file'/*, 'skipOnEmpty' => false, 'extensions' => 'png, jpg'*/],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}
<?php
namespace app\modules\eoffice_materialsys\models;

use yii\base\Model;
use yii\web\UploadedFile;

class Uploadxml extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('../web/web_material/xml/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
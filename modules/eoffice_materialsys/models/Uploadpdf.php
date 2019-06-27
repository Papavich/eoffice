<?php
namespace app\modules\eoffice_materialsys\models;

use Yii;


class Uploadpdf extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $pdfFile;

    public function rules()
    {
        return [
            [['pdfFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->pdfFile->saveAs(Yii::$app->homeUrl.'/web_mat/pdf/' . $this->pdfFile->baseName . '.' . $this->pdfFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use \yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_documents".
 *
 * @property int $ta_documents_id
 * @property string $ta_documents_name
 * @property string $ta_doc_detail
 * @property string $ta_documents_path
 * @property string $ta_doc_status
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaNews[] $taNews
 */
class TaDocuments extends \yii\db\ActiveRecord
{
    public $upload_folder ='files';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_documents';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['ta_doc_detail'], 'required'],  ต้องไม่ว่าง
            [['ta_doc_status'], 'string'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_documents_name'], 'string', 'max' => 100],
            [['ta_doc_detail'], 'string', 'max' => 500],
            //[['ta_documents_path'], 'string', 'max' => 200],
            ['ta_documents_path', 'file', 'maxSize' => 1024 * 1024 * 70, 'extensions' => ['docx',
                'doc', 'xls','xlsx','png','jpg',
                'pdf','ppt','pptx','zip'],'checkExtensionByMimeType'=>false],
         /*   [['ta_documents_path'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'pdf,doc,docx,zip,ppt,pptx,csv,xls,xlw,rar,xlsx'
                ]*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_documents_id' => controllers::t('label','Document ID'),
            'ta_documents_name' => controllers::t('label','Document Name'),
            'ta_doc_detail' =>  controllers::t('label','Detail'),
            'ta_documents_path' => controllers::t('label','Document Path'),
            'ta_doc_status' => controllers::t('label','Status'),
            'crby' => controllers::t('label','Create Time'),
            'crtime' => controllers::t('label','Create By'),
            'udby' => controllers::t('label','Update By'),
            'udtime' => controllers::t('label','Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaNews()
    {
        return $this->hasMany(TaNews::className(), ['ta_documents_id' => 'ta_documents_id']);
    }
    //------------------------------------ FUNCTION UPLOAD ONE ----------------------------------

    public function uploadFile()
    {
        if ($this->validate()) {
            Yii::$app->session->setFlash('danger', '1');
            if ($this->file) {
                if ($this->isNewRecord) {//ถ้าเป็นการเพิ่มใหม่ ให้ตั้งชื่อไฟล์ใหม่
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 10) .date('YmdHi'). '.' . $this->file->extension;//เลือกมา 15 อักษร .นามสกุล
                } else {//ถ้าเป็นการ update ให้ใช้ชื่อเดิม
//                    $fileName = $this->getOldAttribute('file');
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 10) .date('YmdHi'). '.' . $this->file->extension;//เลือกมา 15 อักษร .นามสกุล
                    if(!is_dir(Yii::getAlias('@webroot').'/' .self::UPLOAD_FOLDER . '/'  .$this->getOldAttribute('file'))&&file_exists(Yii::getAlias('@webroot').'/' .self::UPLOAD_FOLDER . '/'  .$this->getOldAttribute('file'))){
                        unlink(Yii::getAlias('@webroot').'/' .self::UPLOAD_FOLDER . '/'  .$this->getOldAttribute('file')); //ลบไฟล์ออก
                    }
                }
                $this->file->saveAs(Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/' . $fileName);
                return $fileName;
            }//end file upload
        }else{
            $errors = $this->getErrors();
            var_dump($errors); //or print_r($errors)
            exit;
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('file'); //ถ้าไม่มีการ upload ให้ใช้ข้อมูลเดิม
    }


    public function upload($model,$attribute)
    {
        $file  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $file !== null) {

           // $fileName = md5($file->baseName.time()) . '.' . $file->extension;
            $fileName = $file->baseName . '.' . $file->extension;
            if($file->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_ta/'.$this->upload_folder.'/';
    }

    public function getUploadUrl(){
        return Yii::getAlias('@web').'/web_ta/'.$this->upload_folder.'/';
    }

    public function getPhotoViewer(){
        $file = Yii::getAlias('@web').'/web_ta/images/img/file-text-icon.png';
        $none = Yii::getAlias('@web').'/web_ta/images/img/file.png';
        return empty($this->ta_documents_path) ? $none : $file;
    }
}

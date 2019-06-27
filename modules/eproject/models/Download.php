<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "epro_download".
 *
 * @property integer $id
 * @property string $title
 * @property string $path
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 */
class Download extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    const UPLOAD_FOLDER  = 'web_eproject/uploads/downloads'; //ที่เก็บรูปภาพ
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_download';
    }
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', ], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['title'], 'string', 'max' => 255],
            //checkExtensionByMimeType อย่าลืมเซต Size ใน PHP.ini
            ['file', 'file', 'maxSize' => 1024 * 1024 * 70, 'extensions' => ['docx', 'doc', 'xls','xlsx','png','jpg','pdf','ppt','pptx','zip'],'checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'หัวเรื่อง',
            'file' => 'ไฟล์',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

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
    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }
    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }
    public function getFilePath()
    {
        return  self::UPLOAD_FOLDER . '/' . $this->file;
    }
    public function getDownloadXCalendars()
    {
        return $this->hasMany(DownloadXCalendar::className(), ['download_id' => 'id']);
    }
    public function beforeDelete()
    {
//        foreach($this->downloadXCalendars as $item){
//            $item->delete();
//        }
        return parent::beforeDelete();
    }
}

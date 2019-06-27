<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use http\Exception;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "epro_public_document".
 *
 * @property int $file_type_id
 * @property int $project_public_id
 * @property string $path
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property FileType $fileType
 * @property ProjectPublic $projectPublic
 */
class PublicDocument extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    const FILE_TYPE_URL = 5;
    const UPLOAD_FOLDER  = 'web_eproject/uploads/project_documents'; //ที่เก็บรูปภาพ

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_public_document';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
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
            [['file_type_id', 'project_public_id', 'path', ], 'required'],
            [['file_type_id', 'project_public_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['path'], 'file', 'maxSize' => 1024 * 1024 * 50, 'extensions' => ['docx', 'doc', 'xls','xlsx','png','jpg','pdf','ppt','pptx'],'checkExtensionByMimeType'=>false],
            [['file_type_id', 'project_public_id'], 'unique', 'targetAttribute' => ['file_type_id', 'project_public_id']],
            [['file_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => FileType::className(), 'targetAttribute' => ['file_type_id' => 'id']],
            [['project_public_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectPublic::className(), 'targetAttribute' => ['project_public_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_type_id' => 'File Type ID',
            'project_public_id' => 'Project Public ID',
            'path' => 'Path',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileType()
    {
        return $this->hasOne(FileType::className(), ['id' => 'file_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPublic()
    {
        return $this->hasOne(ProjectPublic::className(), ['id' => 'project_public_id']);
    }
    public function uploadFile()
    {
        if ($this->validate()) {
            $path = self::UPLOAD_FOLDER.'/'.$this->projectPublic->project_id;
            FileHelper::createDirectory($path);
            if ($this->path) {
                if ($this->isNewRecord) {//ถ้าเป็นการเพิ่มใหม่ ให้ตั้งชื่อไฟล์ใหม่
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 10) .date('YmdHi'). '.' . $this->path->extension;//เลือกมา 15 อักษร .นามสกุล
                } else {//ถ้าเป็นการ update ให้ใช้ชื่อเดิม
                    $fileName = $this->getOldAttribute('path');
                }
                $this->path->saveAs(Yii::getAlias('@webroot') . '/' . $path . '/' . $fileName);
                return $fileName;
            }//end file upload
        }else{
            $errors = $this->getErrors();
            var_dump($errors); //or print_r($errors)
            exit;
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('path'); //ถ้าไม่มีการ upload ให้ใช้ข้อมูลเดิม
    }
    public function beforeDelete()
    {

        try {
            if ($this->file_type_id!= self::FILE_TYPE_URL && file_exists( Yii::getAlias( '@webroot' ) . '/' . self::getFilePath() )) {
                unlink( Yii::getAlias( '@webroot' ) . '/' . self::getFilePath() ); //ลบไฟล์ออก
            }
        } catch (Exception $e) {
        }
        return parent::beforeDelete();
    }

    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/'.$this->project_id.'/';
    }

    public function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/'.$this->project_id.'/';
    }

    public function getFilePath()
    {
        if(substr($this->path, 0, strlen("http")) === "http"){
            return $this->path;
        }else{
            return  Yii::getAlias('@web/'.self::UPLOAD_FOLDER .'/'.$this->projectPublic->project_id. '/' . $this->path);
        }

    }
    public function getRealFilePath()
    {
        if(substr($this->path, 0, strlen("http")) === "http"){
            return $this->path;
        }else{
            return  Yii::getAlias('@webroot/'.self::UPLOAD_FOLDER .'/'.$this->projectPublic->project_id. '/' . $this->path);
        }

    }
}

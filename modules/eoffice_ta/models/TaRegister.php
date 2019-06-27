<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use \yii\web\UploadedFile;
use app\modules\eoffice_ta\controllers;


/**
 * This is the model class for table "ta_register".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property string $person_id
 * @property string $term
 * @property string $year
 * @property string $ta_status_id
 * @property string $ta_image
 * @property string $doc_ref01
 * @property string $doc_ref02
 * @property string $doc_ref03
 * @property string $doc_ref04
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property string ta_payment_normal
 * @property string ta_payment_vip
 *
 * @property TaComparisonGrade[] $taComparisonGrades
 * @property TaRequest $subject
 * @property TaStatus $taStatus
 * @property TaRegisterSection[] $taRegisterSections
 */
class TaRegister extends \yii\db\ActiveRecord
{
    public $upload_folder ='register';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_register';
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
            [['subject_id', 'subject_version', 'person_id', 'term', 'year'], 'required'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_payment_normal','ta_payment_vip'], 'number'],
            [['subject_id', 'term', 'year'], 'string', 'max' => 10],
            [['person_id', 'ta_status_id'], 'string', 'max' => 15],
            [['ta_image', 'doc_ref01', 'doc_ref02', 'doc_ref03', 'doc_ref04'], 'string', 'max' => 200],
            [['subject_id', 'subject_version', 'person_id', 'term', 'year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'person_id', 'term', 'year']],
            [['subject_id', 'term', 'year', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => TaRequest::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'term' => 'term_id', 'year' => 'year', 'subject_version' => 'subject_version']],
            [['ta_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status_id' => 'ta_status_id']],
            [['ta_image'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'person_id' => 'Person ID',
            'term' => 'Term',
            'year' => 'Year',
            'ta_payment_normal' => 'Ta Payment Normal',
            'ta_payment_vip' => 'Ta Payment Vip',
            'ta_status_id' => 'Ta Status ID',
            'ta_image' => 'Ta Image',
            'doc_ref01' => 'Doc Ref01',
            'doc_ref02' => 'Doc Ref02',
            'doc_ref03' => 'Doc Ref03',
            'doc_ref04' => 'Doc Ref04',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaComparisonGrades()
    {
        return $this->hasMany(TaComparisonGrade::className(), ['subject_id' => 'subject_id', 'term' => 'term', 'year' => 'year', 'person_id' => 'person_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(TaRequest::className(), ['subject_id' => 'subject_id', 'term_id' => 'term', 'year' => 'year', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaStatus()
    {
        return $this->hasOne(TaStatus::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRegisterSections()
    {
        return $this->hasMany(TaRegisterSection::className(), ['subject_id' => 'subject_id', 'term' => 'term', 'year' => 'year', 'person_id' => 'person_id', 'subject_version' => 'subject_version']);
    }


    //------------------------------------ FUNCTION UPLOAD ONE ----------------------------------

    public function upload($model,$attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            //$fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
            $fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function upload2($model,$attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            //$fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
            $fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }


    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_ta/images/'.$this->upload_folder.'/';
    }

    public function getUploadUrl(){
        return Yii::getAlias('@web').'/web_ta/images/'.$this->upload_folder.'/';
    }

    public function getPhotoViewer(){
        return empty($this->ta_image) ? Yii::getAlias('@web').'/web_ta/images/img/none.png' : $this->getUploadUrl().$this->ta_image;
    }
}

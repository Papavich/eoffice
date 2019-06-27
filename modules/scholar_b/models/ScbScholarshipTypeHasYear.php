<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\controllers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\modules\scholar_b\components\ModelHelper;
/**
 * This is the model class for table "scb_scholarship_type_has_year".
 *
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property string $scholarship_condition
 * @property string $scholarship_file
 * @property string $scholarship_image
 * @property string $date_start
 * @property string $date_end
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbEnrollScholarship[] $scbEnrollScholarships
 * @property ScbCandidate[] $candidateIdCards
 * @property ScbScholarshipYear $scholarshipYear
 * @property ScbScholarshipType $scholarship
 * @property ScbTimeline[] $scbTimelines
 */
class ScbScholarshipTypeHasYear extends \yii\db\ActiveRecord
{

    public $uploadImageFolder = '/web_scb/uploads/scb_detail/images';
    public $uploadFilesFolder = '/web_scb/uploads/scb_detail/files';

    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_scholarship_type_has_year';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scholarship_id', 'scholarship_year'], 'required'],
            [['scholarship_year', 'crby', 'udby'], 'integer'],
            [['date_start', 'date_end', 'crtime', 'udtime'], 'safe'],
            [['scholarship_id'], 'string', 'max' => 5],
            [['scholarship_condition'], 'string'],
            [['scholarship_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,zip,docx,doc'],
            [['scholarship_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg'],
            [['scholarship_id', 'scholarship_year'], 'unique', 'targetAttribute' => ['scholarship_id', 'scholarship_year']],
            [['scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbScholarshipYear::className(), 'targetAttribute' => ['scholarship_year' => 'year']],
            [['scholarship_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbScholarshipType::className(), 'targetAttribute' => ['scholarship_id' => 'scholarship_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scholarship_id' => controllers::t('label', 'Scholarship Name'),
            'scholarship_year' => controllers::t('label', 'Year'),
            'scholarship_condition' => controllers::t('label', 'Scholarship Detail'),
            'scholarship_file' => controllers::t('label', 'Document File'),
            'scholarship_image' => controllers::t('label', 'Banner'),
            'date_start' => controllers::t('label', 'Registration Date'),
            'date_end' => controllers::t('label', 'Registration Closing Date'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    public function uploadImage()
    {
        if ($this->validate()) {
            if ($this->scholarship_image) {
                if ($this->isNewRecord) {
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 30) . '.' . $this->scholarship_image->extension;
                } else {
                    $fileName = $this->getOldAttribute('scholarship_image');
                }
                $this->scholarship_image->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadImageFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('scholarship_image');
    }

    public function uploadFile()
    {
        if ($this->validate()) {
            if ($this->scholarship_file) {
                if ($this->isNewRecord) {
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 30) . '.' . $this->scholarship_file->extension;
                    //$fileName = iconv('UTF-8','WINDOWS-874',$this->scholarship_file).'.'.$this->extension;
                } else {
                    $fileName = $this->getOldAttribute('scholarship_file');
                }
                $this->scholarship_file->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadFilesFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('scholarship_file');
    }

    public function getImage()
    {
        return Yii::getAlias('@web') . $this->uploadImageFolder . '/' . $this->scholarship_image;
    }

    public function getFile()
    {
        return Yii::getAlias('@web') . $this->uploadFilesFolder . '/' . $this->scholarship_file;
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbEnrollScholarships()
    {
        return $this->hasMany(ScbEnrollScholarship::className(), ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCards()
    {
        return $this->hasMany(ScbCandidate::className(), ['id_card' => 'candidate_id_card'])->viaTable('scb_enroll_scholarship', ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarshipYear()
    {
        return $this->hasOne(ScbScholarshipYear::className(), ['year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarship()
    {
        return $this->hasOne(ScbScholarshipType::className(), ['scholarship_id' => 'scholarship_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbTimelines()
    {
        return $this->hasMany(ScbTimeline::className(), ['scholarship_year' => 'scholarship_year']);
    }

    public function getScname(){
        return $this->hasOne(ScbScholarshipType::className(),['scholarship_id'=>'scholarship_id']);
    }


}

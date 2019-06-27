<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use \yii\web\UploadedFile;


/**
 * This is the model class for table "ta_working".
 *
 * @property int $ta_work_plan_id
 * @property string $person_id
 * @property string $subject_id
 * @property int $subject_version
 * @property string $section
 * @property string $term_id
 * @property string $year_id
 * @property string $ta_type_work_id
 * @property string $ta_work_title
 * @property string $ta_work_role
 * @property string $time_start
 * @property string $time_end
 * @property string $hr_working
 * @property string $ta_working_note
 * @property string $working_date
 * @property string $ta_status_id
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property string $active_status
 * @property string $working_evidence
 *
 * @property TaWorkAtone[] $taWorkAtones
 * @property TaStatus $taStatus
 * @property TaTypeWork $taTypeWork
 */
class TaWorking extends \yii\db\ActiveRecord
{
    public $upload_folder = 'uploads';
    const STATUS_CONFIRM_Hr = 'confirm';
    const STATUS_NON_CONFIRM_Hr = 'non-confirm';
    const STATUS_NEW = 'new';
    const STATUS_READ = 'read';
    const STATUS_OTHER = 'other';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_working';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ta_type_work_id','section','time_start', 'time_end', 'working_date'], 'required'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['time_start', 'time_end', 'working_date', 'crtime', 'udtime'], 'safe'],
            [['hr_working'], 'number'],
            [['active_status'], 'string'],
            [['person_id', 'ta_status_id'], 'string', 'max' => 15],
            [['subject_id', 'section', 'term_id', 'year_id', 'ta_type_work_id'], 'string', 'max' => 10],
            [['ta_work_title', 'ta_work_role', 'ta_working_note', 'working_evidence'], 'string', 'max' => 500],
            [['ta_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status_id' => 'ta_status_id']],
            [['ta_type_work_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaTypeWork::className(), 'targetAttribute' => ['ta_type_work_id' => 'ta_type_work_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ta_work_plan_id' => 'Ta Work Plan ID',
            'person_id' => 'Person ID',
            'subject_id' => controllers::t('label','Subject'),
            'subject_version' => controllers::t('label','Subject Version'),
            'section' => 'Section',
            'term_id' => controllers::t('label','Term'),
            'year_id' => controllers::t('label','Year'),
            'ta_type_work_id' => controllers::t('label','Type Work Ta'),
            'ta_work_title' => controllers::t('label','Work Title'),
            'ta_work_role' => controllers::t('label','Work Role'),
            'time_start' => controllers::t('label','Time Start'),
            'time_end' => controllers::t('label','Time End'),
            'hr_working' => controllers::t('label','Hours Working'),
            'ta_working_note' => controllers::t('label','Working Note'),
            'working_date' => controllers::t('label','Working Date'),
            'ta_status_id' => controllers::t('label','Status'),
            'working_evidence' => controllers::t('label','Working Evidence'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'active_status' => 'Active Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaWorkAtones()
    {
        return $this->hasMany(TaWorkAtone::className(), ['ta_work_plan_id' => 'ta_work_plan_id']);
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
    public function getTaTypeWork()
    {
        return $this->hasOne(TaTypeWork::className(), ['ta_type_work_id' => 'ta_type_work_id']);
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
    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_ta/evidence/'.$this->upload_folder.'/';
    }
    public function getUploadUrl(){
        return Yii::getAlias('@web').'/web_ta/evidence/'.$this->upload_folder.'/';
    }
    public function getPhotoViewer(){
        return empty($this->working_evidence) ? Yii::getAlias('@web').'/web_ta/images/img/none.png' : $this->getUploadUrl().$this->working_evidence;
    }
//---------------------------------------------------------------------------------------




}

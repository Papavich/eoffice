<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_workload_teacher".
 *
 * @property string $ta_wload_teacher_id
 * @property string $section
 * @property string $subject_id
 * @property int $subject_version
 * @property string $term
 * @property string $year
 * @property string $ta_type_work_id
 * @property string $ta_status_id
 * @property string $time_start
 * @property string $time_end
 * @property string $lec_inspect
 * @property string $lect_check_list_std
 * @property string $lec_other
 * @property string $lab_hr
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property string $time_start_lab
 * @property string $time_end_lab
 * @property string $day_lect
 * @property string $day_lab
 *
 * @property TaRequest $subject
 * @property TaStatus $taStatus
 * @property TaTypeWork $taTypeWork
 */
class TaWorkloadTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_workload_teacher';
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
            [['ta_wload_teacher_id', 'section', 'subject_id', 'subject_version', 'term', 'year','ta_type_work_id'], 'required'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['time_start', 'time_end', 'crtime', 'udtime', 'time_start_lab', 'time_end_lab'], 'safe'],
            [['lec_inspect', 'lect_check_list_std', 'lec_other', 'lab_hr'], 'number'],
            [['ta_wload_teacher_id', 'day_lect', 'day_lab'], 'string', 'max' => 20],
            [['section', 'subject_id', 'term', 'year', 'ta_type_work_id'], 'string', 'max' => 10],
            [['ta_status_id'], 'string', 'max' => 15],
            [['ta_wload_teacher_id', 'section', 'subject_id', 'subject_version', 'term', 'year'], 'unique', 'targetAttribute' => ['ta_wload_teacher_id', 'section', 'subject_id', 'subject_version', 'term', 'year']],
            [['subject_id', 'term', 'year', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => TaRequest::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'term' => 'term_id', 'year' => 'year', 'subject_version' => 'subject_version']],
            [['ta_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status_id' => 'ta_status_id']],
            [['ta_type_work_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaTypeWork::className(), 'targetAttribute' => ['ta_type_work_id' => 'ta_type_work_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_wload_teacher_id' => 'ID',
            'section' => 'Section',
            'subject_id' => controllers::t('label','Subject'),
            'subject_version' => controllers::t('label','Subject Version'),
            'term' => controllers::t('label','Term'),
            'year' => controllers::t('label','School year'),
            'ta_type_work_id' => controllers::t('label','Type Work Ta'),
            'ta_status_id' => controllers::t('label','Status'),
            'time_start' => controllers::t('label','Lecture start time'),
            'time_end' => controllers::t('label','Lecture end time'),
            'lec_inspect' => controllers::t('label','Hr Inspect'),
            'lect_check_list_std' => controllers::t('label','Hr check of student'),
            'lec_other' => controllers::t('label','Hr other'),
            'lab_hr' => controllers::t('label','Hr LAB'),
            'time_start_lab' => controllers::t('label','LAB start time'),
            'time_end_lab' => controllers::t('label','LAB end time'),
            'day_lect' => controllers::t('label','Lecture Day'),
            'day_lab' => controllers::t('label','LAB Day'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',

        ];
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
    public function getTaTypeWork()
    {
        return $this->hasOne(TaTypeWork::className(), ['ta_type_work_id' => 'ta_type_work_id']);
    }
}

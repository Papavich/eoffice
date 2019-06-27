<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_request".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property string $term_id
 * @property string $year
 * @property int $degree_bachelor
 * @property int $degree_master
 * @property int $degree_doctorate
 * @property int $amount_ta_all
 * @property string $request_note
 * @property string $property_grade
 * @property string $property_text
 * @property string $ta_type_work_id
 * @property string $ta_status_id
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaPayment $taPayment
 * @property TaRegister[] $taRegisters
 * @property TaStatus $taStatus
 * @property TaTypeWork $taTypeWork
 * @property TaWorkloadTeacher[] $taWorkloadTeachers
 */
class TaRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_request';
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
            [['subject_id', 'subject_version', 'term_id', 'year','ta_type_work_id'], 'required'],
            [['subject_version', 'degree_bachelor', 'degree_master', 'degree_doctorate', 'amount_ta_all', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['subject_id', 'term_id', 'year', 'ta_type_work_id'], 'string', 'max' => 10],
            [['request_note', 'property_text'], 'string', 'max' => 200],
            [['property_grade'], 'string', 'max' => 2],
            [['ta_status_id'], 'string', 'max' => 15],
            [['subject_id', 'subject_version', 'term_id', 'year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'term_id', 'year']],
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
            'subject_id' => controllers::t('label','Subject'),
            'subject_version' => controllers::t('label','Subject Version'),
            'term_id' => controllers::t('label','Term'),
            'year' => controllers::t('label','Year'),
            'degree_bachelor' => controllers::t('label','Degree Bachelor'),
            'degree_master' => controllers::t('label','Degree Master'),
            'degree_doctorate' => controllers::t('label','Degree Doctorate'),
            'amount_ta_all' => controllers::t('label','Amount Ta All'),
            'request_note' => controllers::t('label','Note'),
            'property_grade' => controllers::t('label','Property Grade'),
            'property_text' =>  controllers::t('label','Property Request'),
            'ta_type_work_id' => controllers::t('label','Type Work Ta'),
            'ta_status_id' => controllers::t('label','Status'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPayment()
    {
        return $this->hasOne(TaPayment::className(), ['subject_id' => 'subject_id', 'term' => 'term_id', 'year' => 'year', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRegisters()
    {
        return $this->hasMany(TaRegister::className(), ['subject_id' => 'subject_id', 'term' => 'term_id', 'year' => 'year', 'subject_version' => 'subject_version']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaWorkloadTeachers()
    {
        return $this->hasMany(TaWorkloadTeacher::className(), ['subject_id' => 'subject_id', 'term' => 'term_id', 'year' => 'year', 'subject_version' => 'subject_version']);
    }
}

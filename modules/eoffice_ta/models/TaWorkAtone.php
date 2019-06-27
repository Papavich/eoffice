<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_work_atone".
 *
 * @property integer $ta_work_atone_id
 * @property integer $ta_work_plan_id
 * @property string $atone_date
 * @property string $atone_note
 * @property string $ta_status_id
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property TaStatus $taStatus
 * @property TaWorkPlan $taWorkPlan
 */
class TaWorkAtone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_work_atone';
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
            [['ta_work_plan_id', 'crby', 'udby'], 'integer'],
            [['atone_date', 'crtime', 'udtime'], 'safe'],
            [['atone_note'], 'string', 'max' => 500],
            [['ta_status_id'], 'string', 'max' => 15],
            [['ta_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status_id' => 'ta_status_id']],
            [['ta_work_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaWorkPlan::className(), 'targetAttribute' => ['ta_work_plan_id' => 'ta_work_plan_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_work_atone_id' => 'Ta Work Atone ID',
            'ta_work_plan_id' => 'Ta Work Plan ID',
            'atone_date' => 'Atone Date',
            'atone_note' => 'Atone Note',
            'ta_status_id' => 'Ta Status ID',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
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
    public function getTaWorkPlan()
    {
        return $this->hasOne(TaWorkPlan::className(), ['ta_work_plan_id' => 'ta_work_plan_id']);
    }
}

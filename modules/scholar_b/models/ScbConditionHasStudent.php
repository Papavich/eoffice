<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_condition_has_student".
 *
 * @property int $condi_id
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property string $student_id
 * @property int $condition_pass
 *
 * @property ScbCondition $condi
 * @property ScbStudent $student
 */
class ScbConditionHasStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_condition_has_student';
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
            [['condi_id', 'scholarship_id', 'scholarship_year', 'student_id'], 'required'],
            [['condi_id', 'scholarship_year', 'condition_pass'], 'integer'],
            [['scholarship_id'], 'string', 'max' => 5],
            [['student_id'], 'string', 'max' => 11],
            [['condi_id', 'scholarship_id', 'scholarship_year', 'student_id'], 'unique', 'targetAttribute' => ['condi_id', 'scholarship_id', 'scholarship_year', 'student_id']],
            [['condi_id', 'scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbCondition::className(), 'targetAttribute' => ['condi_id' => 'condi_id', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'condi_id' => 'Condi ID',
            'scholarship_id' => 'Scholarship ID',
            'scholarship_year' => 'Scholarship Year',
            'student_id' => 'Student ID',
            'condition_pass' => 'Condition Pass',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondi()
    {
        return $this->hasOne(ScbCondition::className(), ['condi_id' => 'condi_id', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }
}

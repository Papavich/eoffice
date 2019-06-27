<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_condition".
 *
 * @property int $condi_id
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property string $condi_name
 * @property double $condi_value
 * @property string $condi_fiexed
 *
 * @property ScbScholarshipTypeHasYear $scholarship
 * @property ScbConditionHasStudent[] $scbConditionHasStudents
 * @property ScbStudent[] $students
 */
class ScbCondition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_condition';
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
            [['scholarship_year'], 'integer'],
            [['condi_value'], 'number'],
            [['scholarship_id'], 'string', 'max' => 5],
            [['condi_name'], 'string', 'max' => 250],
            [['condi_fiexed'], 'string', 'max' => 45],
            [['scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbScholarshipTypeHasYear::className(), 'targetAttribute' => ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
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
            'condi_name' => 'Condi Name',
            'condi_value' => 'Condi Value',
            'condi_fiexed' => 'Condi Fiexed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarship()
    {
        return $this->hasOne(ScbScholarshipTypeHasYear::className(), ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbConditionHasStudents()
    {
        return $this->hasMany(ScbConditionHasStudent::className(), ['condi_id' => 'condi_id', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(ScbStudent::className(), ['student_id' => 'student_id'])->viaTable('scb_condition_has_student', ['condi_id' => 'condi_id', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }
}

<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\controllers;
use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_funded".
 *
 * @property string $student_id
 * @property int $funded_type_id
 * @property string $funded_date
 * @property int $year
 * @property int $semester
 * @property double $funded_amount
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbFundedType $fundedType
 * @property ScbStudent $student
 * @property ScbYearHasSemester $year0
 */
class ScbFunded extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_funded';
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
            [['student_id', 'funded_type_id', 'funded_date', 'year', 'semester', 'funded_amount'], 'required'],
            [['funded_type_id', 'year', 'semester', 'crby', 'udby'], 'integer'],
            [['funded_date', 'crtime', 'udtime'], 'safe'],
            [['funded_amount'], 'number'],
            [['student_id'], 'string', 'max' => 11],
            [['student_id', 'funded_type_id', 'funded_date', 'year', 'semester'], 'unique', 'targetAttribute' => ['student_id', 'funded_type_id', 'funded_date', 'year', 'semester']],
            [['funded_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbFundedType::className(), 'targetAttribute' => ['funded_type_id' => 'funded_type_id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
            [['year', 'semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYearHasSemester::className(), 'targetAttribute' => ['year' => 'year', 'semester' => 'semester']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => controllers::t('label', 'Student ID'),
            'funded_type_id' => controllers::t('label', 'Funded Type ID'),
            'funded_date' => controllers::t('label', 'Funded Date'),
            'year' => controllers::t('label', 'Year'),
            'semester' => controllers::t('label', 'Semester'),
            'funded_amount' => controllers::t('label', 'Funded Amount'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFundedType()
    {
        return $this->hasOne(ScbFundedType::className(), ['funded_type_id' => 'funded_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYearHasSemester::className(), ['year' => 'year', 'semester' => 'semester']);
    }

    public function getFundedname()
    {
        return $this->HasOne(ScbFundedType::className(), ['funded_type_id' => 'funded_type_id']);
    }
}

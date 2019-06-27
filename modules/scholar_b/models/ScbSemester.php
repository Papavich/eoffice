<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_semester".
 *
 * @property integer $semester
 *
 * @property ScbYearHasSemester[] $scbYearHasSemesters
 * @property ScbYear[] $scbYearYears
 */
class ScbSemester extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_semester';
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
            [['semester'], 'required'],
            [['semester'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'semester' => 'Semester',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbYearHasSemesters()
    {
        return $this->hasMany(ScbYearHasSemester::className(), ['scb_semester_semester' => 'semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbYearYears()
    {
        return $this->hasMany(ScbYear::className(), ['year' => 'scb_year_year'])->viaTable('scb_year_has_semester', ['scb_semester_semester' => 'semester']);
    }
}

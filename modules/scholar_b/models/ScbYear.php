<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_year".
 *
 * @property integer $year
 *
 * @property ScbActivityMain[] $scbActivityMains
 * @property ScbTeacher[] $scbTeachers
 * @property ScbYearHasSemester[] $scbYearHasSemesters
 * @property ScbSemester[] $scbSemesterSemesters
 */
class ScbYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_year';
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
            [['year'], 'required'],
            [['year'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbActivityMains()
    {
        return $this->hasMany(ScbActivityMain::className(), ['year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbTeachers()
    {
        return $this->hasMany(ScbTeacher::className(), ['year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbYearHasSemesters()
    {
        return $this->hasMany(ScbYearHasSemester::className(), ['scb_year_year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbSemesterSemesters()
    {
        return $this->hasMany(ScbSemester::className(), ['semester' => 'scb_semester_semester'])->viaTable('scb_year_has_semester', ['scb_year_year' => 'year']);
    }
}

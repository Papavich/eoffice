<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_year_has_semester".
 *
 * @property integer $scb_year_year
 * @property integer $scb_semester_semester
 *
 * @property ScbEarn[] $scbEarns
 * @property ScbProjectHasScbTeacher[] $scbProjectHasScbTeachers
 * @property ScbStudentHasProject[] $scbStudentHasProjects
 * @property ScbSemester $scbSemesterSemester
 * @property ScbYear $scbYearYear
 */
class ScbYearHasSemester extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_year_has_semester';
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
            [['scb_year_year', 'scb_semester_semester'], 'required'],
            [['scb_year_year', 'scb_semester_semester'], 'integer'],
            [['scb_semester_semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbSemester::className(), 'targetAttribute' => ['scb_semester_semester' => 'semester']],
            [['scb_year_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYear::className(), 'targetAttribute' => ['scb_year_year' => 'year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scb_year_year' => 'Scb Year Year',
            'scb_semester_semester' => 'Scb Semester Semester',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbEarns()
    {
        return $this->hasMany(ScbEarn::className(), ['year' => 'scb_year_year', 'semester' => 'scb_semester_semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbProjectHasScbTeachers()
    {
        return $this->hasMany(ScbProjectHasScbTeacher::className(), ['year' => 'scb_year_year', 'semester' => 'scb_semester_semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbStudentHasProjects()
    {
        return $this->hasMany(ScbStudentHasProject::className(), ['year' => 'scb_year_year', 'semester' => 'scb_semester_semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbSemesterSemester()
    {
        return $this->hasOne(ScbSemester::className(), ['semester' => 'scb_semester_semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbYearYear()
    {
        return $this->hasOne(ScbYear::className(), ['year' => 'scb_year_year']);
    }
}

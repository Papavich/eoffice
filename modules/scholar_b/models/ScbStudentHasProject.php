<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_student_has_project".
 *
 * @property string $student_id
 * @property int $year
 * @property int $semester
 * @property int $project_code
 *
 * @property ScbProgressReport[] $scbProgressReports
 * @property ScbProject $projectCode
 * @property ScbYearHasSemester $year0
 * @property ScbStudent $student
 */
class ScbStudentHasProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_student_has_project';
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
            [['student_id', 'year', 'semester', 'project_code'], 'required'],
            [['year', 'semester', 'project_code'], 'integer'],
            [['student_id'], 'string', 'max' => 11],
            [['student_id', 'year', 'semester', 'project_code'], 'unique', 'targetAttribute' => ['student_id', 'year', 'semester', 'project_code']],
            [['project_code'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProject::className(), 'targetAttribute' => ['project_code' => 'project_code']],
            [['year', 'semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYearHasSemester::className(), 'targetAttribute' => ['year' => 'year', 'semester' => 'semester']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'year' => 'Year',
            'semester' => 'Semester',
            'project_code' => 'Project Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbProgressReports()
    {
        return $this->hasMany(ScbProgressReport::className(), ['student_id' => 'student_id', 'year' => 'year', 'semester' => 'semester', 'project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectCode()
    {
        return $this->hasOne(ScbProject::className(), ['project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYearHasSemester::className(), ['year' => 'year', 'semester' => 'semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }
}

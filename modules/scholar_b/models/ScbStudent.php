<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_student".
 *
 * @property string $student_id
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property int $status_edu
 * @property int $status_advisor
 * @property int $out_of_scb_status
 * @property string $out_of_scb_debt
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbConditionHasStudent[] $scbConditionHasStudents
 * @property ScbCondition[] $condis
 * @property ScbFunded[] $scbFundeds
 * @property ScbGanttChart[] $scbGanttCharts
 * @property ScbScholarshipTypeHasYear $scholarship
 * @property ScbStudentHasActivityMain[] $scbStudentHasActivityMains
 * @property ScbActivityMain[] $activityMains
 * @property ScbStudentHasProject[] $scbStudentHasProjects
 * @property ScbStudentHasTeacher[] $scbStudentHasTeachers
 * @property ScbTeacherHasType[] $teacherIdCards
 */
class ScbStudent extends \yii\db\ActiveRecord
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
        return 'scb_student';
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
            [['student_id', 'scholarship_id', 'scholarship_year'], 'required'],
            [['scholarship_year', 'status_edu', 'status_advisor', 'out_of_scb_status', 'crby', 'udby'], 'integer'],
            [['out_of_scb_debt'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['student_id'], 'string', 'max' => 11],
            [['scholarship_id'], 'string', 'max' => 5],
            [['student_id'], 'unique'],
            [['scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbScholarshipTypeHasYear::className(), 'targetAttribute' => ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'scholarship_id' => 'Scholarship ID',
            'scholarship_year' => 'Scholarship Year',
            'status_edu' => 'Status Edu',
            'status_advisor' => 'Status Advisor',
            'out_of_scb_status' => 'Out Of Scb Status',
            'out_of_scb_debt' => 'Out Of Scb Debt',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbConditionHasStudents()
    {
        return $this->hasMany(ScbConditionHasStudent::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondis()
    {
        return $this->hasMany(ScbCondition::className(), ['condi_id' => 'condi_id', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year'])->viaTable('scb_condition_has_student', ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbFundeds()
    {
        return $this->hasMany(ScbFunded::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbGanttCharts()
    {
        return $this->hasMany(ScbGanttChart::className(), ['student_id' => 'student_id']);
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
    public function getScbStudentHasActivityMains()
    {
        return $this->hasMany(ScbStudentHasActivityMain::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityMains()
    {
        return $this->hasMany(ScbActivityMain::className(), ['act_main_id' => 'activity_main_id', 'year' => 'year'])->viaTable('scb_student_has_activity_main', ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbStudentHasProjects()
    {
        return $this->hasMany(ScbStudentHasProject::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbStudentHasTeachers()
    {
        return $this->hasMany(ScbStudentHasTeacher::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCards()
    {
        return $this->hasMany(ScbTeacherHasType::className(), ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id'])->viaTable('scb_student_has_teacher', ['student_id' => 'student_id']);
    }

}

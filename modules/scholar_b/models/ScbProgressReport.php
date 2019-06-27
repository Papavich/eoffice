<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_progress_report".
 *
 * @property int $progress_seq
 * @property string $student_id
 * @property int $project_year
 * @property int $project_semester
 * @property int $project_code
 * @property int $year
 * @property int $semester
 * @property string $proj_summary
 * @property string $proj_activity
 * @property string $proj_factual
 * @property string $proj_plan_next_year
 * @property string $plan_year1
 * @property string $plan_year2
 * @property string $plan_year3
 * @property string $plan_year4
 * @property string $proj_problem
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbCommentProject[] $scbCommentProjects
 * @property ScbTeacherHasType[] $teacherIdCards
 * @property ScbStudentHasProject $student
 * @property ScbYearHasSemester $year0
 */
class ScbProgressReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_progress_report';
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
            [['progress_seq', 'student_id', 'project_year', 'project_semester', 'project_code', 'year', 'semester'], 'required'],
            [['progress_seq', 'project_year', 'project_semester', 'project_code', 'year', 'semester', 'crby', 'udby'], 'integer'],
            [['proj_summary', 'proj_activity', 'proj_factual', 'proj_plan_next_year', 'plan_year1', 'plan_year2', 'plan_year3', 'plan_year4', 'proj_problem'], 'string'],
            [['crtime', 'udtime'], 'safe'],
            [['student_id'], 'string', 'max' => 11],
            [['progress_seq', 'student_id', 'project_year', 'project_semester', 'project_code'], 'unique', 'targetAttribute' => ['progress_seq', 'student_id', 'project_year', 'project_semester', 'project_code']],
            [['student_id', 'project_year', 'project_semester', 'project_code'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudentHasProject::className(), 'targetAttribute' => ['student_id' => 'student_id', 'project_year' => 'year', 'project_semester' => 'semester', 'project_code' => 'project_code']],
            [['year', 'semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYearHasSemester::className(), 'targetAttribute' => ['year' => 'year', 'semester' => 'semester']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'progress_seq' => 'Progress Seq',
            'student_id' => 'Student ID',
            'project_year' => 'Project Year',
            'project_semester' => 'Project Semester',
            'project_code' => 'Project Code',
            'year' => 'Year',
            'semester' => 'Semester',
            'proj_summary' => 'Proj Summary',
            'proj_activity' => 'Proj Activity',
            'proj_factual' => 'Proj Factual',
            'proj_plan_next_year' => 'Proj Plan Next Year',
            'plan_year1' => 'Plan Year1',
            'plan_year2' => 'Plan Year2',
            'plan_year3' => 'Plan Year3',
            'plan_year4' => 'Plan Year4',
            'proj_problem' => 'Proj Problem',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCommentProjects()
    {
        return $this->hasMany(ScbCommentProject::className(), ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'project_year' => 'project_year', 'project_semester' => 'project_semester', 'project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCards()
    {
        return $this->hasMany(ScbTeacherHasType::className(), ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id'])->viaTable('scb_comment_project', ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'project_year' => 'project_year', 'project_semester' => 'project_semester', 'project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudentHasProject::className(), ['student_id' => 'student_id', 'year' => 'project_year', 'semester' => 'project_semester', 'project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYearHasSemester::className(), ['year' => 'year', 'semester' => 'semester']);
    }
}

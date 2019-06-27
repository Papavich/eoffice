<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_project_has_scb_teacher".
 *
 * @property string $project_code
 * @property string $teacher_id_card
 * @property string $teacher_type
 * @property integer $year
 * @property integer $semester
 *
 * @property ScbCommentProject $scbCommentProject
 * @property ScbProject $projectCode
 * @property ScbTeacher $teacherIdCard
 * @property ScbYearHasSemester $year0
 */
class ScbProjectHasScbTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_project_has_scb_teacher';
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
            [['project_code', 'teacher_id_card', 'teacher_type', 'year', 'semester'], 'required'],
            [['year', 'semester'], 'integer'],
            [['project_code'], 'string', 'max' => 7],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['teacher_type'], 'string', 'max' => 10],
            [['project_code'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProject::className(), 'targetAttribute' => ['project_code' => 'project_code']],
            [['teacher_id_card', 'teacher_type'], 'exist', 'skipOnError' => true, 'targetClass' => ScbTeacher::className(), 'targetAttribute' => ['teacher_id_card' => 'id_card', 'teacher_type' => 'teacher_type']],
            [['year', 'semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYearHasSemester::className(), 'targetAttribute' => ['year' => 'scb_year_year', 'semester' => 'scb_semester_semester']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_code' => 'Project Code',
            'teacher_id_card' => 'Teacher Id Card',
            'teacher_type' => 'Teacher Type',
            'year' => 'Year',
            'semester' => 'Semester',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCommentProject()
    {
        return $this->hasOne(ScbCommentProject::className(), ['project_code' => 'project_code', 'teacher_id_card' => 'teacher_id_card', 'teacher_type' => 'teacher_type', 'year' => 'year', 'semester' => 'semester']);
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
    public function getTeacherIdCard()
    {
        return $this->hasOne(ScbTeacher::className(), ['id_card' => 'teacher_id_card', 'teacher_type' => 'teacher_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYearHasSemester::className(), ['scb_year_year' => 'year', 'scb_semester_semester' => 'semester']);
    }
}

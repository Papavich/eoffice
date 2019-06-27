<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_teacher_has_project".
 *
 * @property string $teacher_id_card
 * @property int $project_code
 * @property int $adviser_status
 *
 * @property ScbCommentProject[] $scbCommentProjects
 * @property ScbProgressReport[] $progressSeqs
 * @property ScbProject $projectCode
 * @property ScbTeacher $teacherIdCard
 */
class ScbTeacherHasProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scb_teacher_has_project';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id_card', 'project_code', 'adviser_status'], 'required'],
            [['project_code', 'adviser_status'], 'integer'],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['teacher_id_card', 'project_code', 'adviser_status'], 'unique', 'targetAttribute' => ['teacher_id_card', 'project_code', 'adviser_status']],
            [['project_code'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProject::className(), 'targetAttribute' => ['project_code' => 'project_code']],
            [['teacher_id_card'], 'exist', 'skipOnError' => true, 'targetClass' => ScbTeacher::className(), 'targetAttribute' => ['teacher_id_card' => 'id_card']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_id_card' => 'Teacher Id Card',
            'project_code' => 'Project Code',
            'adviser_status' => 'Adviser Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCommentProjects()
    {
        return $this->hasMany(ScbCommentProject::className(), ['teacher_id_card' => 'teacher_id_card', 'teacher_project_code' => 'project_code', 'adviser_status' => 'adviser_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgressSeqs()
    {
        return $this->hasMany(ScbProgressReport::className(), ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'project_year' => 'project_year', 'project_semester' => 'project_semester', 'project_code' => 'project_code'])->viaTable('scb_comment_project', ['teacher_id_card' => 'teacher_id_card', 'teacher_project_code' => 'project_code', 'adviser_status' => 'adviser_status']);
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
        return $this->hasOne(ScbTeacher::className(), ['id_card' => 'teacher_id_card']);
    }
}

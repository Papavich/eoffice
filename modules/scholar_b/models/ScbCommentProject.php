<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "scb_comment_project".
 *
 * @property string $comment
 * @property int $result
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property int $progress_seq
 * @property string $student_id
 * @property int $project_year
 * @property int $project_semester
 * @property int $project_code
 * @property string $teacher_id_card
 * @property int $teacher_project_code
 * @property int $adviser_status
 *
 * @property ScbProgressReport $progressSeq
 * @property ScbTeacherHasProject $teacherIdCard
 */
class ScbCommentProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    public static function tableName()
    {
        return 'scb_comment_project';
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
            [['comment'], 'string'],
            [['result', 'crby', 'udby', 'progress_seq', 'project_year', 'project_semester', 'project_code', 'teacher_project_code', 'adviser_status'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['progress_seq', 'student_id', 'project_year', 'project_semester', 'project_code', 'teacher_id_card', 'teacher_project_code', 'adviser_status'], 'required'],
            [['student_id'], 'string', 'max' => 11],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['progress_seq', 'student_id', 'project_year', 'project_semester', 'project_code', 'teacher_id_card', 'teacher_project_code', 'adviser_status'], 'unique', 'targetAttribute' => ['progress_seq', 'student_id', 'project_year', 'project_semester', 'project_code', 'teacher_id_card', 'teacher_project_code', 'adviser_status']],
            [['progress_seq', 'student_id', 'project_year', 'project_semester', 'project_code'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProgressReport::className(), 'targetAttribute' => ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'project_year' => 'project_year', 'project_semester' => 'project_semester', 'project_code' => 'project_code']],
            [['teacher_id_card', 'teacher_project_code', 'adviser_status'], 'exist', 'skipOnError' => true, 'targetClass' => ScbTeacherHasProject::className(), 'targetAttribute' => ['teacher_id_card' => 'teacher_id_card', 'teacher_project_code' => 'project_code', 'adviser_status' => 'adviser_status']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment' => 'Comment',
            'result' => 'Result',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'progress_seq' => 'Progress Seq',
            'student_id' => 'Student ID',
            'project_year' => 'Project Year',
            'project_semester' => 'Project Semester',
            'project_code' => 'Project Code',
            'teacher_id_card' => 'Teacher Id Card',
            'teacher_project_code' => 'Teacher Project Code',
            'adviser_status' => 'Adviser Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgressSeq()
    {
        return $this->hasOne(ScbProgressReport::className(), ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'project_year' => 'project_year', 'project_semester' => 'project_semester', 'project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCard()
    {
        return $this->hasOne(ScbTeacherHasProject::className(), ['teacher_id_card' => 'teacher_id_card', 'project_code' => 'teacher_project_code', 'adviser_status' => 'adviser_status']);
    }
}

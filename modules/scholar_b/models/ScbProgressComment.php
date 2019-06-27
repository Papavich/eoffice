<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "scb_progress_comment".
 *
 * @property int $progress_seq
 * @property string $student_id
 * @property int $progress_year
 * @property int $progress_semester
 * @property string $teacher_id_card
 * @property int $teacher_type_id
 * @property string $comment
 * @property int $result
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbProgress $progressSeq
 * @property ScbTeacherHasType $teacherIdCard
 */
class ScbProgressComment extends \yii\db\ActiveRecord
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
        return 'scb_progress_comment';
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
            [['progress_seq', 'student_id', 'progress_year', 'progress_semester', 'teacher_id_card', 'teacher_type_id'], 'required'],
            [['progress_seq', 'progress_year', 'progress_semester', 'teacher_type_id', 'result', 'crby', 'udby'], 'integer'],
            [['comment'], 'string'],
            [['crtime', 'udtime'], 'safe'],
            [['student_id'], 'string', 'max' => 11],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['progress_seq', 'student_id', 'progress_year', 'progress_semester', 'teacher_id_card', 'teacher_type_id'], 'unique', 'targetAttribute' => ['progress_seq', 'student_id', 'progress_year', 'progress_semester', 'teacher_id_card', 'teacher_type_id']],
            [['progress_seq', 'student_id', 'progress_year', 'progress_semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProgress::className(), 'targetAttribute' => ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'progress_year' => 'year', 'progress_semester' => 'semester']],
            [['teacher_id_card', 'teacher_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbTeacherHasType::className(), 'targetAttribute' => ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'progress_seq' => 'Progress Seq',
            'student_id' => 'Student ID',
            'progress_year' => 'Progress Year',
            'progress_semester' => 'Progress Semester',
            'teacher_id_card' => 'Teacher Id Card',
            'teacher_type_id' => 'Teacher Type ID',
            'comment' => 'Comment',
            'result' => 'Result',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgressSeq()
    {
        return $this->hasOne(ScbProgress::className(), ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'year' => 'progress_year', 'semester' => 'progress_semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCard()
    {
        return $this->hasOne(ScbTeacherHasType::className(), ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id']);
    }
}

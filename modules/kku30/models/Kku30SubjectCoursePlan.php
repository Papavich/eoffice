<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_subject_course_plan".
 *
 * @property string $course_id
 * @property string $subject_id
 * @property int $subject_version
 * @property int $plan_studentyear
 * @property int $plan_semester
 *
 * @property Kku30Course $course
 * @property Kku30Subject $subject
 */
class Kku30SubjectCoursePlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subject_course_plan';
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['course_id', 'subject_id', 'subject_version', 'plan_studentyear', 'plan_semester'], 'required'],
            [['subject_version', 'plan_studentyear', 'plan_semester'], 'integer'],
            [['course_id'], 'string', 'max' => 12],
            [['subject_id'], 'string', 'max' => 10],
            [['course_id', 'subject_id', 'subject_version', 'plan_studentyear', 'plan_semester'], 'unique', 'targetAttribute' => ['course_id', 'subject_id', 'subject_version', 'plan_studentyear', 'plan_semester']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Course::className(), 'targetAttribute' => ['course_id' => 'course_id']],
            [['subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'plan_studentyear' => 'Plan Studentyear',
            'plan_semester' => 'Plan Semester',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Kku30Course::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Kku30Subject::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }
}

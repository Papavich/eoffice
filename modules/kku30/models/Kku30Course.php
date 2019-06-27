<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_course".
 *
 * @property string $course_id
 * @property string $course_name
 * @property int $course_year
 * @property int $course_credit
 * @property string $course_description
 * @property string $course_condition
 *
 * @property Kku30ProgramsCourse[] $kku30ProgramsCourses
 * @property Kku30SubjectCoruse[] $kku30SubjectCoruses
 * @property Kku30SubjectCoursePlan[] $kku30SubjectCoursePlans
 */
class Kku30Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_course';
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
            [['course_id', 'course_name', 'course_year', 'course_credit'], 'required'],
            [['course_year', 'course_credit'], 'integer'],
            [['course_description', 'course_condition'], 'string'],
            [['course_id'], 'string', 'max' => 12],
            [['course_name'], 'string', 'max' => 100],
            [['course_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'course_name' => 'Course Name',
            'course_year' => 'Course Year',
            'course_credit' => 'Course Credit',
            'course_description' => 'Course Description',
            'course_condition' => 'Course Condition',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30ProgramsCourses()
    {
        return $this->hasMany(Kku30ProgramsCourse::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectCoruses()
    {
        return $this->hasMany(Kku30SubjectCoruse::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectCoursePlans()
    {
        return $this->hasMany(Kku30SubjectCoursePlan::className(), ['course_id' => 'course_id']);
    }
}

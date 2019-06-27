<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_programs_course".
 *
 * @property string $course_id
 * @property string $program_id
 * @property int $program_class
 * @property int $admission_year
 * @property string $course_no
 *
 * @property Kku30Course $course
 * @property Kku30Program $program
 */
class Kku30ProgramsCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_programs_course';
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
            [['course_id', 'program_id', 'program_class', 'admission_year'], 'required'],
            [['program_class', 'admission_year'], 'integer'],
            [['course_id'], 'string', 'max' => 12],
            [['program_id'], 'string', 'max' => 10],
            [['course_no'], 'string', 'max' => 15],
            [['course_id', 'program_id', 'program_class', 'admission_year'], 'unique', 'targetAttribute' => ['course_id', 'program_id', 'program_class', 'admission_year']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Course::className(), 'targetAttribute' => ['course_id' => 'course_id']],
            [['program_id', 'program_class'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Program::className(), 'targetAttribute' => ['program_id' => 'program_id', 'program_class' => 'program_class']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'program_id' => 'Program ID',
            'program_class' => 'Program Class',
            'admission_year' => 'Admission Year',
            'course_no' => 'Course No',
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
    public function getProgram()
    {
        return $this->hasOne(Kku30Program::className(), ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }
}

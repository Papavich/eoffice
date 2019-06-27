<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_subject_open_program".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 * @property string $program_id
 * @property int $program_class
 * @property int $student_year
 *
 * @property Kku30Program $program
 * @property Kku30SubjectOpen $subopenSemester
 */
class Kku30SubjectOpenProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subject_open_program';
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
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class', 'student_year'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year', 'program_class', 'student_year'], 'integer'],
            [['subject_id', 'program_id'], 'string', 'max' => 10],
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class']],
            [['program_id', 'program_class'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Program::className(), 'targetAttribute' => ['program_id' => 'program_id', 'program_class' => 'program_class']],
            [['subopen_semester', 'subopen_year', 'subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30SubjectOpen::className(), 'targetAttribute' => ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'subopen_semester' => 'Subopen Semester',
            'subopen_year' => 'Subopen Year',
            'program_id' => 'Program ID',
            'program_class' => 'Program Class',
            'student_year' => 'Student Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Kku30Program::className(), ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubopenSemester()
    {
        return $this->hasOne(Kku30SubjectOpen::className(), ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }
}

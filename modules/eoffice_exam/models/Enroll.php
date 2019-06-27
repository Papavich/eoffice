<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "eoffice_exam_enroll".
 *
 * @property string $section_no
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 * @property string $program_id
 * @property int $program_class
 * @property int $teacher_id
 * @property int $section_size
 * @property int $exam_enroll_seat
 * @property int $exam_enroll_seat_temp
 * @property string $exam_enroll_start_time
 * @property string $exam_enroll_end_time
 * @property string $exam_enroll_date
 * @property string $LEVELID
 * @property string $Examcode
 * @property string $exam_enroll_time
 */
class Enroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_exam_enroll';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_exam');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class', 'teacher_id', 'section_size', 'exam_enroll_seat', 'exam_enroll_seat_temp', 'exam_enroll_start_time', 'exam_enroll_end_time', 'exam_enroll_date', 'LEVELID', 'Examcode', 'exam_enroll_time'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year', 'program_class', 'teacher_id', 'section_size', 'exam_enroll_seat', 'exam_enroll_seat_temp'], 'integer'],
            [['exam_enroll_date'], 'safe'],
            [['section_no', 'subject_id', 'program_id', 'exam_enroll_start_time', 'exam_enroll_end_time', 'Examcode', 'exam_enroll_time'], 'string', 'max' => 10],
            [['LEVELID'], 'string', 'max' => 50],
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class', 'teacher_id', 'Examcode'], 'unique', 'targetAttribute' => ['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class', 'teacher_id', 'Examcode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_no' => 'Section No',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'subopen_semester' => 'Subopen Semester',
            'subopen_year' => 'Subopen Year',
            'program_id' => 'Program ID',
            'program_class' => 'Program Class',
            'teacher_id' => 'Teacher ID',
            'section_size' => 'Section Size',
            'exam_enroll_seat' => 'Exam Enroll Seat',
            'exam_enroll_seat_temp' => 'Exam Enroll Seat Temp',
            'exam_enroll_start_time' => 'Exam Enroll Start Time',
            'exam_enroll_end_time' => 'Exam Enroll End Time',
            'exam_enroll_date' => 'Exam Enroll Date',
            'LEVELID' => 'Levelid',
            'Examcode' => 'Examcode',
            'exam_enroll_time' => 'Exam Enroll Time',
        ];
    }
}

<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "eoffice_exam_examination".
 *
 * @property string $rooms_id
 * @property string $room_tag
 * @property string $subject_id
 * @property int $program_class
 * @property string $exam_date
 * @property string $exam_start_time
 * @property string $exam_end_time
 */
class EofficeExamExamination extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_exam_examination';
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
            [['rooms_id', 'subject_id', 'program_class', 'exam_date', 'exam_start_time', 'exam_end_time'], 'required'],
            [['program_class'], 'integer'],
            [['exam_date'], 'safe'],
            [['rooms_id', 'subject_id', 'exam_start_time', 'exam_end_time'], 'string', 'max' => 10],
            [['room_tag'], 'string', 'max' => 2],
            [['rooms_id', 'subject_id', 'program_class', 'exam_date', 'exam_start_time', 'exam_end_time'], 'unique', 'targetAttribute' => ['rooms_id', 'subject_id', 'program_class', 'exam_date', 'exam_start_time', 'exam_end_time']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rooms_id' => 'Rooms ID',
            'room_tag' => 'Room Tag',
            'subject_id' => 'Subject ID',
            'program_class' => 'Program Class',
            'exam_date' => 'Exam Date',
            'exam_start_time' => 'Exam Start Time',
            'exam_end_time' => 'Exam End Time',
        ];
    }
    public function getSubname()
    {
        return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
    }
}

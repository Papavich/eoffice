<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "eoffice_exam_examination_item".
 *
 * @property string $STUDENTID
 * @property string $rooms_id
 * @property string $exam_date
 * @property string $exam_start_time
 * @property string $exam_end_time
 * @property string $exam_seat
 * @property string $subject_id
 */
class EofficeExamExaminationItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_exam_examination_item';
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
            [['STUDENTID', 'rooms_id', 'exam_date', 'exam_start_time', 'exam_end_time', 'exam_seat', 'subject_id'], 'required'],
            [['exam_date'], 'safe'],
            [['STUDENTID'], 'string', 'max' => 20],
            [['rooms_id', 'exam_start_time', 'exam_end_time', 'subject_id'], 'string', 'max' => 10],
            [['exam_seat'], 'string', 'max' => 3],
            [['STUDENTID', 'rooms_id', 'exam_date', 'exam_start_time', 'exam_end_time', 'subject_id'], 'unique', 'targetAttribute' => ['STUDENTID', 'rooms_id', 'exam_date', 'exam_start_time', 'exam_end_time', 'subject_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'รหัสนักศึกษา',
            'rooms_id' => 'ห้องสอบ',
            'exam_date' => 'วันที่สอบ',
            'exam_start_time' => 'เวลาเริ่มสอบ',
            'exam_end_time' => 'เวลาสิ้นสุดการสอบ',
            'exam_seat' => 'ที่นั่งสอบ',
            'subject_id' => 'รหัสวิชา',
        ];
    }
    public function getStdname()
    {
        return $this->hasOne(ViewStudentFull::className(), ['STUDENTID' => 'STUDENTID']);
    }

    public function getSubname()
    {
        return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
    }

    public function getName()
    {
        return $this->hasOne(ViewStudentFull::className(), ['STUDENTID' => 'STUDENTID']);
    }
}

<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "exam_teacher_exchange".
 *
 * @property string $exam_exchange_date
 * @property string $exam_exchange_start_time
 * @property string $exam_exchange_end_time
 * @property string $exam_exchange_note
 * @property int $person_id
 * @property string $exam_type_namethai
 * @property int $subopen_year
 * @property int $subopen_semester
 * @property string $rooms_id
 * @property string $eaxm_exchange_tel
 */
class ExamTeacherExchange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_teacher_exchange';
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
            [['exam_exchange_date', 'exam_exchange_start_time', 'exam_exchange_end_time', 'person_id'], 'required'],
            [['exam_exchange_date'], 'safe'],
            [['person_id', 'subopen_year', 'subopen_semester'], 'integer'],
            [['exam_exchange_start_time', 'exam_exchange_end_time'], 'string', 'max' => 10],
            [['exam_exchange_note', 'exam_type_namethai'], 'string', 'max' => 100],
            [['rooms_id', 'eaxm_exchange_tel'], 'string', 'max' => 11],
            [['exam_exchange_date', 'exam_exchange_start_time', 'exam_exchange_end_time', 'person_id'], 'unique', 'targetAttribute' => ['exam_exchange_date', 'exam_exchange_start_time', 'exam_exchange_end_time', 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exam_exchange_date' => 'วันที่คุมสอบ',
            'exam_exchange_start_time' => 'ตั้งแต่',
            'exam_exchange_end_time' => 'สิ้นสุด',
            'exam_exchange_note' => 'หมายเหตุ',
            'person_id' => 'รหัสกรรมการคุมสอบ',
            'exam_type_namethai' => 'ประเภทการสอบ',
            'subopen_year' => 'ปีการศึกษา',
            'subopen_semester' => 'เทอม',
            'rooms_id' => 'ห้องคุมสอบ',
            'eaxm_exchange_tel' => 'เบอร์โทรติดต่อ',
        ];
    }


    //ชื่อจริง
    public function getName()
    {
    return $this->hasOne(ViewPisPerson::className(), ['person_id' => 'person_id']);
    }

    //นามสกุล
    public function getSurname()
    {
    return $this->hasOne(ViewPisPerson::className(), ['person_id' => 'person_id']);
    }

    //เบอร์เบอร์โทรติดต่อ
    public function getMobile()
    {
    return $this->hasOne(ViewPisPerson::className(), ['person_id' => 'person_id']);
    }

    //ตำแหน่งกรรมการ
    public function getPositions()
    {
    return $this->hasOne(ViewPisPerson::className(), ['person_id' => 'person_id']);
    }

    //วันที่คุมสอบ
    public function getExamdate()
    {
    return $this->hasOne(Invigilate::className(), ['person_id' => 'person_id']);
    }

    //เวลาที่เริ่มคุมสอบ
    public function getExamstarttime()
    {
    return $this->hasOne(Invigilate::className(), ['person_id' => 'person_id']);
    }

    //เวลาที่สิ้นสุดการคุมสอบ
    public function getExamendtime()
    {
    return $this->hasOne(Invigilate::className(), ['person_id' => 'person_id']);
    }

    //ห้องสอบ
    public function getRoom()
    {
    return $this->hasOne(Invigilate::className(), ['person_id' => 'person_id']);
    }

    //กรรมการที่มาขอแลกเปลี่ยน
    public function getExchangname()
    {
    $this->person_id = $this->exam_per_exchange;  //เอา id ของจารที่ขอเปลี่ยนมาเก็บ แล้วเปลี่ยนให้เก็บในตัวแปร person_id เพื่อเอาไปเชื่อมดึงชื่อ
    return $this->hasOne(ViewPisPerson::className(), ['person_id' => 'person_id']);
    }

}

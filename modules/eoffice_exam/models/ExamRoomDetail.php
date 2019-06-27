<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "exam_room_detail".
 *
 * @property string $rooms_detail_date
 * @property string $rooms_detail_time
 * @property string $rooms_id
 * @property string $exam_room_tag
 * @property string $exam_room_status
 * @property int $exam_rooms_seat
 * @property resource $rooms_pic
 * @property int $exam_rooms_seat_temp
 */
class ExamRoomDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_room_detail';
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
            [['rooms_detail_date', 'rooms_detail_time', 'rooms_id', 'exam_room_tag', 'exam_room_status', 'exam_rooms_seat', 'rooms_pic', 'exam_rooms_seat_temp'], 'required'],
            [['rooms_detail_date'], 'safe'],
            [['exam_rooms_seat', 'exam_rooms_seat_temp'], 'integer'],
            [['rooms_pic'], 'string'],
            [['rooms_detail_time'], 'string', 'max' => 45],
            [['rooms_id'], 'string', 'max' => 11],
            [['exam_room_tag', 'exam_room_status'], 'string', 'max' => 50],
            [['rooms_detail_date', 'rooms_detail_time', 'rooms_id', 'exam_room_tag'], 'unique', 'targetAttribute' => ['rooms_detail_date', 'rooms_detail_time', 'rooms_id', 'exam_room_tag']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rooms_detail_date' => 'วันที่',
            'rooms_detail_time' => 'ช่วงเวลา',
            'rooms_id' => 'ห้อง',
            'exam_room_tag' => 'Room Tag',
            'exam_room_status' => 'สถานะ',
            'exam_rooms_seat' => 'ที่นั่ง',
            'rooms_pic' => 'Rooms Pic',
            'exam_rooms_seat_temp' => 'Exam Rooms Seat Temp',
        ];
    }
}

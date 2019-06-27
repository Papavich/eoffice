<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_room".
 *
 * @property int $room_id
 * @property string $room_name
 * @property int $room_type
 * @property int $room_seat
 * @property string $room_building
 * @property int $room_status
 */
class Kku30Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kku30_room';
    }

    /**
     * {@inheritdoc}
     */

    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['room_name', 'room_type', 'room_seat', 'room_building'], 'required'],
            [['room_type', 'room_seat', 'room_status'], 'integer'],
            [['room_name', 'room_building'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'room_name' => 'Room Name',
            'room_type' => 'Room Type',
            'room_seat' => 'Room Seat',
            'room_building' => 'Room Building',
            'room_status' => 'Room Status',
        ];
    }
}

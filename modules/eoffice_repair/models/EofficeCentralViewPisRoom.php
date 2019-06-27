<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_room".
 *
 * @property int $rooms_id
 * @property string $rooms_name
 * @property string $rooms_floor
 * @property int $rooms_capacity
 * @property string $type_name
 * @property string $type_name_eng
 * @property string $buildings_id
 * @property int $room_type_id
 */
class EofficeCentralViewPisRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_room';
    }
    public static function primaryKey()
      {
          return ['rooms_id'];
      }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_repair');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rooms_id', 'rooms_capacity', 'room_type_id'], 'integer'],
            [['type_name', 'room_type_id'], 'required'],
            [['rooms_name'], 'string', 'max' => 100],
            [['rooms_floor'], 'string', 'max' => 2],
            [['type_name', 'type_name_eng'], 'string', 'max' => 60],
            [['buildings_id'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rooms_id' => 'Rooms ID',
            'rooms_name' => 'Rooms Name',
            'rooms_floor' => 'Rooms Floor',
            'rooms_capacity' => 'Rooms Capacity',
            'type_name' => 'Type Name',
            'type_name_eng' => 'Type Name Eng',
            'buildings_id' => 'Buildings ID',
            'room_type_id' => 'Room Type ID',
        ];
    }
}

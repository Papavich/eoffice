<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property integer $room_id
 * @property string $room_name
 * @property integer $building_id
 *
 * @property RepairDescription[] $repairDescriptions
 * @property Building $building
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'room_name', 'building_id'], 'required'],
            [['room_id', 'building_id'], 'integer'],
            [['room_name'], 'string', 'max' => 5],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Building::className(), 'targetAttribute' => ['building_id' => 'building_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'ห้อง*',
            'room_name' => 'Room Name',
            'building_id' => 'Building ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairDescriptions()
    {
        return $this->hasMany(RepairDescription::className(), ['room_id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(Building::className(), ['building_id' => 'building_id']);
    }
}

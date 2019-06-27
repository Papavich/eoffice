<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "building".
 *
 * @property integer $building_id
 * @property string $building_name
 *
 * @property RepDes[] $repDes
 * @property Room[] $rooms
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_id', 'building_name'], 'required'],
            [['building_id'], 'integer'],
            [['building_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'building_id' => 'Building ID',
            'building_name' => 'อาคาร*',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepDes()
    {
        return $this->hasMany(RepDes::className(), ['building_id' => 'building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['building_id' => 'building_id']);
    }
}

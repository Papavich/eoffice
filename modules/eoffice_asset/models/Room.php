<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $rooms_id
 * @property string $rooms_name
 * @property string $rooms_floor
 * @property int $rooms_capacity
 * @property string $buildings_id
 *
 * @property Buildings $buildings
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rooms_capacity'], 'integer'],
            [['rooms_name'], 'string', 'max' => 100],
            [['rooms_floor'], 'string', 'max' => 2],
            [['buildings_id'], 'string', 'max' => 4],
            [['buildings_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buildings::className(), 'targetAttribute' => ['buildings_id' => 'buildings_id']],
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
            'buildings_id' => 'Buildings ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildings()
    {
        return $this->hasOne(Buildings::className(), ['buildings_id' => 'buildings_id']);
    }
}

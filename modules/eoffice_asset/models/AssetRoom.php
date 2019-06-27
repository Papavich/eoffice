<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_room".
 *
 * @property int $room_id
 * @property string $room_name
 * @property int $building_id
 */
class AssetRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_room';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_asset');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room_id', 'room_name'], 'required'],
            [['room_id', 'building_id'], 'integer'],
            [['room_name'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'room_id' => 'Room ID',
            'room_name' => 'Room Name',
            'building_id' => 'Building ID',
        ];
    }
}
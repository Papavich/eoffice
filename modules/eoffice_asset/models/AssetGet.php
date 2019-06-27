<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_get".
 *
 * @property int $asset_get_id
 * @property string $asset_get_name
 */
class AssetGet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_get';
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
            [['asset_get_id', 'asset_get_name'], 'required'],
            [['asset_get_id'], 'integer'],
            [['asset_get_name'], 'string', 'max' => 100],
            [['asset_get_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_get_id' => 'Asset Get ID',
            'asset_get_name' => 'Asset Get Name',
        ];
    }
}

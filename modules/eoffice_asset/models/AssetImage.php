<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_image".
 *
 * @property int $asset_image_id
 * @property string $asset_image_name
 * @property string $asset_image_type
 * @property int $asset_image_size
 * @property int $asset_image_sortorder
 */
class AssetImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_image';
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
            [['asset_image_size', 'asset_image_sortorder'], 'integer'],
            [['asset_image_name', 'asset_image_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_image_id' => 'Asset Image ID',
            'asset_image_name' => 'Asset Image Name',
            'asset_image_type' => 'Asset Image Type',
            'asset_image_size' => 'Asset Image Size',
            'asset_image_sortorder' => 'Asset Image Sortorder',
        ];
    }

    /**
     * @inheritdoc
     * @return AssetImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AssetImageQuery(get_called_class());
    }
}

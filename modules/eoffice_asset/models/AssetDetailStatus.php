<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_detail_status".
 *
 * @property int $asset_status_id
 * @property string $asset_status_name
 *
 * @property AssetDetail[] $assetDetails
 */
class AssetDetailStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_detail_status';
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
            [['asset_status_id'], 'required'],
            [['asset_status_id'], 'integer'],
            [['asset_status_name'], 'string', 'max' => 50],
            [['asset_status_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_status_id' => 'Asset Status ID',
            'asset_status_name' => 'Asset Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

}

<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_type_university".
 *
 * @property integer $asset_type_univ_id
 * @property string $asset_type_univ_name
 * @property string $asset_type_univ_code
 */
class AssetTypeUniversity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_type_university';
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
            [['asset_type_univ_id', 'asset_type_univ_name', 'asset_type_univ_code'], 'required'],
            [['asset_type_univ_id'], 'integer'],
            [['asset_type_univ_name'], 'string', 'max' => 60],
            [['asset_type_univ_code'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_type_univ_id' => 'Asset Type Univ ID',
            'asset_type_univ_name' => 'Asset Type Univ Name',
            'asset_type_univ_code' => 'Asset Type Univ Code',
        ];
    }
}

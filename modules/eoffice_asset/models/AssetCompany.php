<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_company".
 *
 * @property integer $asset_company_id
 * @property string $asset_company_name
 * @property string $asset_company_address
 * @property string $asset_company_phone
 * @property string $asset_company_email
 */
class AssetCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_company';
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
            [['asset_company_name', 'asset_company_address', 'asset_company_phone', 'asset_company_email'], 'required'],
            [['asset_company_name', 'asset_company_address'], 'string', 'max' => 100],
            [['asset_company_phone'], 'string', 'max' => 12],
            [['asset_company_email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_company_id' => 'Asset Company ID',
            'asset_company_name' => 'ชื่อบริษัท์',
            'asset_company_address' => 'ที่อยู่บริษัท',
            'asset_company_phone' => 'เบอร์ติดต่อ',
            'asset_company_email' => 'อีเมลล์',
        ];
    }
}

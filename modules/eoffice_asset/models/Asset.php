<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset".
 *
 * @property int $asset_id
 * @property string $asset_date
 * @property string $asset_year
 * @property int $asset_get
 * @property int $asset_budget
 * @property int $asset_company
 *
 * @property AssetDetail[] $assetDetails
 */
class Asset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset';
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
            [['asset_date', 'asset_year', 'asset_get', 'asset_budget', 'asset_company'], 'required'],
            [['asset_date'], 'safe'],
            [['asset_get', 'asset_budget', 'asset_company'], 'integer'],
            [['asset_year'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //  'asset_id' => 'Asset ID',
            'asset_date' => 'วันที่นำเข้า',
            'asset_year' => 'ปีงบประมาณ',
            'asset_get' => 'วิธีการที่ได้มา',
            'asset_budget' => 'จำนวนเงินงบประมาณ',
            'asset_company' => 'ผู้ขาย/บริษัท',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetDetails()
    {
        return $this->hasMany(AssetDetail::className(), ['asset_asset_id' => 'asset_id']);
    }
}

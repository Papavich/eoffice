<?php

namespace app\modules\eoffice_repair\models;

use Yii;

/**
 * This is the model class for table "eoffice_asset.view_asset".
 *
 * @property int $asset_detail_id
 * @property string $asset_univ_code_start
 * @property string $asset_univ_type
 * @property string $asset_dept_code_start
 * @property int $asset_dept_type
 * @property string $asset_detail_name
 * @property string $asset_detail_brand
 * @property int $asset_detail_amount
 * @property int $asset_detail_age
 * @property int $asset_detail_price
 * @property int $asset_detail_price_wreck
 * @property int $asset_detail_insurance
 * @property string $asset_detail_building
 * @property int $asset_detail_room
 * @property int $asset_asset_id
 */
class EofficeAssetViewAsset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_asset.view_asset';
    }
    public static function primaryKey()
      {
          return ['asset_detail_id'];
      }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_repair');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asset_detail_id', 'asset_dept_type', 'asset_detail_amount', 'asset_detail_age', 'asset_detail_price', 'asset_detail_price_wreck', 'asset_detail_insurance', 'asset_detail_room', 'asset_asset_id'], 'integer'],
            [['asset_univ_code_start', 'asset_univ_type', 'asset_dept_code_start', 'asset_dept_type', 'asset_detail_name', 'asset_detail_brand', 'asset_detail_amount', 'asset_detail_age', 'asset_detail_price', 'asset_detail_price_wreck', 'asset_detail_insurance', 'asset_detail_building', 'asset_detail_room', 'asset_asset_id'], 'required'],
            [['asset_univ_code_start'], 'string', 'max' => 13],
            [['asset_univ_type', 'asset_detail_name', 'asset_detail_brand'], 'string', 'max' => 100],
            [['asset_dept_code_start'], 'string', 'max' => 12],
            [['asset_detail_building'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'asset_detail_id' => 'หมายเลขครุภัณฑ์',
            'asset_univ_code_start' => 'Asset Univ Code Start',
            'asset_univ_type' => 'Asset Univ Type',
            'asset_dept_code_start' => 'หมายเลขครุภัณฑ์',
            'asset_dept_type' => 'Asset Dept Type',
            'asset_detail_name' => 'ชื่อครุภัณฑ์',
            'asset_detail_brand' => 'Asset Detail Brand',
            'asset_detail_amount' => 'Asset Detail Amount',
            'asset_detail_age' => 'Asset Detail Age',
            'asset_detail_price' => 'Asset Detail Price',
            'asset_detail_price_wreck' => 'Asset Detail Price Wreck',
            'asset_detail_insurance' => 'Asset Detail Insurance',
            'asset_detail_building' => 'Asset Detail Building',
            'asset_detail_room' => 'Asset Detail Room',
            'asset_asset_id' => 'Asset Asset ID',
        ];
    }
    public function getBuilding()
    {
        return $this->hasOne(EofficeCentralViewPisRoom::className(), ['rooms_id' => 'asset_detail_building']);
    }
}

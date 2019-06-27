<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_detail".
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
 * @property int $asset_detail_image
 *
 * @property Asset $assetAsset
 */
class AssetDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_detail';
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
            [['asset_asset_id', 'asset_univ_code_start', 'asset_univ_type', 'asset_dept_code_start', 'asset_dept_type', 'asset_detail_name', 'asset_detail_brand', 'asset_detail_amount', 'asset_detail_age', 'asset_detail_price', 'asset_detail_price_wreck', 'asset_detail_insurance', 'asset_detail_building', 'asset_detail_room'], 'required'],
            [['asset_asset_id', 'asset_dept_type', 'asset_detail_amount', 'asset_detail_age', 'asset_detail_price', 'asset_detail_price_wreck', 'asset_detail_insurance', 'asset_detail_room'], 'integer'],
            [['asset_univ_code_start'], 'string', 'max' => 13],
            [['asset_univ_type', 'asset_detail_name', 'asset_detail_brand', 'asset_detail_status'], 'string', 'max' => 100],
            [['asset_dept_code_start'], 'string', 'max' => 12],
            [['asset_detail_building'], 'string', 'max' => 4],
            [['asset_detail_image'], 'string', 'max' => 250],
            [['asset_asset_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asset::className(), 'targetAttribute' => ['asset_asset_id' => 'asset_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {


        return [
            'asset_univ_code_start' => 'รหัสครุภัณฑ์มหาวิทยาลัย',
            'asset_univ_type' => 'ประเภทครุภัณฑ์ (มหาวิทยาลัย)',
            'asset_dept_code_start' => 'รหัสครุภัณฑ์ภาควิชา',
            'asset_dept_type' => 'ประเภทครุภัณฑ์ (มหาวิทยาลัย)',
            'asset_detail_name' => 'ชื่อรายการครุภัณฑ์',
            'asset_detail_brand' => 'ยี่ห้อ/ลักษณะ',
            'asset_detail_amount' => 'จำนวน',
            'asset_detail_age' => 'อายุการใช้งาน(ปี)',
            'asset_detail_price' => 'ราคาต่อหน่วย',
            'asset_detail_price_wreck' => 'ราคาซาก',
            'asset_detail_insurance' => 'ระยะประกัน',
            'asset_detail_building' => 'อาคาร',
            'asset_detail_room' => 'ห้อง',
           // 'asset_detail_pic' => 'รูปตัวอย่างครุภัณฑ์',
            'asset_asset_id' => 'Asset Asset ID',
            'asset_detail_image' => 'รูปตัวอย่างครุภัณฑ์',
            'asset_detail_status' => 'สถานะ'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetAsset()
    {
        return $this->hasOne(Asset::className(), ['asset_id' => 'asset_asset_id']);
    }





    /**
     * @inheritdoc
     * @return AQuery the active query used by this AR class.
     */

}


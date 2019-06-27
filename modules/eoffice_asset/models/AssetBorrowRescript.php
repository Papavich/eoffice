<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_borrow_rescript".
 *
 * @property int $borrow_rescript_id
 * @property int $asset_borrow_detail_id
 * @property string $borrow_rescript_date
 * @property string $borrow_rescript_time
 * @property string $borrow_rescript_location
 * @property string $borrow_rescript_staff
 *
 * @property AssetBorrowDetail $assetBorrowDetail
 */
class AssetBorrowRescript extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_borrow_rescript';
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
            [['asset_borrow_detail_id'], 'integer'],
            [['borrow_rescript_date', 'borrow_rescript_time'], 'safe'],
            [['borrow_rescript_location'], 'string', 'max' => 150],
            [['borrow_rescript_staff'], 'string', 'max' => 100],
            [['asset_borrow_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetBorrowDetail::className(), 'targetAttribute' => ['asset_borrow_detail_id' => 'borrow_detail_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borrow_rescript_id' => 'Borrow Rescript ID', //ไม่กรอก

            'borrow_rescript_date' => 'วันรับครุภัณฑ์',
            'borrow_rescript_time' => 'เวลารับครุภัณฑ์',
            'borrow_rescript_location' => 'สถานที่รับครุภัณฑ์',
            'asset_borrow_detail_id' => 'Asset Borrow Detail ID', //ไม่ได้กรอก
            'borrow_rescript_staff' => 'เจ้าหน้าที่ผู้ดูแล',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetBorrowDetail()
    {
        return $this->hasOne(AssetBorrowDetail::className(), ['borrow_detail_id' => 'asset_borrow_detail_id']);
    }
}

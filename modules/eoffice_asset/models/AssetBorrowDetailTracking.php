<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_borrow_detail_tracking".
 *
 * @property int $borrow_rescript_tracking_id
 * @property int $asset_borrow_status
 * @property string $borrow_rescript_tracking_date
 * @property string $asset_borrow_detail_trackingcol
 * @property int $asset_borrow_detail_id
 *
 * @property AssetBorrowDetail $assetBorrowDetail
 */
class AssetBorrowDetailTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_borrow_detail_tracking';
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
            [['asset_borrow_status', 'asset_borrow_detail_id'], 'integer'],
            [['borrow_rescript_tracking_date'], 'safe'],
            [['asset_borrow_detail_trackingcol'], 'string', 'max' => 45],
            [['asset_borrow_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetBorrowDetail::className(), 'targetAttribute' => ['asset_borrow_detail_id' => 'borrow_detail_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borrow_rescript_tracking_id' => 'Borrow Rescript Tracking ID',
            'asset_borrow_status' => 'Asset Borrow Status',
            'borrow_rescript_tracking_date' => 'Borrow Rescript Tracking Date',
            'asset_borrow_detail_trackingcol' => 'Asset Borrow Detail Trackingcol',
            'asset_borrow_detail_id' => 'Asset Borrow Detail ID',
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

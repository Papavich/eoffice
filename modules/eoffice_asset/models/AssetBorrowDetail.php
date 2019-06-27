<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_borrow_detail".
 *
 * @property int $borrow_detail_id
 * @property int $asset_borrow_id
 * @property int $borrow_detail_asset_id
 * @property int $borrow_detail_status
 *
 * @property AssetBorrow $assetBorrow
 * @property AssetBorrowStatus $borrowDetailStatus
 * @property AssetBorrowDetailTracking[] $assetBorrowDetailTrackings
 * @property AssetBorrowRescript[] $assetBorrowRescripts
 */
class AssetBorrowDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_borrow_detail';
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
            [['asset_borrow_id', 'borrow_detail_asset_id', 'borrow_detail_status'], 'integer'],
            [['asset_borrow_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetBorrow::className(), 'targetAttribute' => ['asset_borrow_id' => 'borrow_id']],
            [['borrow_detail_status'], 'exist', 'skipOnError' => true, 'targetClass' => AssetBorrowStatus::className(), 'targetAttribute' => ['borrow_detail_status' => 'status_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borrow_detail_id' => 'Borrow Detail ID',
            'asset_borrow_id' => 'Asset Borrow ID',
            'borrow_detail_asset_id' => 'Borrow Detail Asset ID',
            'borrow_detail_status' => 'Borrow Detail Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetBorrow()
    {
        return $this->hasOne(AssetBorrow::className(), ['borrow_id' => 'asset_borrow_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowDetailStatus()
    {
        return $this->hasOne(AssetBorrowStatus::className(), ['status_id' => 'borrow_detail_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetBorrowDetailTrackings()
    {
        return $this->hasMany(AssetBorrowDetailTracking::className(), ['asset_borrow_detail_id' => 'borrow_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetBorrowRescripts()
    {
        return $this->hasMany(AssetBorrowRescript::className(), ['asset_borrow_detail_id' => 'borrow_detail_id']);
    }
}
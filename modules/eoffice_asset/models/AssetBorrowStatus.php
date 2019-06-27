<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_borrow_status".
 *
 * @property int $status_id
 * @property string $status_name
 *
 * @property AssetBorrowDetail[] $assetBorrowDetails
 */
class AssetBorrowStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_borrow_status';
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
            [['status_id'], 'required'],
            [['status_id'], 'integer'],
            [['status_name'], 'string', 'max' => 150],
            [['status_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_name' => 'Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetBorrowDetails()
    {
        return $this->hasMany(AssetBorrowDetail::className(), ['borrow_detail_status' => 'status_id']);
    }
}
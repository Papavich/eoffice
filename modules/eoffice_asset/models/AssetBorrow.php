<?php

namespace app\modules\eoffice_asset\models;

use Yii;

/**
 * This is the model class for table "asset_borrow".
 *
 * @property int $borrow_id
 * @property string $borrow_user_fname
 * @property string $borrow_user_lname
 * @property string $borrow_user_tel
 * @property string $borrow_date
 * @property string $borrow_object
 *
 * @property AssetBorrowDetail[] $assetBorrowDetails
 */
class AssetBorrow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asset_borrow';
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
            [['borrow_date'], 'safe'],
            [['borrow_user_fname', 'borrow_user_lname'], 'string', 'max' => 45],
            [['borrow_user_tel'], 'string', 'max' => 11],
            [['borrow_object'], 'string', 'max' => 300],
            ['borrow_id', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borrow_id' => 'Borrow ID',
            'borrow_user_fname' => 'ชื่อ',
            'borrow_user_lname' => 'นามสกุล',
            'borrow_user_tel' => 'Borrow User Tel',
            'borrow_date' => 'วันที่ยื่นคำร้อง',
            'borrow_object' => 'ความประสงค์ในการใช้งาน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetBorrowDetails()
    {
        return $this->hasMany(AssetBorrowDetail::className(), ['asset_borrow_id' => 'borrow_id']);
    }
}
<?php

namespace app\modules\eoffice_eolmv2\models;

use app\modules\eoffice_eolmv2\controllers;
use Yii;

/**
 * This is the model class for table "eolm_hotel".
 *
 * @property int $eolm_hotel_id
 * @property string $eolm_hotel_name
 * @property string $eolm_hotel_address
 *
 * @property EolmReceiptHotel[] $eolmReceiptHotels
 * @property EolmApprovalform[] $eolmApps
 */
class EolmHotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_hotel';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolmv2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_hotel_name'], 'string', 'max' => 100],
            [['eolm_hotel_address'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_hotel_id' => controllers::t('label','hotel id'),
            'eolm_hotel_name' => controllers::t('label','Name of stay'),
            'eolm_hotel_address' => controllers::t('label','Address of stay'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmReceiptHotels()
    {
        return $this->hasMany(EolmReceiptHotel::className(), ['eolm_hotel_id' => 'eolm_hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApps()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id'])->viaTable('eolm_receipt_hotel', ['eolm_hotel_id' => 'eolm_hotel_id']);
    }
}

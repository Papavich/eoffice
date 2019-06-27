<?php

namespace app\modules\eoffice_eolmv2\models;

use app\modules\eoffice_eolmv2\controllers;
use Yii;

/**
 * This is the model class for table "eolm_receipt_hotel".
 *
 * @property int $eolm_app_id
 * @property int $eolm_hotel_id
 * @property string $eolm_rec_hotel_stay_date
 * @property string $eolm_rec_hotel_checkout_date
 * @property int $eolm_rec_hotel_room_amount
 * @property int $eolm_rec_hotel_nights_amount
 * @property int $eolm_rec_hotel_price_per_room
 * @property string $eolm_rec_hotel_amount
 * @property string $eolm_rec_hotel_amount_text
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property EolmHotel $eolmHotel
 * @property EolmApprovalform $eolmApp
 * @property EolmReceiptHotelDetails[] $eolmReceiptHotelDetails
 */
class EolmReceiptHotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_receipt_hotel';
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
            [[/*'eolm_app_id',*/ 'eolm_hotel_id', 'eolm_rec_hotel_room_amount', 'eolm_rec_hotel_nights_amount', 'eolm_rec_hotel_price_per_room'], 'required'],
            [['eolm_app_id', 'eolm_hotel_id', 'eolm_rec_hotel_room_amount', 'eolm_rec_hotel_nights_amount', 'eolm_rec_hotel_price_per_room', 'crby', 'udby'], 'integer'],
            [['eolm_rec_hotel_stay_date', 'eolm_rec_hotel_checkout_date', 'crtime', 'udtime'], 'safe'],
            [['eolm_rec_hotel_amount'], 'number'],
            [['eolm_rec_hotel_amount_text'], 'string', 'max' => 200],
            [['eolm_app_id', 'eolm_hotel_id'], 'unique', 'targetAttribute' => ['eolm_app_id', 'eolm_hotel_id']],
            [['eolm_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmHotel::className(), 'targetAttribute' => ['eolm_hotel_id' => 'eolm_hotel_id']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'แบบขออนุมัติเดินทาง',
            'eolm_hotel_id' => controllers::t( 'label','Stay at'),
            'eolm_rec_hotel_stay_date' => controllers::t( 'label','Check in date'),
            'eolm_rec_hotel_checkout_date' => controllers::t( 'label','Check out date'),
            'eolm_rec_hotel_room_amount' => controllers::t( 'label','Number of stay (room)'),
            'eolm_rec_hotel_nights_amount' => controllers::t( 'label','Number (night)'),
            'eolm_rec_hotel_price_per_room' => controllers::t( 'label','Rates are per room (bath)'),
            'eolm_rec_hotel_amount' => controllers::t( 'label','Total'),
            'eolm_rec_hotel_amount_text' => controllers::t( 'label','Total(text)'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmHotel()
    {
        return $this->hasOne(EolmHotel::className(), ['eolm_hotel_id' => 'eolm_hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmReceiptHotelDetails()
    {
        return $this->hasMany(EolmReceiptHotelDetails::className(), ['eolm_app_id' => 'eolm_app_id', 'eolm_hotel_id' => 'eolm_hotel_id']);
    }
}

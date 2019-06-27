<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_receipt_hotel_details".
 *
 * @property int $eolm_app_id
 * @property int $eolm_hotel_id
 * @property string $eolm_rec_hotel_details_room_name
 *
 * @property EolmReceiptHotel $eolmApp
 * @property EolmReceiptHotelDetailsPersonal[] $eolmReceiptHotelDetailsPersonals
 */
class EolmReceiptHotelDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_receipt_hotel_details';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'eolm_app_id', 'eolm_hotel_id',*/ 'eolm_rec_hotel_details_room_name'], 'required'],
            [['eolm_app_id', 'eolm_hotel_id'], 'integer'],
            [['eolm_rec_hotel_details_room_name'], 'string', 'max' => 100],
            [['eolm_app_id', 'eolm_hotel_id', 'eolm_rec_hotel_details_room_name'], 'unique', 'targetAttribute' => ['eolm_app_id', 'eolm_hotel_id', 'eolm_rec_hotel_details_room_name']],
            [['eolm_app_id', 'eolm_hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmReceiptHotel::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id', 'eolm_hotel_id' => 'eolm_hotel_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'Eolm App ID',
            'eolm_hotel_id' => 'Eolm Hotel ID',
            'eolm_rec_hotel_details_room_name' => 'Eolm Rec Hotel Details Room Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmReceiptHotel::className(), ['eolm_app_id' => 'eolm_app_id', 'eolm_hotel_id' => 'eolm_hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmReceiptHotelDetailsPersonals()
    {
        return $this->hasMany(EolmReceiptHotelDetailsPersonal::className(), ['eolm_app_id' => 'eolm_app_id', 'eolm_hotel_id' => 'eolm_hotel_id', 'eolm_rec_hotel_details_room_name' => 'eolm_rec_hotel_details_room_name']);
    }
}

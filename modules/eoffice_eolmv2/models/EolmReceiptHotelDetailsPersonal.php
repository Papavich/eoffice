<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_receipt_hotel_details_personal".
 *
 * @property int $eolm_app_id
 * @property int $eolm_hotel_id
 * @property string $eolm_rec_hotel_details_room_name
 * @property int $person_id
 * @property string $eolm_rec_hotel_details_personal_amount
 *
 * @property Person $person
 * @property EolmReceiptHotelDetails $eolmApp
 */
class EolmReceiptHotelDetailsPersonal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_receipt_hotel_details_personal';
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
            [[/*'eolm_app_id', 'eolm_hotel_id', 'eolm_rec_hotel_details_room_name', */'person_id'], 'required'],
            [['eolm_app_id', 'eolm_hotel_id', 'person_id'], 'integer'],
            [['eolm_rec_hotel_details_personal_amount'], 'number'],
            [['eolm_rec_hotel_details_room_name'], 'string', 'max' => 100],
            [['eolm_app_id', 'eolm_hotel_id', 'eolm_rec_hotel_details_room_name'], 'exist', 'skipOnError' => true, 'targetClass' => EolmReceiptHotelDetails::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id', 'eolm_hotel_id' => 'eolm_hotel_id', 'eolm_rec_hotel_details_room_name' => 'eolm_rec_hotel_details_room_name']],
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
            'person_id' => 'Person ID',
            'eolm_rec_hotel_details_personal_amount' => 'Eolm Rec Hotel Details Personal Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmReceiptHotelDetails::className(), ['eolm_app_id' => 'eolm_app_id', 'eolm_hotel_id' => 'eolm_hotel_id', 'eolm_rec_hotel_details_room_name' => 'eolm_rec_hotel_details_room_name']);
    }
}

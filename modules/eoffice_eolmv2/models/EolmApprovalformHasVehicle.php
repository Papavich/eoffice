<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_approvalform_has_vehicle".
 *
 * @property int $eolm_app_id
 * @property int $eolm_vehicle_type_id
 * @property string $eolm_vehicle_detail
 * @property int $eolm_vehicle_amount_date
 * @property string $eolm_vehicle_amount
 *
 * @property EolmApprovalform $eolmApp
 * @property EolmBorrowingplansType $eolmVehicleType
 */
class EolmApprovalformHasVehicle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_approvalform_has_vehicle';
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
            [['eolm_app_id', 'eolm_vehicle_type_id', 'eolm_vehicle_amount_date', 'eolm_vehicle_amount'], 'required'],
            [['eolm_app_id', 'eolm_vehicle_type_id', 'eolm_vehicle_amount_date'], 'integer'],
            [['eolm_vehicle_amount'], 'number'],
            [['eolm_vehicle_detail'], 'string', 'max' => 100],
            [['eolm_app_id', 'eolm_vehicle_type_id'], 'unique', 'targetAttribute' => ['eolm_app_id', 'eolm_vehicle_type_id']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
            [['eolm_vehicle_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmBorrowingplansType::className(), 'targetAttribute' => ['eolm_vehicle_type_id' => 'eolm_bor_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'Eolm App ID',
            'eolm_vehicle_type_id' => 'Eolm Vehicle Type ID',
            'eolm_vehicle_detail' => 'Eolm Vehicle Detail',
            'eolm_vehicle_amount_date' => 'Eolm Vehicle Amount Date',
            'eolm_vehicle_amount' => 'Eolm Vehicle Amount',
        ];
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
    public function getEolmVehicleType()
    {
        return $this->hasOne(EolmBorrowingplansType::className(), ['eolm_bor_type_id' => 'eolm_vehicle_type_id']);
    }
}

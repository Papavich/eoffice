<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_borrowingplans_type".
 *
 * @property int $eolm_bor_type_id
 * @property string $eolm_bor_type_name
 *
 * @property EolmApprovalformHasVehicle[] $eolmApprovalformHasVehicles
 * @property EolmApprovalform[] $eolmApps
 * @property EolmBorrowingplansItem $eolmBorrowingplansItem
 */
class EolmBorrowingplansType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_borrowingplans_type';
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
            [['eolm_bor_type_id', 'eolm_bor_type_name'], 'required'],
            [['eolm_bor_type_id'], 'integer'],
            [['eolm_bor_type_name'], 'string', 'max' => 100],
            [['eolm_bor_type_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_bor_type_id' => 'Eolm Bor Type ID',
            'eolm_bor_type_name' => 'Eolm Bor Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasVehicles()
    {
        return $this->hasMany(EolmApprovalformHasVehicle::className(), ['eolm_vehicle_type_id' => 'eolm_bor_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApps()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id'])->viaTable('eolm_approvalform_has_vehicle', ['eolm_vehicle_type_id' => 'eolm_bor_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBorrowingplansItem()
    {
        return $this->hasOne(EolmBorrowingplansItem::className(), ['eolm_bor_type_id' => 'eolm_bor_type_id']);
    }
}

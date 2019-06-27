<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "matsys_bill_detail".
 *
 * @property string $material_id
 * @property string $bill_master_id
 * @property int $bill_detail_price_per_unit ราคาต่อหน่วย
 * @property int $bill_detaill_amount จำนวนทั้งหมด
 * @property int $bill_detail_use_amount
 * @property int $bill_detail_counter
 *
 * @property MatsysBillMaster $billMaster
 * @property MatsysMaterial $material
 * @property MatsysOrderHasMaterial[] $matsysOrderHasMaterials
 * @property MatsysOrder[] $orderIdAis
 * @property MatsysOrderReturn[] $matsysOrderReturns
 * @property MatsysOrder[] $orderIdAis0
 */
class MatsysBillDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_bill_detail';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mat');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material_id', 'bill_master_id'], 'required'],
            [['bill_detail_price_per_unit', 'bill_detaill_amount', 'bill_detail_use_amount', 'bill_detail_counter'], 'integer'],
            [['material_id', 'bill_master_id'], 'string', 'max' => 20],
            [['material_id', 'bill_master_id'], 'unique', 'targetAttribute' => ['material_id', 'bill_master_id']],
            [['bill_master_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysBillMaster::className(), 'targetAttribute' => ['bill_master_id' => 'bill_master_id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysMaterial::className(), 'targetAttribute' => ['material_id' => 'material_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'material_id' => 'Material ID',
            'bill_master_id' => 'Bill Master ID',
            'bill_detail_price_per_unit' => 'Bill Detail Price Per Unit',
            'bill_detaill_amount' => 'Bill Detaill Amount',
            'bill_detail_use_amount' => 'Bill Detail Use Amount',
            'bill_detail_counter' => 'Bill Detail Counter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillMaster()
    {
        return $this->hasOne(MatsysBillMaster::className(), ['bill_master_id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(MatsysMaterial::className(), ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrderHasMaterials()
    {
        return $this->hasMany(MatsysOrderHasMaterial::className(), ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderIdAis()
    {
        return $this->hasMany(MatsysOrder::className(), ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id'])->viaTable('matsys_order_has_material', ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrderReturns()
    {
        return $this->hasMany(MatsysOrderReturn::className(), ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderIdAis0()
    {
        return $this->hasMany(MatsysOrder::className(), ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id'])->viaTable('matsys_order_return', ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id']);
    }
    static public function dateThai($date){
        $date_result = explode("-",$date);
        $day = $date_result[2];
        $month = $date_result[1];
        switch ($date_result[1]){
            case "01":$month="มกราคม";break;
            case "02":$month="กุมภาพันธ์";break;
            case "03":$month="มีนาคม";break;
            case "04":$month="เมษายน";break;
            case "05":$month="พฤษภาคม";break;
            case "06":$month="มิถุนายน";break;
            case "07":$month="กรกฎาคม";break;
            case "08":$month="สิงหาคม";break;
            case "09":$month="กันยายน";break;
            case "10":$month="ตุลาคม";break;
            case "11":$month="พฤศจิกายน";break;
            case "12":$month="ธันวาคม";break;
        }
        $year = $date_result[0]+543;
        return $day." ".$month." ".$year;
    }
}

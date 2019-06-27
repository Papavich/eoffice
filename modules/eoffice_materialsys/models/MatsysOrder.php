<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "matsys_order".
 *
 * @property string $order_id รหัสใบเบิกวัสดุ
 * @property string $person_id รหัสผู้เบิกวัสดุ
 * @property string $order_date วันที่ใบเบิกวัสดุ
 * @property string $order_date_accept วันที่อนุมัติ
 * @property string $order_staff ชื่อผู้อนุมัติ
 * @property string $order_status สถานะการอนุมัติ
 * @property string $order_status_confirm สถานะการยืนยันการเบิกวัสดุ
 * @property string $order_status_notification สถานะการอ่านแจ้งเตือน
 * @property string $order_status_return สถานะการคืนวัสดุ
 * @property string $order_budget_per_year งบประมาณประจำปี
 * @property string $order_cancel_description
 * @property int $order_id_ai
 * @property string $order_detail_id
 *
 * @property MatsysOrderDetail $orderDetail
 * @property MatsysOrderHasMaterial[] $matsysOrderHasMaterials
 * @property MatsysBillDetail[] $materials
 * @property MatsysOrderReturn[] $matsysOrderReturns
 * @property MatsysBillDetail[] $materials0
 */
class MatsysOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_order';
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
            [['order_id', 'order_detail_id'], 'required'],
            [['order_date', 'order_date_accept'], 'safe'],
            [['order_id', 'order_detail_id'], 'string', 'max' => 20],
            [['person_id', 'order_status_confirm', 'order_status_notification'], 'string', 'max' => 45],
            [['order_staff'], 'string', 'max' => 80],
            [['order_status', 'order_status_return'], 'string', 'max' => 1],
            [['order_budget_per_year'], 'string', 'max' => 5],
            [['order_cancel_description'], 'string', 'max' => 150],
            [['order_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysOrderDetail::className(), 'targetAttribute' => ['order_detail_id' => 'order_detail_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'รหัสใบเบิกวัสดุ',
            'person_id' => 'รหัสผู้เบิกวัสดุ',
            'order_date' => 'วันที่เบิกวัสดุ',
            'order_date_accept' => 'วันที่อนุมัติ',
            'order_staff' => 'ชื่อผู้อนุมัติ',
            'order_status' => 'สถานะการอนุมัติ',
            'order_status_confirm' => 'สถานะการยืนยันการเบิกวัสดุ',
            'order_status_notification' => 'สถานะการอ่านการแจ้งเตือน',
            'order_status_return' => 'สถานะการคืนวัสดุ',
            'order_budget_per_year' => 'งบประมาณประจำปี',
            'order_cancel_description' => 'รายละเอียดการเบิก',
            'order_id_ai' => 'Order Id Ai',
            'order_detail_id' => 'Order Detail ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetail()
    {
        return $this->hasOne(MatsysOrderDetail::className(), ['order_detail_id' => 'order_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrderHasMaterials()
    {
        return $this->hasMany(MatsysOrderHasMaterial::className(), ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(MatsysBillDetail::className(), ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id'])->viaTable('matsys_order_has_material', ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrderReturns()
    {
        return $this->hasMany(MatsysOrderReturn::className(), ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials0()
    {
        return $this->hasMany(MatsysBillDetail::className(), ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id'])->viaTable('matsys_order_return', ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id']);
    }
    public static function searchConfirmbill($id)
    {
        $bill = MatsysOrder::find()->where('person_id = :person_id', [':person_id' => $id])
            ->andWhere('order_status_confirm = :order_status_confirm', [':order_status_confirm' => 'unconfirm'])->one();
        if($bill == null){
            return 'false';
        }else{
            return $bill;
        }
    }
}

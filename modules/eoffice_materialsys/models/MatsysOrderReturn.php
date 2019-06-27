<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "matsys_order_return".
 *
 * @property string $order_return_date วันที่คืนวัสดุ
 * @property string $order_return_date_accept วันที่อนุมัติการคืน
 * @property int $order_return_amount จำนวนที่สั่งคืน 
 * @property int $order_return_amount_use จำนวนที่ใช้ได้จริง
 * @property int $order_id_ai
 * @property string $order_id
 * @property string $material_id
 * @property string $bill_master_id
 *
 * @property MatsysBillDetail $material
 * @property MatsysOrder2 $orderIdAi
 */
class MatsysOrderReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_order_return';
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
            [['order_return_date', 'order_return_date_accept'], 'safe'],
            [['order_return_amount', 'order_return_amount_use', 'order_id_ai'], 'integer'],
            [['order_id_ai', 'order_id', 'material_id', 'bill_master_id'], 'required'],
            [['order_id', 'material_id', 'bill_master_id'], 'string', 'max' => 20],
            [['order_id_ai', 'order_id', 'material_id', 'bill_master_id'], 'unique', 'targetAttribute' => ['order_id_ai', 'order_id', 'material_id', 'bill_master_id']],
            [['material_id', 'bill_master_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysBillDetail::className(), 'targetAttribute' => ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id']],
            [['order_id_ai', 'order_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysOrder::className(), 'targetAttribute' => ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_return_date' => 'วันที่คืน',
            'order_return_date_accept' => 'วันที่ตรวจสอบการคืน',
            'order_return_amount' => 'จำนวนที่คืน',
            'order_return_amount_use' => 'จำนวนที่ใช้ได้จริง',
            'order_id_ai' => 'Order Id Ai',
            'order_id' => 'รหัสใบเบิก',
            'material_id' => 'รหัสวัสดุ',
            'bill_master_id' => 'Bill Master ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(MatsysBillDetail::className(), ['material_id' => 'material_id', 'bill_master_id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderIdAi()
    {
        return $this->hasOne(MatsysOrder::className(), ['order_id_ai' => 'order_id_ai', 'order_id' => 'order_id']);
    }
}

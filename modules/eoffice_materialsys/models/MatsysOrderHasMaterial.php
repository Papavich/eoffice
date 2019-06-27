<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "matsys_order_has_material".
 *
 * @property int $material_amount จำนวนที่เบิก
 * @property int $material_amount_receive
 * @property int $order_id_ai
 * @property string $order_id
 * @property string $material_id
 * @property string $bill_master_id
 *
 * @property MatsysBillDetail $material
 * @property MatsysOrder2 $orderIdAi
 */
class MatsysOrderHasMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_order_has_material';
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
            [['material_amount', 'material_amount_receive', 'order_id_ai'], 'integer'],
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
            'material_amount' => 'Material Amount',
            'material_amount_receive' => 'Material Amount Receive',
            'order_id_ai' => 'Order Id Ai',
            'order_id' => 'Order ID',
            'material_id' => 'Material ID',
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
    public function getBillMasters()
    {
        return $this->hasOne(MatsysBillMaster::className(), ['bill_master_id' => 'bill_master_id']);
    }
    public function getMaterialdetail()
    {
        return $this->hasOne(MatsysMaterial::className(), ['material_id' => 'material_id']);
    }

    public static function getAllamountorder($order_id,$material_id){
        $count =  MatsysOrderHasMaterial::find()
            ->where('order_id = :order_id', [':order_id' => $order_id])
            ->andWhere('material_id = :material_id',[':material_id'=>$material_id])
            ->sum('material_amount');
        if($count == null){
            return '0';
        }else{
            return $count;
        }
    }

    public static function getMainmaterial($order_id){
        return MatsysOrderHasMaterial::find()
            ->where('order_id = :order_id', [':order_id' => $order_id])
            ->groupBy(['material_id'])
            ->all();
    }

    public static function allAmountInOrder($order_id){
        $count = 0;
        $bill = MatsysOrderHasMaterial::find()
            ->where('order_id = :order_id', [':order_id' => $order_id])
            ->groupBy('material_id')
            ->all();
        foreach ($bill as $key => $value){
            $count++;
        }
        if($bill == null){
            return '0';
        }else{
            return $count;
        }
    }

    public static function getAllPriceOrder($order_id){
        $price = 0;
        $order = MatsysOrderHasMaterial::find()
            ->innerJoin('matsys_order','matsys_order_has_material.order_id = matsys_order.order_id')
            ->where('matsys_order_has_material.order_id = :order_id',[':order_id'=>$order_id])
            ->andWhere('matsys_order.order_status_confirm = "confirm"')
            ->andWhere('matsys_order.order_status = "1"')
            ->all();
        foreach ($order as $key => $value){
            $price += ($value->material_amount_receive*$value->material->bill_detail_price_per_unit);
        }

        return $price;
    }
}

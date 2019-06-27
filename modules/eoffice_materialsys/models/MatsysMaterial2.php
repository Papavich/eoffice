<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "matsys_material".
 *
 * @property string $material_id
 * @property string $material_name
 * @property string $material_detail
 * @property integer $material_amount_check
 * @property integer $material_order_count
 * @property string $material_unit_name
 * @property string $location_id
 * @property string $material_type_id
 *
 * @property MatsysBillDetail[] $matsysBillDetails
 * @property MatsysBillMaster[] $billMasters
 * @property MatsysLocation $location
 * @property MatsysMaterialType $materialType
 * @property MatsysOrderHasMaterial[] $matsysOrderHasMaterials
 * @property MatsysOrder2[] $orders
 * @property MatsysOrderReturn[] $matsysOrderReturns
 * @property MatsysOrder2[] $orders0
 */
class MatsysMaterial2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_material';
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
            [['material_id', 'location_id', 'material_type_id'], 'required'],
            [['material_amount_check', 'material_order_count'], 'integer'],
            [['material_id', 'location_id', 'material_type_id'], 'string', 'max' => 20],
            [['material_name', 'material_unit_name'], 'string', 'max' => 50],
            [['material_detail'], 'string', 'max' => 100],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysLocation::className(), 'targetAttribute' => ['location_id' => 'location_id']],
            [['material_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysMaterialType::className(), 'targetAttribute' => ['material_type_id' => 'material_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'material_id' => 'รหัสวัสดุ',
            'material_name' => 'ชื่อวัสดุ',
            'material_detail' => 'รายละเอียด',
            'material_amount_check' => 'จำนวนเมื่อต้องการแจ้งเตือน',
            'material_order_count' => 'Material Order Count',
            'material_unit_name' => 'ชื่อหน่วยนับ',
            'location_id' => 'สถานที่จัดเก็บ',
            'material_type_id' => 'ประเภทวัสดุ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysBillDetails()
    {
        return $this->hasMany(MatsysBillDetail::className(), ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillMasters()
    {
        return $this->hasMany(MatsysBillMaster::className(), ['bill_master_id' => 'bill_master_id'])->viaTable('matsys_bill_detail', ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(MatsysLocation::className(), ['location_id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialType()
    {
        return $this->hasOne(MatsysMaterialType::className(), ['material_type_id' => 'material_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrderHasMaterials()
    {
        return $this->hasMany(MatsysOrderHasMaterial::className(), ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(MatsysOrder::className(), ['order_id' => 'order_id'])->viaTable('matsys_order_has_material', ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysOrderReturns()
    {
        return $this->hasMany(MatsysOrderReturn::className(), ['material_id' => 'material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(MatsysOrder::className(), ['order_id' => 'order_id'])->viaTable('matsys_order_return', ['material_id' => 'material_id']);
    }
    public static function amountAll($material_id){
        $count =  MatsysBillDetail::find()->where("material_id = :userid ", [':userid' => $material_id])->sum('bill_detail_use_amount');
        if($count == ''){
            return '0';
        }else{
            return '0';
        }
    }
}

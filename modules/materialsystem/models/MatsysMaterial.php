<?php

namespace app\modules\materialsystem\models;

use Yii;

/**
 * This is the model class for table "matsys_material".
 *
 * @property string $material_id รหัสวัสดุ
 * @property string $material_name ชื่อวัสดุ
 * @property string $material_detail รายละเอียดวัสดุ
 * @property int $material_amount_check จำนวนขั้นต่ำที่ใช้ในการแจ้งเตือน
 * @property int $material_order_count จำนวนการเบิกทั้งหมด
 * @property string $material_unit_name
 * @property string $material_image
 * @property string $location_id รหัสที่เก็บวัสดุ
 * @property string $material_type_id รหัสประเภทวัสดุ
 *
 * @property MatsysBillDetail[] $matsysBillDetails
 * @property MatsysBillMaster[] $billMasters
 * @property MatsysLocation $location
 * @property MatsysMaterialType $materialType
 * @property MatsysOrderHasMaterial[] $matsysOrderHasMaterials
 * @property MatsysOrder[] $orders
 * @property MatsysOrderReturn[] $matsysOrderReturns
 * @property MatsysOrder[] $orders0
 */
class MatsysMaterial extends \yii\db\ActiveRecord
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
            [['material_image'], 'string', 'max' => 45],
            [['material_id'], 'unique'],
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
            'material_id' => 'Material ID',
            'material_name' => 'Material Name',
            'material_detail' => 'Material Detail',
            'material_amount_check' => 'Material Amount Check',
            'material_order_count' => 'Material Order Count',
            'material_unit_name' => 'Material Unit Name',
            'material_image' => 'Material Image',
            'location_id' => 'Location ID',
            'material_type_id' => 'Material Type ID',
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
}

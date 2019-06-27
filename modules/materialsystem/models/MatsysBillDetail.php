<?php

namespace app\modules\materialsystem\models;

use Yii;

/**
 * This is the model class for table "matsys_bill_detail".
 *
 * @property string $material_id
 * @property string $bill_master_id
 * @property int $bill_detail_price_per_unit ราคาต่อหน่วย
 * @property int $bill_detaill_amount จำนวนทั้งหมด
 * @property string $bill_detail_use_amount
 * @property int $bill_detail_counter
 *
 * @property MatsysBillMaster $billMaster
 * @property MatsysMaterial $material
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
            [['bill_detail_price_per_unit', 'bill_detaill_amount', 'bill_detail_counter'], 'integer'],
            [['material_id', 'bill_master_id'], 'string', 'max' => 20],
            [['bill_detail_use_amount'], 'string', 'max' => 45],
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
}

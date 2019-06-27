<?php

namespace app\modules\materialsystem\models;

use Yii;

/**
 * This is the model class for table "matsys_bill_master".
 *
 * @property string $bill_master_id รหัสใบสั่งซื้อวัสดุ(K....)
 * @property string $bill_master_date วันเดือนปี
 * @property string $bill_mater_record รหัสใบบันทึกข้อความ(ศธ)
 * @property string $bill_master_check รหัสใบตรวจรับพัสดุ(RE)
 * @property string $bill_master_id_no รหัสเล่มใบสั่งซื้อวัสดุ
 * @property string $bill_master_pdf ชื่อไฟล์ pdf
 * @property string $company_id รหัสบริษัท
 *
 * @property MatsysBillDetail[] $matsysBillDetails
 * @property MatsysMaterial[] $materials
 * @property MatsysCompany $company
 */
class MatsysBillMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_bill_master';
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
            [['bill_master_id', 'company_id'], 'required'],
            [['bill_master_date'], 'safe'],
            [['bill_master_id', 'company_id'], 'string', 'max' => 20],
            [['bill_mater_record', 'bill_master_check'], 'string', 'max' => 40],
            [['bill_master_id_no'], 'string', 'max' => 45],
            [['bill_master_pdf'], 'string', 'max' => 50],
            [['bill_master_id'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatsysCompany::className(), 'targetAttribute' => ['company_id' => 'company_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bill_master_id' => 'Bill Master ID',
            'bill_master_date' => 'Bill Master Date',
            'bill_mater_record' => 'Bill Mater Record',
            'bill_master_check' => 'Bill Master Check',
            'bill_master_id_no' => 'Bill Master Id No',
            'bill_master_pdf' => 'Bill Master Pdf',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysBillDetails()
    {
        return $this->hasMany(MatsysBillDetail::className(), ['bill_master_id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(MatsysMaterial::className(), ['material_id' => 'material_id'])->viaTable('matsys_bill_detail', ['bill_master_id' => 'bill_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(MatsysCompany::className(), ['company_id' => 'company_id']);
    }
}

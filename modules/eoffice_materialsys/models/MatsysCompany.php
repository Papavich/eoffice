<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "matsys_company".
 *
 * @property string $company_id
 * @property string $company_name
 * @property string $company_address
 * @property string $company_phone
 * @property string $company_sellman
 *
 * @property MatsysBillMaster[] $matsysBillMasters
 */
class MatsysCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_company';
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
            [['company_id'], 'required'],
            [['company_id'], 'string', 'max' => 20],
            [['company_name', 'company_sellman'], 'string', 'max' => 45],
            [['company_address'], 'string', 'max' => 80],
            [['company_phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'รหัสบริษัท',
            'company_name' => 'ชื่อบริษัท',
            'company_address' => 'ที่อยู่บริษัท',
            'company_phone' => 'เบอร์โทรศัพท์',
            'company_sellman' => 'ชื่อผู้ติดต่อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysBillMasters()
    {
        return $this->hasMany(MatsysBillMaster::className(), ['company_id' => 'company_id']);
    }
}

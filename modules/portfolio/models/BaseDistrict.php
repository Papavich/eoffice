<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "base_district".
 *
 * @property int $id รหัสอำเภอ
 * @property int $base_province_id รหัสจังหวัด
 * @property string $district_name อำเภอ
 *
 * @property BaseProvince $baseProvince
 * @property BaseTambon[] $baseTambons
 */
class BaseDistrict extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'base_district';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'base_province_id', 'district_name'], 'required'],
            [['id', 'base_province_id'], 'integer'],
            [['district_name'], 'string', 'max' => 60],
            [['id'], 'unique'],
            [['base_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseProvince::className(), 'targetAttribute' => ['base_province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base_province_id' => 'Base Province ID',
            'district_name' => 'District Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseProvince()
    {
        return $this->hasOne(BaseProvince::className(), ['id' => 'base_province_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseTambons()
    {
        return $this->hasMany(BaseTambon::className(), ['base_district_id' => 'id']);
    }
}

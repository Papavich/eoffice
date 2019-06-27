<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "base_province".
 *
 * @property int $id รหัสจังหวัด
 * @property string $province_name จังหวัด
 * @property string $province_name_en Province
 *
 * @property BaseDistrict[] $baseDistricts
 * @property BaseTambon[] $baseTambons
 */
class BaseProvince extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'base_province';
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
            [['id', 'province_name'], 'required'],
            [['id'], 'integer'],
            [['province_name', 'province_name_en'], 'string', 'max' => 60],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_name' => 'Province Name',
            'province_name_en' => 'Province Name En',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseDistricts()
    {
        return $this->hasMany(BaseDistrict::className(), ['base_province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseTambons()
    {
        return $this->hasMany(BaseTambon::className(), ['base_province_id' => 'id']);
    }
}

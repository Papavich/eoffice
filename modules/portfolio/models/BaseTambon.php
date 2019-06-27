<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "base_tambon".
 *
 * @property int $id รหัสตำบล
 * @property string $tambon_name ตำบล
 * @property int $base_district_id
 * @property int $base_province_id
 *
 * @property BaseDistrict $baseDistrict
 * @property BaseProvince $baseProvince
 * @property Publication[] $publications
 */
class BaseTambon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'base_tambon';
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
            [['id', 'tambon_name'], 'required'],
            [['id', 'base_district_id', 'base_province_id'], 'integer'],
            [['tambon_name'], 'string', 'max' => 60],
            [['id'], 'unique'],
            [['base_district_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseDistrict::className(), 'targetAttribute' => ['base_district_id' => 'id']],
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
            'tambon_name' => 'Tambon Name',
            'base_district_id' => 'Base District ID',
            'base_province_id' => 'Base Province ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseDistrict()
    {
        return $this->hasOne(BaseDistrict::className(), ['id' => 'base_district_id']);
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
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['base_tambon_id' => 'id']);
    }
}

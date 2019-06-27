<?php

namespace app\modules\materialsystem\models;

use Yii;

/**
 * This is the model class for table "matsys_location".
 *
 * @property string $location_id รหัสสถานที่เก็บวัสดุ
 * @property string $location_name ชื่อสถานที่เก็บวัสดุ
 *
 * @property MatsysMaterial[] $matsysMaterials
 */
class MatsysLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_location';
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
            [['location_id'], 'required'],
            [['location_id'], 'string', 'max' => 8],
            [['location_name'], 'string', 'max' => 45],
            [['location_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'รหัสสถานที่จัดเก็บ',
            'location_name' => 'ชื่อสถานที่จัดเก็บ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysMaterials()
    {
        return $this->hasMany(MatsysMaterial::className(), ['location_id' => 'location_id']);
    }
}

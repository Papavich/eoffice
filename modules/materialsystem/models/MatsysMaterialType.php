<?php

namespace app\modules\materialsystem\models;

use Yii;

/**
 * This is the model class for table "matsys_material_type".
 *
 * @property string $material_type_id รหัสประเภทวัสดุ
 * @property string $material_type_name ชื่อสถานที่เก็บวัสดุ
 *
 * @property MatsysMaterial[] $matsysMaterials
 */
class MatsysMaterialType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matsys_material_type';
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
            [['material_type_id'], 'required'],
            [['material_type_id'], 'string', 'max' => 20],
            [['material_type_name'], 'string', 'max' => 45],
            [['material_type_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'material_type_id' => 'รหัสหมวดหมู่',
            'material_type_name' => 'ชื่อหมวดหมู่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatsysMaterials()
    {
        return $this->hasMany(MatsysMaterial::className(), ['material_type_id' => 'material_type_id']);
    }
}

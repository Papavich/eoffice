<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "design_attribute".
 *
 * @property string $attribute_ref
 * @property string $attribute_name
 * @property int $attribute_order
 * @property int $design_section_id
 * @property int $attribute_function_id
 * @property int $attribute_type_id
 *
 * @property AttributeData[] $attributeDatas
 * @property DesignSection $designSection
 * @property AttributeFunction $attributeFunction
 * @property AttributeType $attributeType
 */
class DesignAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'design_attribute';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_form');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_name','attribute_order','attribute_ref', 'design_section_id', 'attribute_function_id', 'attribute_type_id'], 'required'],
            [['attribute_order', 'design_section_id', 'attribute_function_id', 'attribute_type_id'], 'integer'],
            [['attribute_ref'], 'string', 'max' => 45],
            [['attribute_name'], 'string', 'max' => 750],
            [['attribute_ref', 'design_section_id'], 'unique', 'targetAttribute' => ['attribute_ref', 'design_section_id']],
            [['design_section_id'], 'exist', 'skipOnError' => true, 'targetClass' => DesignSection::className(), 'targetAttribute' => ['design_section_id' => 'design_section_id']],
            [['attribute_function_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeFunction::className(), 'targetAttribute' => ['attribute_function_id' => 'attribute_function_id']],
            [['attribute_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeType::className(), 'targetAttribute' => ['attribute_type_id' => 'attribute_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_ref' => 'รหัสอ้างอิง',
            'attribute_name' => 'ชื่อฟิลด์',
            'attribute_order' => 'ลำดับฟิลด์',
            'design_section_id' => 'Design Section ID',
            'attribute_function_id' => 'ฟังก์ชันฟิลด์',
            'attribute_type_id' => 'ประเภทฟิลด์',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeDatas()
    {
        return $this->hasMany(AttributeData::className(), ['attribute_ref' => 'attribute_ref', 'design_section_id' => 'design_section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignSection()
    {
        return $this->hasOne(DesignSection::className(), ['design_section_id' => 'design_section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeFunction()
    {
        return $this->hasOne(AttributeFunction::className(), ['attribute_function_id' => 'attribute_function_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeType()
    {
        return $this->hasOne(AttributeType::className(), ['attribute_type_id' => 'attribute_type_id']);
    }
}

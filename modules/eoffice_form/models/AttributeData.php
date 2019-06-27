<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "attribute_data".
 *
 * @property int $attribute_data_id
 * @property string $attribute_data
 * @property int $attribute_order
 * @property string $attribute_ref
 * @property int $design_section_id
 *
 * @property DesignAttribute $attributeRef
 */
class AttributeData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_data';
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
            [['attribute_order', 'design_section_id'], 'integer'],
            [['attribute_ref', 'design_section_id'], 'required'],
            [['attribute_data', 'attribute_ref'], 'string', 'max' => 45],
            //[['attribute_data'], 'unique'],
            [['attribute_ref', 'design_section_id'], 'exist', 'skipOnError' => true, 'targetClass' => DesignAttribute::className(), 'targetAttribute' => ['attribute_ref' => 'attribute_ref', 'design_section_id' => 'design_section_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attribute_data_id' => 'Attribute Data ID',
            'attribute_data' => 'รายการ',
            'attribute_order' => 'ลำดับรายการ',
            'attribute_ref' => 'รหัสอ้างอิง',
            'design_section_id' => 'รหัสหมวดหมู่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeRef()
    {
        return $this->hasOne(DesignAttribute::className(), ['attribute_ref' => 'attribute_ref', 'design_section_id' => 'design_section_id']);
    }
}

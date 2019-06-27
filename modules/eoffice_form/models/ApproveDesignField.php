<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "approve_design_field".
 *
 * @property string $approve_field_ref
 * @property string $approve_field_name
 * @property int $approve_field_order
 * @property int $approve_design_id
 * @property int $attribute_type_id
 *
 * @property ApproveDesignSection $approveDesign
 * @property AttributeType $attributeType
 * @property ApproveFieldList[] $approveFieldLists
 */
class ApproveDesignField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve_design_field';
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
            [['approve_field_ref', 'approve_design_id', 'attribute_type_id'], 'required'],
            [['approve_field_order', 'approve_design_id', 'attribute_type_id'], 'integer'],
            [['approve_field_ref', 'approve_field_name'], 'string', 'max' => 45],
            [['approve_field_ref', 'approve_design_id'], 'unique', 'targetAttribute' => ['approve_field_ref', 'approve_design_id']],
            [['approve_design_id'], 'exist', 'skipOnError' => true, 'targetClass' => ApproveDesignSection::className(), 'targetAttribute' => ['approve_design_id' => 'approve_design_id']],
            [['attribute_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeType::className(), 'targetAttribute' => ['attribute_type_id' => 'attribute_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'approve_field_ref' => 'รหัสอ้างอิง',
            'approve_field_name' => 'ชื่อฟิลด์',
            'approve_field_order' => 'ลำดับที่',
            'approve_design_id' => 'Approve Design ID',
            'attribute_type_id' => 'Attribute Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveDesign()
    {
        return $this->hasOne(ApproveDesignSection::className(), ['approve_design_id' => 'approve_design_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeType()
    {
        return $this->hasOne(AttributeType::className(), ['attribute_type_id' => 'attribute_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveFieldLists()
    {
        return $this->hasMany(ApproveFieldList::className(), ['approve_field_ref' => 'approve_field_ref']);
    }
}

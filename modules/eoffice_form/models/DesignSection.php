<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "design_section".
 *
 * @property int $design_section_id
 * @property string $design_section_name
 * @property int $design_section_order
 * @property int $template_id
 * @property int $section_type_id
 *
 * @property ReqTemplate $template
 * @property DesignSectionType $sectionType
 * @property DesignSectionAttribute[] $designSectionAttributes
 */
class DesignSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'design_section';
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
            [['design_section_order', 'template_id', 'section_type_id'], 'integer'],
            [['template_id', 'section_type_id'], 'required'],
            [['design_section_name'], 'string', 'max' => 255],
            [['design_section_name','design_section_order'], 'required'],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqTemplate::className(), 'targetAttribute' => ['template_id' => 'template_id']],
            [['section_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DesignSectionType::className(), 'targetAttribute' => ['section_type_id' => 'section_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'design_section_id' => 'รหัสหมวดหมู่',
            'design_section_name' => 'ชื่อหมวดหมู่',
            'design_section_order' => 'ลำดับหมวดหมู่',
            'template_id' => 'รหัสแบบฟอร์มคำร้อง',
            'section_type_id' => 'ประเภทหมวดหมู่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(ReqTemplate::className(), ['template_id' => 'template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionType()
    {
        return $this->hasOne(DesignSectionType::className(), ['section_type_id' => 'section_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignSectionAttributes()
    {
        return $this->hasMany(DesignSectionAttribute::className(), ['design_section_id' => 'design_section_id']);
    }
}

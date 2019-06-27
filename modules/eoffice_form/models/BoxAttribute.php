<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "box_attribute".
 *
 * @property string $box_ref
 * @property string $box_name
 * @property string $box_type
 * @property int $box_order
 * @property string $box_function
 * @property int $section_section_id
 *
 * @property AttributeData[] $attributeDatas
 * @property Section $sectionSection
 */
class BoxAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'box_attribute';
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
            [['box_ref', 'section_section_id'], 'required'],
            [['box_order', 'section_section_id'], 'integer'],
            [['box_ref', 'box_name', 'box_type', 'box_function'], 'string', 'max' => 45],
            [['box_ref', 'section_section_id'], 'unique', 'targetAttribute' => ['box_ref', 'section_section_id']],
            [['section_section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_section_id' => 'section_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'box_ref' => 'Box Ref',
            'box_name' => 'Box Name',
            'box_type' => 'Box Type',
            'box_order' => 'Box Order',
            'box_function' => 'Box Function',
            'section_section_id' => 'Section Section ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeDatas()
    {
        return $this->hasMany(AttributeData::className(), ['box_box_ref' => 'box_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionSection()
    {
        return $this->hasOne(Section::className(), ['section_id' => 'section_section_id']);
    }
}

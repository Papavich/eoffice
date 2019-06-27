<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "design_section_type".
 *
 * @property int $section_type_id
 * @property string $section_type_name
 *
 * @property DesignSection[] $designSections
 */
class DesignSectionType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'design_section_type';
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
            [['section_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_type_id' => 'ประเภทหมวดหมู่',
            'section_type_name' => 'ประเภทหมวดหมู่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignSections()
    {
        return $this->hasMany(DesignSection::className(), ['section_type_id' => 'section_type_id']);
    }
}

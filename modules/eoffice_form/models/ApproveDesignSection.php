<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "approve_design_section".
 *
 * @property int $approve_design_id
 * @property string $approve_design_name
 * @property int $approve_design_order
 * @property int $approve_group_id
 * @property int $section_type_id
 *
 * @property ApproveDesignField[] $approveDesignFields
 * @property ApproveGroup $approveGroup
 * @property DesignSectionType $sectionType
 */
class ApproveDesignSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve_design_section';
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
            [['approve_design_order', 'approve_group_id', 'section_type_id'], 'integer'],
            [['approve_group_id', 'section_type_id'], 'required'],
            [['approve_design_name'], 'string', 'max' => 45],
            [['approve_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ApproveGroup::className(), 'targetAttribute' => ['approve_group_id' => 'group_id']],
            [['section_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DesignSectionType::className(), 'targetAttribute' => ['section_type_id' => 'section_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'approve_design_id' => 'Approve Design ID',
            'approve_design_name' => 'Approve Design Name',
            'approve_design_order' => 'Approve Design Order',
            'approve_group_id' => 'Approve Group ID',
            'section_type_id' => 'Section Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveDesignFields()
    {
        return $this->hasMany(ApproveDesignField::className(), ['approve_design_id' => 'approve_design_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveGroup()
    {
        return $this->hasOne(ApproveGroup::className(), ['group_id' => 'approve_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionType()
    {
        return $this->hasOne(DesignSectionType::className(), ['section_type_id' => 'section_type_id']);
    }
}

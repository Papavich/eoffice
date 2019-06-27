<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "approve_group".
 *
 * @property int $group_id
 * @property string $group_name
 * @property int $group_order
 * @property int $template_id
 * @property int $approve_type_id
 * @property int $group_type_id
 *
 * @property ApproveDesignSection[] $approveDesignSections
 * @property ApproveGroupType $groupType
 * @property ApproveType $approveType
 * @property ReqTemplate $template
 * @property ApprovePosition[] $approvePositions
 */
class ApproveGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve_group';
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
            [['group_order', 'template_id', 'approve_type_id', 'group_type_id'], 'integer'],
            [['group_order','group_name','template_id', 'approve_type_id', 'group_type_id'], 'required'],
            [['group_name'], 'string', 'max' => 255],
            [['group_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ApproveGroupType::className(), 'targetAttribute' => ['group_type_id' => 'group_type_id']],
            [['approve_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ApproveType::className(), 'targetAttribute' => ['approve_type_id' => 'approve_type_id']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqTemplate::className(), 'targetAttribute' => ['template_id' => 'template_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'รหัสกลุ่ม',
            'group_name' => 'ชื่อกลุ่ม',
            'group_order' => 'ลำดับกลุ่ม',
            'template_id' => 'รหัสแบบฟอร์มคำร้อง',
            'approve_type_id' => 'ลำดับการพิจารณา',
            'group_type_id' => 'ประเภทของกลุ่ม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveDesignSections()
    {
        return $this->hasMany(ApproveDesignSection::className(), ['approve_group_id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupType()
    {
        return $this->hasOne(ApproveGroupType::className(), ['group_type_id' => 'group_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveType()
    {
        return $this->hasOne(ApproveType::className(), ['approve_type_id' => 'approve_type_id']);
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
    public function getApprovePositions()
    {
        return $this->hasMany(ApprovePosition::className(), ['approve_group_id' => 'group_id']);
    }
}

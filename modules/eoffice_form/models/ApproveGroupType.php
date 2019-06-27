<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "approve_group_type".
 *
 * @property int $group_type_id
 * @property string $group_type_name
 *
 * @property ApproveGroup[] $approveGroups
 */
class ApproveGroupType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve_group_type';
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
            [['group_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_type_id' => 'Group Type ID',
            'group_type_name' => 'Group Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveGroups()
    {
        return $this->hasMany(ApproveGroup::className(), ['group_type_id' => 'group_type_id']);
    }
}

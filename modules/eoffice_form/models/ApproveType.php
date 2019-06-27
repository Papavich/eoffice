<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "approve_type".
 *
 * @property int $approve_type_id
 * @property string $approve_type_name
 *
 * @property ApproveGroup[] $approveGroups
 */
class ApproveType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approve_type';
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
            [['approve_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'approve_type_id' => 'Approve Type ID',
            'approve_type_name' => 'Approve Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveGroups()
    {
        return $this->hasMany(ApproveGroup::className(), ['approve_type_id' => 'approve_type_id']);
    }
}

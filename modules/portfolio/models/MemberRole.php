<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "member_role".
 *
 * @property integer $member_role_id
 * @property string $member_role_name
 *
 * @property ProjectMember[] $projectMembers
 */
class MemberRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_role';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_role_id', 'member_role_name'], 'required'],
            [['member_role_id'], 'integer'],
            [['member_role_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_role_id' => 'Member Role ID',
            'member_role_name' => 'Member Role Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMembers()
    {
        return $this->hasMany(ProjectMember::className(), ['member_role_id' => 'member_role_id']);
    }
}
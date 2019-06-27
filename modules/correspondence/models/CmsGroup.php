<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_group".
 *
 * @property integer $group_id
 * @property string $group_name
 *
 * @property User[] $users
 */
class CmsGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_group';
    }
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'required'],
            [['group_id'], 'integer'],
            [['group_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'group_name' => 'Group Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['group_id' => 'group_id']);
    }
}

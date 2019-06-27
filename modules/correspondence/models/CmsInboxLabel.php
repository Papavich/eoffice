<?php

namespace app\modules\correspondence\models;

use app\modules\correspondence\controllers;
use Yii;

/**
 * This is the model class for table "cms_inbox_label".
 *
 * @property string $inbox_label_id
 * @property string $label_name
 * @property int $user_id
 *
 * @property User $user
 * @property InboxLabel[] $inboxLabels
 * @property CmsInbox[] $inboxes
 */
class CmsInboxLabel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_inbox_label';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
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
            [['inbox_label_id','label_name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['inbox_label_id'], 'string', 'max' => 20],
            [['label_name'], 'string', 'max' => 45],
            [['inbox_label_id', 'user_id'], 'unique', 'targetAttribute' => ['inbox_label_id', 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inbox_label_id' => 'Inbox Label ID',
            'label_name' => controllers::t('menu','Label Name'),
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInboxLabels()
    {
        return $this->hasMany(InboxLabel::className(), ['label_id' => 'inbox_label_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInboxes()
    {
        return $this->hasMany(CmsInbox::className(), ['inbox_id' => 'inbox_id'])->viaTable('inbox_label', ['label_id' => 'inbox_label_id']);
    }
}

<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_inbox".
 *
 * @property string $inbox_id
 * @property string $inbox_status
 * @property string $inbox_subject
 * @property string $inbox_content
 * @property string $inbox_time
 * @property string $doc_id
 * @property int $user_id
 * @property string $approve_status
 * @property string $approve_time
 * @property int $approve_by
 * @property string $message_reply_time
 * @property string $message_approve
 * @property string $message_reply
 * @property int $inbox_fav
 * @property int $inbox_trash
 * @property string $outbox_id
 * @property string $read_time
 *
 * @property CmsDocument $doc
 * @property CmsOutbox $outbox
 * @property User $user
 * @property User $approveBy
 * @property InboxLabel[] $inboxLabels
 * @property CmsInboxLabel[] $labels
 */
class CmsInbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_inbox';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inbox_id', 'inbox_subject', 'inbox_content', 'inbox_time', 'doc_id', 'user_id', 'inbox_fav', 'inbox_trash', 'outbox_id'], 'required'],
            [['inbox_time', 'approve_time', 'message_reply_time', 'read_time'], 'safe'],
            [['user_id', 'approve_by', 'inbox_fav', 'inbox_trash'], 'integer'],
            [['inbox_id', 'outbox_id'], 'string', 'max' => 30],
            [['inbox_status', 'approve_status'], 'string', 'max' => 100],
            [['inbox_subject', 'message_approve', 'message_reply'], 'string', 'max' => 200],
            [['inbox_content'], 'string', 'max' => 400],
            [['doc_id'], 'string', 'max' => 45],
            [['inbox_id', 'user_id', 'outbox_id'], 'unique', 'targetAttribute' => ['inbox_id', 'user_id', 'outbox_id']],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
            [['outbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsOutbox::className(), 'targetAttribute' => ['outbox_id' => 'outbox_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['approve_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['approve_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inbox_id' => 'Inbox ID',
            'inbox_status' => 'Inbox Status',
            'inbox_subject' => 'Inbox Subject',
            'inbox_content' => 'Inbox Content',
            'inbox_time' => 'Inbox Time',
            'doc_id' => 'Doc ID',
            'user_id' => 'User ID',
            'approve_status' => 'Approve Status',
            'approve_time' => 'Approve Time',
            'approve_by' => 'Approve By',
            'message_reply_time' => 'Message Reply Time',
            'message_approve' => 'Message Approve',
            'message_reply' => 'Message Reply',
            'inbox_fav' => 'Inbox Fav',
            'inbox_trash' => 'Inbox Trash',
            'outbox_id' => 'Outbox ID',
            'read_time' => 'Read Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(CmsDocument::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutbox()
    {
        return $this->hasOne(CmsOutbox::className(), ['outbox_id' => 'outbox_id']);
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
    public function getApproveBy()
    {
        return $this->hasOne(User::className(), ['id' => 'approve_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInboxLabels()
    {
        return $this->hasMany(InboxLabel::className(), ['inbox_id' => 'inbox_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabels()
    {
        return $this->hasMany(CmsInboxLabel::className(), ['inbox_label_id' => 'label_id'])->viaTable('inbox_label', ['inbox_id' => 'inbox_id']);
    }
}

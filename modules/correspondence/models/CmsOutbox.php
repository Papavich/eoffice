<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_outbox".
 *
 * @property string $outbox_id
 * @property string $outbox_status
 * @property string $outbox_subject
 * @property string $outbox_content
 * @property string $outbox_time
 * @property string $doc_id
 * @property int $user_id
 * @property int $outbox_trash
 *
 * @property CmsInbox[] $cmsInboxes
 * @property CmsDocument $doc
 * @property User $user
 * @property CmsOutboxFile[] $cmsOutboxFiles
 * @property CmsFile[] $files
 * @property CmsQueue[] $cmsQueues
 */
class CmsOutbox extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_outbox';
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
            [['outbox_id', 'doc_id', 'user_id'], 'required'],
            [['outbox_time'], 'safe'],
            [['user_id', 'outbox_trash'], 'integer'],
            [['outbox_id'], 'string', 'max' => 30],
            [['outbox_status', 'doc_id'], 'string', 'max' => 45],
            [['outbox_subject'], 'string', 'max' => 200],
            [['outbox_content'], 'string', 'max' => 500],
            [['outbox_id', 'doc_id', 'user_id'], 'unique', 'targetAttribute' => ['outbox_id', 'doc_id', 'user_id']],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'outbox_id' => 'Outbox ID',
            'outbox_status' => 'Outbox Status',
            'outbox_subject' => 'Outbox Subject',
            'outbox_content' => 'Outbox Content',
            'outbox_time' => 'Outbox Time',
            'doc_id' => 'Doc ID',
            'user_id' => 'User ID',
            'outbox_trash' => 'Outbox Trash',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsInboxes()
    {
        return $this->hasMany(CmsInbox::className(), ['outbox_id' => 'outbox_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsOutboxFiles()
    {
        return $this->hasMany(CmsOutboxFile::className(), ['outbox_id' => 'outbox_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(CmsFile::className(), ['file_id' => 'file_id'])->viaTable('cms_outbox_file', ['outbox_id' => 'outbox_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsQueues()
    {
        return $this->hasMany(CmsQueue::className(), ['outbox_id' => 'outbox_id', 'outbox_doc_id' => 'doc_id', 'outbox_user_id' => 'user_id']);
    }
}

<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_queue".
 *
 * @property int $cms_queue_id
 * @property int $status
 * @property int $amount
 * @property string $outbox_id
 * @property string $outbox_doc_id
 * @property int $outbox_user_id
 *
 * @property CmsOutbox $outbox
 */
class CmsQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_queue';
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
            [['status', 'amount', 'outbox_user_id'], 'integer'],
            [['outbox_id', 'outbox_doc_id', 'outbox_user_id'], 'required'],
            [['outbox_id'], 'string', 'max' => 20],
            [['outbox_doc_id'], 'string', 'max' => 45],
            [['outbox_id', 'outbox_doc_id', 'outbox_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsOutbox::className(), 'targetAttribute' => ['outbox_id' => 'outbox_id', 'outbox_doc_id' => 'doc_id', 'outbox_user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cms_queue_id' => 'Cms Queue ID',
            'status' => 'Status',
            'amount' => 'Amount',
            'outbox_id' => 'Outbox ID',
            'outbox_doc_id' => 'Outbox Doc ID',
            'outbox_user_id' => 'Outbox User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutbox()
    {
        return $this->hasOne(CmsOutbox::className(), ['outbox_id' => 'outbox_id', 'doc_id' => 'outbox_doc_id', 'user_id' => 'outbox_user_id']);
    }
}

<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "inbox_label".
 *
 * @property string $label_id
 * @property string $inbox_id
 *
 * @property CmsInbox $inbox
 * @property CmsInboxLabel $label
 */
class InboxLabel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inbox_label';
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
            [['label_id', 'inbox_id'], 'required'],
            [['label_id'], 'string', 'max' => 20],
            [['inbox_id'], 'string', 'max' => 30],
            [['label_id', 'inbox_id'], 'unique', 'targetAttribute' => ['label_id', 'inbox_id']],
            [['inbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsInbox::className(), 'targetAttribute' => ['inbox_id' => 'inbox_id']],
            [['label_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsInboxLabel::className(), 'targetAttribute' => ['label_id' => 'inbox_label_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'label_id' => 'Label ID',
            'inbox_id' => 'Inbox ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInbox()
    {
        return $this->hasOne(CmsInbox::className(), ['inbox_id' => 'inbox_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabel()
    {
        return $this->hasOne(CmsInboxLabel::className(), ['inbox_label_id' => 'label_id']);
    }
}

<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_outbox_file".
 *
 * @property int $file_id
 * @property string $outbox_id
 *
 * @property CmsFile $file
 * @property CmsOutbox $outbox
 */
class CmsOutboxFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_outbox_file';
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
            [['file_id', 'outbox_id'], 'required'],
            [['file_id'], 'integer'],
            [['outbox_id'], 'string', 'max' => 30],
            [['file_id', 'outbox_id'], 'unique', 'targetAttribute' => ['file_id', 'outbox_id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsFile::className(), 'targetAttribute' => ['file_id' => 'file_id']],
            [['outbox_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsOutbox::className(), 'targetAttribute' => ['outbox_id' => 'outbox_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'outbox_id' => 'Outbox ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(CmsFile::className(), ['file_id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutbox()
    {
        return $this->hasOne(CmsOutbox::className(), ['outbox_id' => 'outbox_id']);
    }
}

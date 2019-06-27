<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_file".
 *
 * @property integer $file_id
 * @property string $file_name
 * @property string $file_path
 * @property string $file_annotation
 * @property string $file_date
 *
 * @property CmsDocFile[] $cmsDocFiles
 * @property CmsDocument[] $docs
 * @property CmsOutboxFile[] $cmsOutboxFiles
 * @property CmsOutbox[] $outboxes
 */
class CmsFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_file';
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
            [['file_id', 'file_path'], 'required'],
            [['file_id'], 'integer'],
            [['file_date'], 'safe'],
            [['file_name'], 'string', 'max' => 200],
            [['file_path'], 'string', 'max' => 50],
            [['file_annotation'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
            'file_annotation' => 'File Annotation',
            'file_date' => 'File Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocFiles()
    {
        return $this->hasMany(CmsDocFile::className(), ['file_id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasMany(CmsDocument::className(), ['doc_id' => 'doc_id'])->viaTable('cms_doc_file', ['file_id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsOutboxFiles()
    {
        return $this->hasMany(CmsOutboxFile::className(), ['file_id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutboxes()
    {
        return $this->hasMany(CmsOutbox::className(), ['outbox_id' => 'outbox_id'])->viaTable('cms_outbox_file', ['file_id' => 'file_id']);
    }
}

<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_file".
 *
 * @property integer $file_id
 * @property string $doc_id
 *
 * @property CmsDocument $doc
 * @property CmsFile $file
 */
class CmsDocFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_file';
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
            [['file_id', 'doc_id'], 'required'],
            [['file_id'], 'integer'],
            [['doc_id'], 'string', 'max' => 45],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsFile::className(), 'targetAttribute' => ['file_id' => 'file_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'doc_id' => 'Doc ID',
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
    public function getFile()
    {
        return $this->hasOne(CmsFile::className(), ['file_id' => 'file_id']);
    }
}

<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_ref".
 *
 * @property string $doc_ref_id
 * @property string $doc_ref
 * @property string $doc_id
 *
 * @property CmsDocument $doc
 */
class CmsDocRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_ref';
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
            [['doc_ref_id', 'doc_id'], 'required'],
            [['doc_ref_id', 'doc_ref', 'doc_id'], 'string', 'max' => 45],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_ref_id' => 'Doc Ref ID',
            'doc_ref' => 'Doc Ref',
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
}

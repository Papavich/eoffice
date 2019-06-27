<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_roll_send".
 *
 * @property string $doc_roll_send_id
 * @property string $doc_roll_send_doing
 * @property string $doc_roll_note
 * @property string $doc_id
 *
 * @property CmsDocument $doc
 */
class CmsDocRollSend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_roll_send';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_roll_send_id', 'doc_id'], 'required'],
            [['doc_roll_send_id'],'unique'],
            [['doc_roll_send_id'], 'string', 'max' => 10],
            [['doc_roll_send_doing', 'doc_roll_note'], 'string', 'max' => 200],
            [['doc_id'], 'string', 'max' => 45],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doc_roll_send_id' => 'Doc Roll Send ID',
            'doc_roll_send_doing' => 'Doc Roll Send Doing',
            'doc_roll_note' => 'Doc Roll Note',
            'doc_id' => 'Doc ID',
        ];
    }
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(CmsDocument::className(), ['doc_id' => 'doc_id']);
    }
}

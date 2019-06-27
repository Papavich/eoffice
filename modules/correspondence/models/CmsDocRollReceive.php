<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_roll_receive".
 *
 * @property string $doc_roll_receive_id
 * @property string $doc_roll_receive_doing
 * @property string $doc_roll_note
 * @property string $doc_id
 *
 * @property CmsDocument $doc
 */
class CmsDocRollReceive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_roll_receive';
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
            [['doc_roll_receive_id', 'doc_id'], 'required'],
            [['doc_roll_receive_id'], 'string', 'max' => 10],
            [['doc_roll_receive_doing', 'doc_roll_note'], 'string', 'max' => 200],
            [['doc_id'], 'string', 'max' => 45],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocument::className(), 'targetAttribute' => ['doc_id' => 'doc_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
        return [
            'doc_roll_receive_id' => 'Doc Roll Receive ID',
            'doc_roll_receive_doing' =>  $funcT('menu', 'Doc Roll Receive Doing'),
            'doc_roll_note' => 'Doc Roll Note',
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

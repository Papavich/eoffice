<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_document_link".
 *
 * @property int $document_link_id
 * @property string $document_link_name
 * @property string $document_link_location
 * @property int $pms_compact_has_prosub_id
 *
 * @property PmsCompactHasProsub $pmsCompactHasProsub
 */
class PmsDocumentLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pms_document_link';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['document_link_name', 'document_link_location', 'pms_compact_has_prosub_id'], 'required'],
            [['pms_compact_has_prosub_id'], 'integer'],
            [['document_link_name', 'document_link_location'], 'string', 'max' => 100],
            [['pms_compact_has_prosub_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasProsub::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'document_link_id' => 'Document Link ID',
            'document_link_name' => 'Document Link Name',
            'document_link_location' => 'Document Link Location',
            'pms_compact_has_prosub_id' => 'Pms Compact Has Prosub ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasProsub()
    {
        return $this->hasOne(PmsCompactHasProsub::className(), ['id' => 'pms_compact_has_prosub_id']);
    }
}

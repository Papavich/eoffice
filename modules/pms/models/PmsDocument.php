<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_document".
 *
 * @property int $document_id
 * @property string $document_name
 * @property int $pms_compact_has_prosub_id
 *
 * @property PmsCompactHasProsub $pmsCompactHasProsub
 */
class PmsDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pms_document';
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
            [['pms_compact_has_prosub_id'], 'required'],
            [['pms_compact_has_prosub_id'], 'integer'],
            [['document_name'], 'string', 'max' => 100],
            [['pms_compact_has_prosub_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasProsub::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'document_id' => 'Document ID',
            'document_name' => 'Document Name',
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

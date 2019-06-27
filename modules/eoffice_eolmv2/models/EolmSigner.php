<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_signer".
 *
 * @property int $person_id
 * @property int $eolm_signer_type_id
 *
 * @property EolmSignerType $eolmSignerType
 */
class EolmSigner extends \yii\db\ActiveRecord
{
    public $person_ids = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_signer';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolmv2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'eolm_signer_type_id'], 'required'],
            [['person_id', 'eolm_signer_type_id'], 'integer'],
            [['person_id', 'eolm_signer_type_id'], 'unique', 'targetAttribute' => ['person_id', 'eolm_signer_type_id']],
            [['eolm_signer_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmSignerType::className(), 'targetAttribute' => ['eolm_signer_type_id' => 'eolm_signer_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'eolm_signer_type_id' => 'Eolm Signer Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmSignerType()
    {
        return $this->hasOne(EolmSignerType::className(), ['eolm_signer_type_id' => 'eolm_signer_type_id']);
    }
}

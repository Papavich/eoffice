<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_signer_type".
 *
 * @property integer $eolm_signer_type_id
 * @property string $eolm_signer_type_name
 *
 * @property EolmSigner[] $eolmSigners
 * @property Person[] $people
 */
class EolmSignerType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_signer_type';
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
            [['eolm_signer_type_id', 'eolm_signer_type_name'], 'required'],
            [['eolm_signer_type_id'], 'integer'],
            [['eolm_signer_type_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_signer_type_id' => 'Eolm Signer Type ID',
            'eolm_signer_type_name' => 'Eolm Signer Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmSigners()
    {
        return $this->hasMany(EolmSigner::className(), ['eolm_signer_type_id' => 'eolm_signer_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])->viaTable('eolm_signer', ['eolm_signer_type_id' => 'eolm_signer_type_id']);
    }
}

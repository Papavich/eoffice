<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_approvalform_has_signer".
 *
 * @property int $eolm_app_id
 * @property int $person_id
 * @property int $eolm_signer_type_id
 *
 * @property EolmApprovalform $eolmApp
 */
class EolmApprovalformHasSigner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_approvalform_has_signer';
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
            [['eolm_app_id', 'person_id', 'eolm_signer_type_id'], 'required'],
            [['eolm_app_id', 'person_id', 'eolm_signer_type_id'], 'integer'],
            [['eolm_app_id', 'person_id', 'eolm_signer_type_id'], 'unique', 'targetAttribute' => ['eolm_app_id', 'person_id', 'eolm_signer_type_id']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'Eolm App ID',
            'person_id' => 'Person ID',
            'eolm_signer_type_id' => 'Eolm Signer Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
}

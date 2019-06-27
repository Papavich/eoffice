<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_approvalform_has_personal".
 *
 * @property int $person_id
 * @property int $eolm_app_id
 * @property int $eolm_app_has_person_type_id
 *
 * @property EolmApprovalformHasPersonType $eolmAppHasPersonType
 * @property EolmApprovalform $eolmApp
 */
class EolmApprovalformHasPersonal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_approvalform_has_personal';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*[['person_id', 'eolm_app_id'], 'required'],*/
            [['person_id', 'eolm_app_id', 'eolm_app_has_person_type_id'], 'integer'],
            [['person_id', 'eolm_app_id'], 'unique', 'targetAttribute' => ['person_id', 'eolm_app_id']],
            [['eolm_app_has_person_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalformHasPersonType::className(), 'targetAttribute' => ['eolm_app_has_person_type_id' => 'eolm_app_has_person_type_id']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'eolm_app_id' => 'Eolm App ID',
            'eolm_app_has_person_type_id' => 'Eolm App Has Person Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmAppHasPersonType()
    {
        return $this->hasOne(EolmApprovalformHasPersonType::className(), ['eolm_app_has_person_type_id' => 'eolm_app_has_person_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
}

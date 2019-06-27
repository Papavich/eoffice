<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_approvalform_has_person_type".
 *
 * @property integer $eolm_app_has_person_type_id
 * @property string $eolm_app_has_person_type_name
 *
 * @property EolmApprovalformHasPersonal[] $eolmApprovalformHasPersonals
 */
class EolmApprovalformHasPersonType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_approvalform_has_person_type';
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
            [['eolm_app_has_person_type_id'], 'required'],
            [['eolm_app_has_person_type_id'], 'integer'],
            [['eolm_app_has_person_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_has_person_type_id' => 'Eolm App Has Person Type ID',
            'eolm_app_has_person_type_name' => 'Eolm App Has Person Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasPersonals()
    {
        return $this->hasMany(EolmApprovalformHasPersonal::className(), ['eolm_app_has_person_type_id' => 'eolm_app_has_person_type_id']);
    }
}

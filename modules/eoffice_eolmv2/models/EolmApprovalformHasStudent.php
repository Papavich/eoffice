<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_approvalform_has_student".
 *
 * @property int $eolm_app_id
 * @property string $STUDENTID
 *
 * @property EolmApprovalform $eolmApp
 */
class EolmApprovalformHasStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_approvalform_has_student';
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
            [['eolm_app_id', 'STUDENTID'], 'required'],
            [['eolm_app_id'], 'integer'],
            [['STUDENTID'], 'string', 'max' => 20],
            [['eolm_app_id', 'STUDENTID'], 'unique', 'targetAttribute' => ['eolm_app_id', 'STUDENTID']],
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
            'STUDENTID' => 'Studentid',
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

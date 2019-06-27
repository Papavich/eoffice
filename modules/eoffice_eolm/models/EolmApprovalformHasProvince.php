<?php

namespace app\modules\eoffice_eolm\models;

use app\modules\eoffice_eolm\models\model_main\EofficeMainProvince;
use Yii;

/**
 * This is the model class for table "eolm_approvalform_has_province".
 *
 * @property int $PROVINCE_ID
 * @property int $eolm_app_id
 *
 * @property EolmApprovalform $eolmApp
 */
class EolmApprovalformHasProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_approvalform_has_province';
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
            [['PROVINCE_ID', 'eolm_app_id'], 'required'],
            [['PROVINCE_ID', 'eolm_app_id'], 'integer'],
            [['PROVINCE_ID', 'eolm_app_id'], 'unique', 'targetAttribute' => ['PROVINCE_ID', 'eolm_app_id']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROVINCE_ID' => 'Province  ID',
            'eolm_app_id' => 'Eolm App ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
    public function getProname()
    {
        return $this->hasOne(EofficeMainProvince::className(), ['PROVINCE_ID' => 'PROVINCE_ID']);
    }
}

<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_repay".
 *
 * @property int $eolm_app_id
 * @property string $eolm_repay_date
 * @property string $eolm_repay
 *
 * @property EolmLoancontract $eolmApp
 */
class EolmRepay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_repay';
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
            [['eolm_app_id', 'eolm_repay_date'], 'required'],
            [['eolm_app_id'], 'integer'],
            [['eolm_repay_date'], 'safe'],
            [['eolm_repay'], 'number'],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmLoancontract::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'แบบขออนุมัติ',
            'eolm_repay_date' => 'วันที่คืน',
            'eolm_repay' => 'คืนเงิน',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmLoancontract::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
    public function getEolmAppform()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
}

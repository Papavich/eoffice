<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_loancontract".
 *
 * @property integer $eolm_app_id
 * @property string $eolm_loa_date
 * @property string $eolm_loa_use_date
 * @property string $eolm_loa_refund_date
 * @property integer $eolm_loa_examiner
 * @property integer $eolm_loa_approvers
 * @property string $eolm_loa_number
 * @property string $eolm_loa_total_amout
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 * @property string $eolm_loa_total_text
 *
 * @property EolmBorrowingplans[] $eolmBorrowingplans
 * @property EolmApprovalform $eolmApp
 */
class EolmLoancontract extends \yii\db\ActiveRecord
{
    public $person_ids1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_loancontract';
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
            /*[['eolm_app_id'], 'required'],*/
            [['eolm_loa_approvers', 'eolm_loa_date'], 'required'],
            [['eolm_app_id', 'eolm_loa_examiner', 'crby', 'udby'], 'integer'],
            [['eolm_loa_date', /*'eolm_loa_use_date', 'eolm_loa_refund_date', */'crtime', 'udtime'], 'safe'],
            [['eolm_loa_total_amout'], 'number'],
            [['eolm_loa_approvers', 'eolm_loa_number'], 'string', 'max' => 50],
            [['eolm_loa_total_text'], 'string', 'max' => 200],
            [['eolm_app_id'], 'unique'],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'รหัสแบบขออนุมัติ',
            'eolm_loa_date' => 'วันทีวันครบกำหนด',
            //'eolm_loa_use_date' => 'มีความจำเป็นต้องใช้เงินวันที่',
            //'eolm_loa_refund_date' => 'ส่งคืนวันที่',
            'eolm_loa_examiner' => 'ผู้ตรวจสอบ',
            'eolm_loa_approvers' => 'ยื่นต่อ',
            'eolm_loa_number' => 'เลขที่สัญญา',
            'eolm_loa_total_amout' => 'จำนวนเงิน',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'eolm_loa_total_text' => 'จำนวนเงิน(ตัวหนังสือ)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBorrowingplans()
    {
        return $this->hasMany(EolmBorrowingplans::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
}

<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_receipt_student".
 *
 * @property int $eolm_app_id
 * @property string $person_id
 * @property string $eolm_rec_std_total
 * @property string $eolm_rec_std_text
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property EolmApprovalform $eolmApp
 * @property EolmReceiptStudentDetail[] $eolmReceiptStudentDetails
 */
class EolmReceiptStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_receipt_student';
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
            [[/*'eolm_app_id',*/ 'person_id', 'eolm_rec_std_text'], 'required'],
            [['eolm_app_id', 'crby', 'udby'], 'integer'],
            [['eolm_rec_std_total'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['person_id'], 'string', 'max' => 20],
            [['eolm_rec_std_text'], 'string', 'max' => 200],
            [['eolm_app_id', 'person_id'], 'unique', 'targetAttribute' => ['eolm_app_id', 'person_id']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'แบบขออนุมัติ',
            'person_id' => 'สำหรับ',
            'eolm_rec_std_total' => 'รวมเป็นเงิน',
            'eolm_rec_std_text' => 'รวมเป็นเงิน(ตัวหนังสือ)',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmReceiptStudentDetails()
    {
        return $this->hasMany(EolmReceiptStudentDetail::className(), ['person_id' => 'person_id', 'eolm_app_id' => 'eolm_app_id']);
    }

}

<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_receipt_student_detail".
 *
 * @property string $person_id
 * @property int $eolm_app_id
 * @property string $eolm_rec_std_detail_date
 * @property string $eolm_rec_std_detail_detail
 * @property string $eolm_rec_std_detail_amount
 * @property string $eolm_rec_std_detail_note
 *
 * @property EolmReceiptStudent $person
 */
class EolmReceiptStudentDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_receipt_student_detail';
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
            [['eolm_app_id'], 'integer'],
            [['eolm_rec_std_detail_date'], 'safe'],
            [['eolm_rec_std_detail_amount'], 'number'],
            [['person_id'], 'string', 'max' => 20],
            [['eolm_rec_std_detail_detail', 'eolm_rec_std_detail_note'], 'string', 'max' => 200],
            [['person_id', 'eolm_app_id'], 'unique', 'targetAttribute' => ['person_id', 'eolm_app_id']],
            [['person_id', 'eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmReceiptStudent::className(), 'targetAttribute' => ['person_id' => 'person_id', 'eolm_app_id' => 'eolm_app_id']],
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
            'eolm_rec_std_detail_date' => 'Eolm Rec Std Detail Date',
            'eolm_rec_std_detail_detail' => 'Eolm Rec Std Detail Detail',
            'eolm_rec_std_detail_amount' => 'Eolm Rec Std Detail Amount',
            'eolm_rec_std_detail_note' => 'Eolm Rec Std Detail Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(EolmReceiptStudent::className(), ['person_id' => 'person_id', 'eolm_app_id' => 'eolm_app_id']);
    }
}

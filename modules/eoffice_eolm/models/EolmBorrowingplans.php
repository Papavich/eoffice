<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_borrowingplans".
 *
 * @property integer $eolm_app_id
 * @property integer $eolm_bor_periods
 * @property string $eolm_bor_date_spent
 *
 * @property EolmLoancontract $eolmApp
 * @property EolmBorrowingplansDetails[] $eolmBorrowingplansDetails
 */
class EolmBorrowingplans extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_borrowingplans';
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
            [[/*'eolm_app_id',*/ 'eolm_bor_periods','eolm_bor_date_spent','eolm_bor_date_repay'], 'required'],

            [['eolm_app_id', 'eolm_bor_periods'], 'integer'],
            [['eolm_bor_date_spent','eolm_bor_date_repay'], 'safe'],
            [['eolm_app_id', 'eolm_bor_periods'], 'unique', 'targetAttribute' => ['eolm_app_id', 'eolm_bor_periods']],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmLoancontract::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
            ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'Eolm App ID',
            'eolm_bor_periods' => 'Eolm Bor Periods',
            'eolm_bor_date_spent' => 'Eolm Bor Date Spent',
            'eolm_bor_date_repay' => 'Eolm Bor Date repay',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmLoancontract::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBorrowingplansItems()
    {
        return $this->hasMany(EolmBorrowingplansItem::className(), ['eolm_bor_periods' => 'eolm_bor_periods', 'eolm_app_id' => 'eolm_app_id']);
    }

}

<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_borrowingplans_item".
 *
 * @property int $eolm_app_id
 * @property int $eolm_bor_periods
 * @property int $eolm_bor_type_id
 * @property string $eolm_bor_detail
 * @property int $eolm_bor_amount_date
 * @property string $eolm_bor_amount
 * @property string $eolm_bor_note
 *
 * @property EolmBorrowingplans $eolmBorPeriods
 * @property EolmBorrowingplansType $eolmBorType
 */
class EolmBorrowingplansItem extends \yii\db\ActiveRecord
{
    public $eolm_bor_type_id0,$eolm_bor_detail0,$eolm_bor_amount_date0,$eolm_bor_amount0,$eolm_bor_note0;
    public $eolm_bor_type_id1,$eolm_bor_detail1,$eolm_bor_amount_date1,$eolm_bor_amount1,$eolm_bor_note1;
    /**
     *
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_borrowingplans_item';
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
            /*[['eolm_app_id', 'eolm_bor_periods', 'eolm_bor_type_id'], 'required'],*/
            [['eolm_app_id', 'eolm_bor_periods', 'eolm_bor_type_id', 'eolm_bor_amount_date'], 'integer'],
            [['eolm_bor_type_id0','eolm_bor_detail0','eolm_bor_amount_date0','eolm_bor_amount0','eolm_bor_note0',
                'eolm_bor_type_id1','eolm_bor_detail1','eolm_bor_amount_date1','eolm_bor_amount1','eolm_bor_note1'], 'safe'],
            [['eolm_bor_amount'], 'number'],
            [['eolm_bor_detail', 'eolm_bor_note'], 'string', 'max' => 200],
            [['eolm_bor_periods', 'eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmBorrowingplans::className(), 'targetAttribute' => ['eolm_bor_periods' => 'eolm_bor_periods', 'eolm_app_id' => 'eolm_app_id']],
            [['eolm_bor_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmBorrowingplansType::className(), 'targetAttribute' => ['eolm_bor_type_id' => 'eolm_bor_type_id']],
        ];
    }
   /* public function afterSave($insert, $changedAttributes){
        foreach ($this as $indexDetail => $modelDetail) {
            if (! empty($this->eolm_bor_type_id0)) {
                $av = new EolmBorrowingplansItem;
                $av->eolm_app_id = $this->eolm_app_id;
                $av->eolm_bor_periods = $this->eolm_bor_periods;
                $av->eolm_bor_type_id = $this->eolm_bor_type_id1;
                $av->eolm_bor_detail = $this->eolm_bor_detail1;
                $av->eolm_bor_amount_date = $this->eolm_bor_amount_date1;
                $av->eolm_bor_amount = $this->eolm_bor_amount1;
                $av->eolm_bor_note = $this->eolm_bor_note1;
                $av->save();
            }

        }
    }*/

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'Eolm App ID',
            'eolm_bor_periods' => 'Eolm Bor Periods',
            'eolm_bor_type_id' => 'Eolm Bor Type ID',
            'eolm_bor_detail' => 'Eolm Bor Detail',
            'eolm_bor_amount_date' => 'Eolm Bor Amount Date',
            'eolm_bor_amount' => 'Eolm Bor Amount',
            'eolm_bor_note' => 'Eolm Bor Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBorPeriods()
    {
        return $this->hasOne(EolmBorrowingplans::className(), ['eolm_bor_periods' => 'eolm_bor_periods', 'eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBorType()
    {
        return $this->hasOne(EolmBorrowingplansType::className(), ['eolm_bor_type_id' => 'eolm_bor_type_id']);
    }
}

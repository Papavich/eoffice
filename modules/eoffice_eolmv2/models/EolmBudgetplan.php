<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_budgetplan".
 *
 * @property integer $eolm_budp_id
 * @property string $eolm_budp_name
 * @property integer $eolm_budt_id
 * @property integer $eolm_exp_id
 *
 * @property EolmApprovalform[] $eolmApprovalforms
 * @property EolmBudgettype $eolmBudt
 * @property EolmExpenditurecategoty $eolmExp
 */
class EolmBudgetplan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_budgetplan';
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
            [['eolm_budt_id', 'eolm_exp_id'], 'required'],
            [['eolm_budt_id', 'eolm_exp_id'], 'integer'],
            [['eolm_budp_name'], 'string', 'max' => 100],
            [['eolm_budt_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmBudgettype::className(), 'targetAttribute' => ['eolm_budt_id' => 'eolm_budt_id']],
            [['eolm_exp_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmExpenditurecategoty::className(), 'targetAttribute' => ['eolm_exp_id' => 'eolm_exp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_budp_id' => 'Eolm Budp ID',
            'eolm_budp_name' => 'Eolm Budp Name',
            'eolm_budt_id' => 'Eolm Budt ID',
            'eolm_exp_id' => 'Eolm Exp ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalforms()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_budp_id' => 'eolm_budp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBudt()
    {
        return $this->hasOne(EolmBudgettype::className(), ['eolm_budt_id' => 'eolm_budt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmExp()
    {
        return $this->hasOne(EolmExpenditurecategoty::className(), ['eolm_exp_id' => 'eolm_exp_id']);
    }
}

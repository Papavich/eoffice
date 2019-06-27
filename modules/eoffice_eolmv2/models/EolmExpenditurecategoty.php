<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "eolm_expenditurecategoty".
 *
 * @property integer $eolm_exp_id
 * @property string $eolm_exp_name
 *
 * @property EolmApprovalform[] $eolmApprovalforms
 * @property EolmBudgetplan[] $eolmBudgetplans
 */
class EolmExpenditurecategoty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_expenditurecategoty';
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
            [['eolm_exp_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_exp_id' => 'Eolm Exp ID',
            'eolm_exp_name' => 'Eolm Exp Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalforms()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_exp_id' => 'eolm_exp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBudgetplans()
    {
        return $this->hasMany(EolmBudgetplan::className(), ['eolm_exp_id' => 'eolm_exp_id']);
    }
}

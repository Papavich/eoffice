<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_budgettype".
 *
 * @property integer $eolm_budt_id
 * @property string $eolm_budt_name
 *
 * @property EolmApprovalform[] $eolmApprovalforms
 * @property EolmBudgetplan[] $eolmBudgetplans
 */
class EolmBudgettype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_budgettype';
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
            [['eolm_budt_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_budt_id' => 'Eolm Budt ID',
            'eolm_budt_name' => 'Eolm Budt Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalforms()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_budt_id' => 'eolm_budt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBudgetplans()
    {
        return $this->hasMany(EolmBudgetplan::className(), ['eolm_budt_id' => 'eolm_budt_id']);
    }
}

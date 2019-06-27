<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "budget_sub".
 *
 * @property int $budget_id
 * @property string $budget_name
 * @property int $budget_main_budget_id
 *
 * @property BudgetMain $budgetMainBudget
 */
class BudgetSub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'budget_sub';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['budget_main_budget_id'], 'required'],
            [['budget_main_budget_id'], 'integer'],
            [['budget_name'], 'string', 'max' => 256],
            [['budget_main_budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => BudgetMain::className(), 'targetAttribute' => ['budget_main_budget_id' => 'budget_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'budget_id' => 'Budget ID',
            'budget_name' => 'Budget Name',
            'budget_main_budget_id' => 'Budget Main Budget ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgetMainBudget()
    {
        return $this->hasOne(BudgetMain::className(), ['budget_id' => 'budget_main_budget_id']);
    }
}

<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_projectsub_budget".
 *
 * @property int $prosub_budget_id
 * @property int $group_expenditure
 * @property int $group_expenses
 * @property int $group_plan
 * @property int $group_subsidized_strategy
 * @property int $budget_limit
 * @property int $budget_payment
 * @property int $budget_year
 * @property string $budget_other
 * @property string $pms_project_sub_prosub_code
 * @property int $budget_main
 * @property int $budget_sub
 *
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsProjectsubBudget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_projectsub_budget';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prosub_budget_id', 'pms_project_sub_prosub_code'], 'required'],
            [['prosub_budget_id', 'group_expenditure', 'group_expenses', 'group_plan', 'group_subsidized_strategy', 'budget_limit', 'budget_payment', 'budget_year', 'budget_main', 'budget_sub'], 'integer'],
            [['budget_other'], 'string', 'max' => 100],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['prosub_budget_id'], 'unique'],
            [['pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProjectSub::className(), 'targetAttribute' => ['pms_project_sub_prosub_code' => 'prosub_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prosub_budget_id' => 'Prosub Budget ID',
            'group_expenditure' => 'Group Expenditure',
            'group_expenses' => 'Group Expenses',
            'group_plan' => 'Group Plan',
            'group_subsidized_strategy' => 'Group Subsidized Strategy',
            'budget_limit' => 'Budget Limit',
            'budget_payment' => 'Budget Payment',
            'budget_year' => 'Budget Year',
            'budget_other' => 'Budget Other',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
            'budget_main' => 'Budget Main',
            'budget_sub' => 'Budget Sub',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubProsubCode()
    {
        return $this->hasOne(PmsProjectSub::className(), ['prosub_code' => 'pms_project_sub_prosub_code']);
    }
}

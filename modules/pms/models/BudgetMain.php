<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "budget_main".
 *
 * @property int $budget_id
 * @property string $budget_name
 *
 * @property BudgetSub[] $budgetSubs
 */
class BudgetMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'budget_main';
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
            [['budget_name'], 'string', 'max' => 256],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgetSubs()
    {
        return $this->hasMany(BudgetSub::className(), ['budget_main_budget_id' => 'budget_id']);
    }
}

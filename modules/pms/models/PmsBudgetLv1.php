<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_budget_lv1".
 *
 * @property int $budget_id
 * @property string $budget_name
 */
class PmsBudgetLv1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_budget_lv1';
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
            [['budget_name'], 'required'],
            [['budget_name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'budget_id' => 'Budget ID',
            'budget_name' => 'Budget Name',
        ];
    }
}

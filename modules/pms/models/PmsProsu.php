<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_projectsub_budgetss".
 *
 * @property int $prosub_budget_id
 * @property string $budget_other
 * @property int $budget_limit
 * @property int $budget_payment
 * @property int $budget_year
 * @property string $pms_project_sub_prosub_code
 *
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsProsu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_projectsub_budgetss';
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
            [['budget_limit', 'budget_payment', 'budget_year'], 'integer'],
            [['pms_project_sub_prosub_code'], 'required'],
            [['budget_other'], 'string', 'max' => 100],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
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
            'budget_other' => 'Budget Other',
            'budget_limit' => 'Budget Limit',
            'budget_payment' => 'Budget Payment',
            'budget_year' => 'Budget Year',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
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

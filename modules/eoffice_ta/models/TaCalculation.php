<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_calculation".
 *
 * @property int $ta_calculate_id
 * @property string $symbol
 * @property string $symbol_value
 * @property string $status_symbol
 * @property int $ta_rule_id
 * @property int $order
 *
 * @property TaRuleApproach $taRule
 */
class TaCalculation extends \yii\db\ActiveRecord
{
    const SYMBOL_MAIN_OR_ANSWER = 'main';   //Answer คำตอบ
    const SYMBOL_VARIABLE = 'var';    //ตัวแปร variable
    const SYMBOL_OPERATOR = 'op';   //ตำเนินการ
    const SYMBOL_PARENTHESES = 'par';   //วงเล็บ
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_calculation';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['symbol_value'], 'number'],
            [['status_symbol'], 'string'],
            [['ta_rule_id', 'order'], 'integer'],
            [['symbol'], 'string', 'max' => 10],
            [['ta_rule_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaRuleApproach::className(), 'targetAttribute' => ['ta_rule_id' => 'ta_rule_approach_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_calculate_id' => 'Ta Calculate ID',
            'symbol' => 'Symbol',
            'symbol_value' => 'Symbol Value',
            'status_symbol' => 'Status Symbol',
            'ta_rule_id' => 'Ta Rule ID',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRule()
    {
        return $this->hasOne(TaRuleApproach::className(), ['ta_rule_approach_id' => 'ta_rule_id']);
    }
}

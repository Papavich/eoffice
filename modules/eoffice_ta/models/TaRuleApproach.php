<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_rule_approach".
 *
 * @property integer $ta_rule_approach_id
 * @property string $ta_rule_approach_name
 * @property string $ta_rule_approach_detail
 * @property integer $ta_type_rule_id
 * @property string $active_statuss
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property TaCalculation[] $taCalculations
 * @property TaTypeRule $taTypeRule
 */
class TaRuleApproach extends \yii\db\ActiveRecord
{
    const APPROACH_ACTIVE = '1';
    const APPROACH_NONACTIVE = '0';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_rule_approach';
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
            [['ta_type_rule_id', 'crby', 'udby'], 'integer'],
            [['active_statuss'], 'string'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_rule_approach_name'], 'string', 'max' => 200],
            [['ta_rule_approach_detail'], 'string', 'max' => 500],
            [['ta_type_rule_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaTypeRule::className(), 'targetAttribute' => ['ta_type_rule_id' => 'ta_type_rule_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_rule_approach_id' => 'Ta Rule Approach ID',
            'ta_rule_approach_name' => controllers::t( 'label', 'Approach Name'),
            'ta_rule_approach_detail' => controllers::t( 'label', 'Detail'),
            'ta_type_rule_id' => controllers::t( 'label', 'Type Rule'),
            'active_statuss' => controllers::t( 'label', 'Status'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaCalculations()
    {
        return $this->hasMany(TaCalculation::className(), ['ta_rule_id' => 'ta_rule_approach_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTypeRule()
    {
        return $this->hasOne(TaTypeRule::className(), ['ta_type_rule_id' => 'ta_type_rule_id']);
    }
}

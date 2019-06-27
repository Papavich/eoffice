<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_equation".
 *
 * @property int $ta_equation_id
 * @property string $ta_equation_name
 * @property string $ta_equation_detail
 * @property int $ans
 * @property int $ta_type_rule_id
 * @property string $active_status
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaTypeRule $taTypeRule
 * @property TaVariable $ans0
 */
class TaEquation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_equation';
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
            [['ta_equation_detail', 'active_status'], 'string'],
            [['ans', 'ta_type_rule_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_equation_name'], 'string', 'max' => 500],
            [['ta_type_rule_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaTypeRule::className(), 'targetAttribute' => ['ta_type_rule_id' => 'ta_type_rule_id']],
            [['ans'], 'exist', 'skipOnError' => true, 'targetClass' => TaVariable::className(), 'targetAttribute' => ['ans' => 'ta_variable_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_equation_id' => controllers::t('label','ID'),
            'ta_equation_name' => controllers::t('label','Ta Equation Name'),
            'ta_equation_detail' => controllers::t('label','Detail'),
            'ans' => controllers::t('label','Ans'),
            'ta_type_rule_id' => controllers::t('label','Type Rule'),
            'active_status' => controllers::t('label','Status'),
            'crby' => controllers::t('label','Create By'),
            'crtime' => controllers::t('label','Create Time'),
            'udby' => controllers::t('label','Update By'),
            'udtime' => controllers::t('label','Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTypeRule()
    {
        return $this->hasOne(TaTypeRule::className(), ['ta_type_rule_id' => 'ta_type_rule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAns0()
    {
        return $this->hasOne(TaVariable::className(), ['ta_variable_id' => 'ans']);
    }
}

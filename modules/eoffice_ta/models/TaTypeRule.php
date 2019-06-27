<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_type_rule".
 *
 * @property integer $ta_type_rule_id
 * @property string $ta_type_rule_name
 * @property string $ta_type_detail
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property TaRuleApproach[] $taRuleApproaches
 */
class TaTypeRule extends \yii\db\ActiveRecord
{
    const TYPE_R_WORK_LOAD_ALL = 1;
    const TYPE_R_CREDIT = 2;
    const TYPE_R_NUMBER_OF_TA = 3;
    const TYPE_R_WORK_LOAD_Lec = 4;
    const TYPE_R_WORK_LOAD_Lab = 5;
    const TYPE_R_PAY_MAAX_All = 6;
    const TYPE_R_CREDIT_LEC = 7;
    const TYPE_R_CREDIT_LAB = 8;
    const TYPE_R_PAY_MAAX_Lec = 9;
    const TYPE_R_PAY_MAAX_LAB = 10;
    const TYPE_R_PAY_BN = 11;
    const TYPE_R_PAY_BS = 12;
    const TYPE_R_PAY_GN = 13;
    const TYPE_R_PAY_GS = 14;
    const TYPE_R_ESPAY_N = 15;
    const TYPE_R_ESPAY_G = 16;
    const TYPE_R_PAY_MIX_BN = 17;
    const TYPE_R_PAY_MIX_BS = 18;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_type_rule';
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
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_type_rule_name'], 'string', 'max' => 300],
            [['ta_type_detail'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_type_rule_id' => 'Rule ID',
            'ta_type_rule_name' => 'ชื่อประเภทสูตร',
            'ta_type_detail' => controllers::t( 'label', 'Detail' ),
            'crby' => controllers::t('label','Create By'),
            'crtime' => controllers::t('label','Create Time'),
            'udby' => controllers::t('label','Update By'),
            'udtime' => controllers::t('label','Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRuleApproaches()
    {
        return $this->hasMany(TaRuleApproach::className(), ['ta_type_rule_id' => 'ta_type_rule_id']);
    }
}

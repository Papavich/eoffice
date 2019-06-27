<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_variable".
 *
 * @property int $ta_variable_id
 * @property string $ta_variable_name
 * @property string $ta_variable_value
 * @property string $ta_variable_detail
 * @property string $status
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 */
class TaVariable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_variable';
    }

    const TYPE_VARIABLE_MAIN = 'main';
    const TYPE_VARIABLE_VAR = 'var';
    const TYPE_VARIABLE_FIX = 'fix';
    const TYPE_VARIABLE_NONFIX = 'nonfix';
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
            [['ta_variable_value'], 'number'],
            [['ta_variable_detail', 'status'], 'string'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_variable_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_variable_id' => controllers::t('label','ID'),
            'ta_variable_name' => controllers::t('label','Variable Name'),
            'ta_variable_value' => controllers::t('label','Variable Value'),
            'ta_variable_detail' => controllers::t('label','Detail'),
            'status' => controllers::t('label','Status'),
            'crby' => controllers::t('label','Create By'),
            'crtime' => controllers::t('label','Create Time'),
            'udby' => controllers::t('label','Update By'),
            'udtime' => controllers::t('label','Update Time'),
        ];
    }
}

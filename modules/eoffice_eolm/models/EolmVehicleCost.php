<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_vehicle_cost".
 *
 * @property integer $eolm_vehicle_cost_id
 * @property integer $eolm_vehicle_cost
 */
class EolmVehicleCost extends \yii\db\ActiveRecord
{
    public $vehicle2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_vehicle_cost';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vehicle2'], 'safe'],
            [['eolm_vehicle_cost_id'], 'required'],
            [['eolm_vehicle_cost_id', 'eolm_vehicle_cost'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_vehicle_cost_id' => 'Eolm Vehicle Cost ID',
            'eolm_vehicle_cost' => 'Eolm Vehicle Cost',
        ];
    }
}

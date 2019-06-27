<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_execute_has_cost".
 *
 * @property int $id
 * @property string $detail
 * @property int $cost
 * @property int $pms_compact_has_prosub_id
 * @property int $pms_execute_execute_id
 *
 * @property PmsCompactHasExecute $pmsCompactHasProsub
 */
class PmsExecuteHasCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_execute_has_cost';
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
            [['cost', 'pms_compact_has_prosub_id', 'pms_execute_execute_id'], 'integer'],
            [['pms_compact_has_prosub_id', 'pms_execute_execute_id'], 'required'],
            [['detail'], 'string', 'max' => 45],
            [['pms_compact_has_prosub_id', 'pms_execute_execute_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasExecute::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'pms_compact_has_prosub_id', 'pms_execute_execute_id' => 'pms_execute_execute_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail' => 'Detail',
            'cost' => 'Cost',
            'pms_compact_has_prosub_id' => 'Pms Compact Has Prosub ID',
            'pms_execute_execute_id' => 'Pms Execute Execute ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasProsub()
    {
        return $this->hasOne(PmsCompactHasExecute::className(), ['pms_compact_has_prosub_id' => 'pms_compact_has_prosub_id', 'pms_execute_execute_id' => 'pms_execute_execute_id']);
    }
}

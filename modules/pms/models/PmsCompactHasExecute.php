<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_compact_has_execute".
 *
 * @property int $pms_compact_has_prosub_id
 * @property int $pms_execute_execute_id
 *
 * @property PmsCompactHasProsub $pmsCompactHasProsub
 * @property PmsExecute $pmsExecuteExecute
 * @property PmsExecuteHasCost[] $pmsExecuteHasCosts
 */
class PmsCompactHasExecute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pms_compact_has_execute';
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
            [['pms_compact_has_prosub_id', 'pms_execute_execute_id'], 'required'],
            [['pms_compact_has_prosub_id', 'pms_execute_execute_id'], 'integer'],
            [['pms_compact_has_prosub_id', 'pms_execute_execute_id'], 'unique', 'targetAttribute' => ['pms_compact_has_prosub_id', 'pms_execute_execute_id']],
            [['pms_compact_has_prosub_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasProsub::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'id']],
            [['pms_execute_execute_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsExecute::className(), 'targetAttribute' => ['pms_execute_execute_id' => 'execute_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pms_compact_has_prosub_id' => 'Pms Compact Has Prosub ID',
            'pms_execute_execute_id' => 'Pms Execute Execute ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasProsub()
    {
        return $this->hasOne(PmsCompactHasProsub::className(), ['id' => 'pms_compact_has_prosub_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsExecuteExecute()
    {
        return $this->hasOne(PmsExecute::className(), ['execute_id' => 'pms_execute_execute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsExecuteHasCosts()
    {
        return $this->hasMany(PmsExecuteHasCost::className(), ['pms_compact_has_prosub_id' => 'pms_compact_has_prosub_id', 'pms_execute_execute_id' => 'pms_execute_execute_id']);
    }
}

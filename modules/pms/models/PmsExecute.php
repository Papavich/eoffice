<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_execute".
 *
 * @property int $execute_id
 * @property string $execute_name
 * @property string $execute_timestart
 * @property string $execute_timeend
 * @property string $execute_operationplan
 * @property string $execute_targetgroup
 * @property int $execute_amount
 * @property string $pms_project_sub_prosub_code
 * @property int $execute_cost
 * @property int $execute_no
 *
 * @property PmsCompactHasExecute[] $pmsCompactHasExecutes
 * @property PmsCompactHasProsub[] $pmsCompactHasProsubs
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsExecute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pms_execute';
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
            [['execute_timestart', 'execute_timeend'], 'safe'],
            [['execute_amount', 'execute_cost', 'execute_no'], 'integer'],
            [['pms_project_sub_prosub_code'], 'required'],
            [['execute_name', 'execute_operationplan'], 'string', 'max' => 256],
            [['execute_targetgroup'], 'string', 'max' => 100],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProjectSub::className(), 'targetAttribute' => ['pms_project_sub_prosub_code' => 'prosub_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'execute_id' => 'Execute ID',
            'execute_name' => 'Execute Name',
            'execute_timestart' => 'Execute Timestart',
            'execute_timeend' => 'Execute Timeend',
            'execute_operationplan' => 'Execute Operationplan',
            'execute_targetgroup' => 'Execute Targetgroup',
            'execute_amount' => 'Execute Amount',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
            'execute_cost' => 'Execute Cost',
            'execute_no' => 'Execute No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasExecutes()
    {
        return $this->hasMany(PmsCompactHasExecute::className(), ['pms_execute_execute_id' => 'execute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasProsubs()
    {
        return $this->hasMany(PmsCompactHasProsub::className(), ['id' => 'pms_compact_has_prosub_id'])->viaTable('pms_compact_has_execute', ['pms_execute_execute_id' => 'execute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubProsubCode()
    {
        return $this->hasOne(PmsProjectSub::className(), ['prosub_code' => 'pms_project_sub_prosub_code']);
    }
}

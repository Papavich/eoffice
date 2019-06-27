<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_compact_has_method".
 *
 * @property int $id
 * @property string $method_detail
 * @property int $pms_compact_has_prosub_id
 * @property int $pms_governance_has_project_sub_governance_id
 * @property string $pms_governance_has_project_sub_pms_project_sub_prosub_code
 *
 * @property PmsCompactHasProsub $pmsCompactHasProsub
 * @property PmsGovernanceHasProjectSub $pmsGovernanceHasProjectSubGovernance
 */
class PmsCompactHasMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_compact_has_method';
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
            [['pms_compact_has_prosub_id', 'pms_governance_has_project_sub_governance_id', 'pms_governance_has_project_sub_pms_project_sub_prosub_code'], 'required'],
            [['pms_compact_has_prosub_id', 'pms_governance_has_project_sub_governance_id'], 'integer'],
            [['method_detail'], 'string', 'max' => 256],
            [['pms_governance_has_project_sub_pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['pms_compact_has_prosub_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsCompactHasProsub::className(), 'targetAttribute' => ['pms_compact_has_prosub_id' => 'id']],
            [['pms_governance_has_project_sub_governance_id', 'pms_governance_has_project_sub_pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsGovernanceHasProjectSub::className(), 'targetAttribute' => ['pms_governance_has_project_sub_governance_id' => 'governance_id', 'pms_governance_has_project_sub_pms_project_sub_prosub_code' => 'pms_project_sub_prosub_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'method_detail' => 'Method Detail',
            'pms_compact_has_prosub_id' => 'Pms Compact Has Prosub ID',
            'pms_governance_has_project_sub_governance_id' => 'Pms Governance Has Project Sub Governance ID',
            'pms_governance_has_project_sub_pms_project_sub_prosub_code' => 'Pms Governance Has Project Sub Pms Project Sub Prosub Code',
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
    public function getPmsGovernanceHasProjectSubGovernance()
    {
        return $this->hasOne(PmsGovernanceHasProjectSub::className(), ['governance_id' => 'pms_governance_has_project_sub_governance_id', 'pms_project_sub_prosub_code' => 'pms_governance_has_project_sub_pms_project_sub_prosub_code']);
    }
}

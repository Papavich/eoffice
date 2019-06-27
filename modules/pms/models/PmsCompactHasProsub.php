<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_compact_has_prosub".
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property string $save_date
 * @property string $phone_no
 * @property string $pms_project_sub_prosub_code
 * @property int $group_expenses
 * @property int $group_plan
 * @property int $group_subsidized_strategy
 * @property int $sum_payment
 * @property string $status_finance
 * @property string $status_pandf
 * @property string $status_result
 * @property int $round
 * @property string $indicator
 * @property string $rate
 * @property string $result_evaluate
 * @property int $status_process
 * @property string $summary_save
 * @property int $compact_manager
 * @property string $compact_save
 *
 * @property PmsCompactHasExecute[] $pmsCompactHasExecutes
 * @property PmsExecute[] $pmsExecuteExecutes
 * @property PmsCompactHasMethod[] $pmsCompactHasMethods
 * @property PmsProjectSub $pmsProjectSubProsubCode
 * @property PmsCompactHasTargetgroup[] $pmsCompactHasTargetgroups
 * @property PmsDocument[] $pmsDocuments
 * @property PmsDocumentLink[] $pmsDocumentLinks
 * @property PmsResultProblem[] $pmsResultProblems
 * @property PmsResultQuality[] $pmsResultQualities
 * @property PmsResultSuggest[] $pmsResultSuggests
 */
class PmsCompactHasProsub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pms_compact_has_prosub';
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
            [['start_date', 'end_date', 'save_date'], 'safe'],
            [['pms_project_sub_prosub_code'], 'required'],
            [['group_expenses', 'group_plan', 'group_subsidized_strategy', 'sum_payment', 'round', 'status_process', 'compact_manager'], 'integer'],
            [['phone_no'], 'string', 'max' => 13],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['status_finance', 'status_pandf', 'result_evaluate'], 'string', 'max' => 100],
            [['status_result'], 'string', 'max' => 256],
            [['indicator', 'rate'], 'string', 'max' => 45],
            [['summary_save', 'compact_save'], 'string', 'max' => 7],
            [['pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProjectSub::className(), 'targetAttribute' => ['pms_project_sub_prosub_code' => 'prosub_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'save_date' => 'Save Date',
            'phone_no' => 'Phone No',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
            'group_expenses' => 'Group Expenses',
            'group_plan' => 'Group Plan',
            'group_subsidized_strategy' => 'Group Subsidized Strategy',
            'sum_payment' => 'Sum Payment',
            'status_finance' => 'Status Finance',
            'status_pandf' => 'Status Pandf',
            'status_result' => 'Status Result',
            'round' => 'Round',
            'indicator' => 'Indicator',
            'rate' => 'Rate',
            'result_evaluate' => 'Result Evaluate',
            'status_process' => 'Status Process',
            'summary_save' => 'Summary Save',
            'compact_manager' => 'Compact Manager',
            'compact_save' => 'Compact Save',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasExecutes()
    {
        return $this->hasMany(PmsCompactHasExecute::className(), ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsExecuteExecutes()
    {
        return $this->hasMany(PmsExecute::className(), ['execute_id' => 'pms_execute_execute_id'])->viaTable('pms_compact_has_execute', ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasMethods()
    {
        return $this->hasMany(PmsCompactHasMethod::className(), ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubProsubCode()
    {
        return $this->hasOne(PmsProjectSub::className(), ['prosub_code' => 'pms_project_sub_prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasTargetgroups()
    {
        return $this->hasMany(PmsCompactHasTargetgroup::className(), ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsDocuments()
    {
        return $this->hasMany(PmsDocument::className(), ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsDocumentLinks()
    {
        return $this->hasMany(PmsDocumentLink::className(), ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsResultProblems()
    {
        return $this->hasMany(PmsResultProblem::className(), ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsResultQualities()
    {
        return $this->hasMany(PmsResultQuality::className(), ['pms_compact_has_prosub_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsResultSuggests()
    {
        return $this->hasMany(PmsResultSuggest::className(), ['pms_compact_has_prosub_id' => 'id']);
    }
}

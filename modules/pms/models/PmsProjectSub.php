<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_project_sub".
 *
 * @property string $prosub_code
 * @property string $prosub_name
 * @property int $prosub_year
 * @property string $prosub_type
 * @property string $prosub_deparment
 * @property string $prosub_principle
 * @property string $prosub_start_date
 * @property string $prosub_end_date
 * @property int $prosub_operator
 * @property int $prosub_manager
 * @property string $prosub_status_place
 * @property string $prosub_status_offer
 * @property string $prosub_status_insystem
 * @property string $pms_project_project_code
 * @property int $strategic_issues_id
 * @property int $strategic_id
 * @property int $prosub_responsible_id
 * @property string $compact_start_date
 * @property string $compact_end_date
 * @property string $compact_phone
 * @property string $compact_save
 * @property string $compact_save_date
 * @property int $compact_manager
 *
 * @property PmsCompactHasProsub[] $pmsCompactHasProsubs
 * @property PmsCostPlan[] $pmsCostPlans
 * @property PmsEffect[] $pmsEffects
 * @property PmsExecute[] $pmsExecutes
 * @property PmsGovernanceHasProjectSub[] $pmsGovernanceHasProjectSubs
 * @property PmsIndicator[] $pmsIndicators
 * @property PmsPlace[] $pmsPlaces
 * @property PmsProblem[] $pmsProblems
 * @property PmsProject $pmsProjectProjectCode
 * @property PmsProjectsubBudget[] $pmsProjectsubBudgets
 * @property PmsPurpose[] $pmsPurposes
 * @property PmsResultExpect[] $pmsResultExpects
 * @property PmsStrategicHasProjectSub[] $pmsStrategicHasProjectSubs
 */
class PmsProjectSub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pms_project_sub';
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
            [['prosub_code', 'prosub_name', 'prosub_year', 'prosub_operator', 'prosub_manager', 'pms_project_project_code', 'strategic_issues_id', 'strategic_id'], 'required'],
            [['prosub_year', 'prosub_operator', 'prosub_manager', 'strategic_issues_id', 'strategic_id', 'prosub_responsible_id', 'compact_manager'], 'integer'],
            [['prosub_principle'], 'string'],
            [['prosub_start_date', 'prosub_end_date', 'compact_start_date', 'compact_end_date', 'compact_save_date'], 'safe'],
            [['prosub_code', 'pms_project_project_code'], 'string', 'max' => 17],
            [['prosub_name', 'prosub_type', 'prosub_status_place', 'prosub_status_offer', 'prosub_status_insystem'], 'string', 'max' => 256],
            [['prosub_deparment'], 'string', 'max' => 100],
            [['compact_phone'], 'string', 'max' => 13],
            [['compact_save'], 'string', 'max' => 7],
            [['prosub_code'], 'unique'],
            [['pms_project_project_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProject::className(), 'targetAttribute' => ['pms_project_project_code' => 'project_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prosub_code' => 'รหัสโครงการย่อย',
            'prosub_name' => 'ชื่อโครงการย่อย',
            'prosub_year' => 'ปีงบประมาณ',
            'prosub_type' => 'Prosub Type',
            'prosub_deparment' => 'Prosub Deparment',
            'prosub_principle' => 'Prosub Principle',
            'prosub_start_date' => 'Prosub Start Date',
            'prosub_end_date' => 'Prosub End Date',
            'prosub_operator' => 'ผู้รับผิดชอบระดับปฏิบัติ',
            'prosub_manager' => 'ผู้รับผิดชอบระดับนโยบาย/บริหาร',
            'prosub_status_place' => 'Prosub Status Place',
            'prosub_status_offer' => 'Prosub Status Offer',
            'prosub_status_insystem' => 'Prosub Status Insystem',
            'pms_project_project_code' => 'โครงการหลัก',
            'strategic_issues_id' => 'ประเด็นยุทธศาสตร์',
            'strategic_id' => 'กลยุทธ์',
            'prosub_responsible_id' => 'Prosub Responsible ID',
            'compact_start_date' => 'Compact Start Date',
            'compact_end_date' => 'Compact End Date',
            'compact_phone' => 'Compact Phone',
            'compact_save' => 'Compact Save',
            'compact_save_date' => 'Compact Save Date',
            'compact_manager' => 'Compact Manager',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasProsubs()
    {
        return $this->hasMany(PmsCompactHasProsub::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCostPlans()
    {
        return $this->hasMany(PmsCostPlan::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsEffects()
    {
        return $this->hasMany(PmsEffect::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsExecutes()
    {
        return $this->hasMany(PmsExecute::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsGovernanceHasProjectSubs()
    {
        return $this->hasMany(PmsGovernanceHasProjectSub::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsIndicators()
    {
        return $this->hasMany(PmsIndicator::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsPlaces()
    {
        return $this->hasMany(PmsPlace::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProblems()
    {
        return $this->hasMany(PmsProblem::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectProjectCode()
    {
        return $this->hasOne(PmsProject::className(), ['project_code' => 'pms_project_project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectsubBudgets()
    {
        return $this->hasMany(PmsProjectsubBudget::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsPurposes()
    {
        return $this->hasMany(PmsPurpose::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsResultExpects()
    {
        return $this->hasMany(PmsResultExpect::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsStrategicHasProjectSubs()
    {
        return $this->hasMany(PmsStrategicHasProjectSub::className(), ['pms_project_sub_prosub_code' => 'prosub_code']);
    }
}

<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $project_id
 * @property string $project_name_thai
 * @property string $project_name_eng
 * @property string $project_start
 * @property string $project_end
 * @property string $project_duration
 * @property string $project_budget
 * @property string $repayment
 * @property string $project_url
 * @property int $sponsor_sponsor_id
 * @property int $participation_participation_project_code
 * @property int $advisor_id
 * @property int $std_id
 * @property int $person_id
 *
 * @property ProPub[] $proPubs
 * @property Participation $participationParticipationProjectCode
 * @property Sponsor $sponsorSponsor
 * @property ProjectMember[] $projectMembers
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_name_thai', 'project_name_eng'], 'required'],
            [['project_start', 'project_end'], 'safe'],
            [['sponsor_sponsor_id', 'participation_participation_project_code', 'advisor_id', 'std_id', 'person_id'], 'integer'],
            [['project_name_thai', 'project_name_eng'], 'string', 'max' => 100],
            [['project_duration', 'project_budget', 'repayment', 'project_url'], 'string', 'max' => 45],
            [['participation_participation_project_code'], 'exist', 'skipOnError' => true, 'targetClass' => Participation::className(), 'targetAttribute' => ['participation_participation_project_code' => 'participation_project_code']],
            [['sponsor_sponsor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsor::className(), 'targetAttribute' => ['sponsor_sponsor_id' => 'sponsor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'project_name_thai' => 'Project Name Thai',
            'project_name_eng' => 'Project Name Eng',
            'project_start' => 'Project Start',
            'project_end' => 'Project End',
            'project_duration' => 'Project Duration',
            'project_budget' => 'Project Budget',
            'repayment' => 'Repayment',
            'project_url' => 'Project Url',
            'sponsor_sponsor_id' => 'Sponsor Sponsor ID',
            'participation_participation_project_code' => 'Participation Participation Project Code',
            'advisor_id' => 'Advisor ID',
            'std_id' => 'Std ID',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProPubs()
    {
        return $this->hasMany(ProPub::className(), ['project_project_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipationParticipationProjectCode()
    {
        return $this->hasOne(Participation::className(), ['participation_project_code' => 'participation_participation_project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorSponsor()
    {
        return $this->hasOne(Sponsor::className(), ['sponsor_id' => 'sponsor_sponsor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMembers()
    {
        return $this->hasMany(ProjectMember::className(), ['project_project_id' => 'project_id']);
    }
}

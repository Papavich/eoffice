<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "project_order".
 *
 * @property int $project_order_id
 * @property int $project_role_project_role_id
 * @property int $project_member_pro_member_id
 * @property int $project_project_id
 * @property string $person_id
 * @property int $sponsor_sponsor_id
 * @property int $contributor_contributor_id
 * @property string $date
 *
 * @property Contributor $contributorContributor
 * @property Project $projectProject
 * @property Member $projectMemberProMember
 * @property ProjectRole $projectRoleProjectRole
 * @property Sponsor $sponsorSponsor
 */
class ProjectOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_order';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_role_project_role_id', 'project_member_pro_member_id', 'project_project_id', 'sponsor_sponsor_id', 'contributor_contributor_id'], 'integer'],
            [['date'], 'required'],
            [['date'], 'safe'],
            [['person_id'], 'string', 'max' => 45],
            [['contributor_contributor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contributor::className(), 'targetAttribute' => ['contributor_contributor_id' => 'contributor_id']],
            [['project_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_project_id' => 'project_id']],
            [['project_member_pro_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['project_member_pro_member_id' => 'member_id']],
            [['project_role_project_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectRole::className(), 'targetAttribute' => ['project_role_project_role_id' => 'project_role_id']],
            [['sponsor_sponsor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsor::className(), 'targetAttribute' => ['sponsor_sponsor_id' => 'sponsor_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_order_id' => 'Project Order ID',
            'project_role_project_role_id' => 'Project Role Project Role ID',
            'project_member_pro_member_id' => 'Project Member Pro Member ID',
            'project_project_id' => 'Project Project ID',
            'person_id' => 'Person ID',
            'sponsor_sponsor_id' => 'Sponsor Sponsor ID',
            'contributor_contributor_id' => 'Contributor Contributor ID',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContributorContributor()
    {
        return $this->hasOne(Contributor::className(), ['contributor_id' => 'contributor_contributor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMemberProMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'project_member_pro_member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRoleProjectRole()
    {
        return $this->hasOne(ProjectRole::className(), ['project_role_id' => 'project_role_project_role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorSponsor()
    {
        return $this->hasOne(Sponsor::className(), ['sponsor_id' => 'sponsor_sponsor_id']);
    }

    public function getFullName()
    {
        return $this->projectMemberProMember->member_name.'  '.$this->projectMemberProMember->member_lname;
    }
}

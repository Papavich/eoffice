<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "owner".
 *
 * @property integer $owner_id
 * @property integer $std_id
 * @property integer $STUDENTID
 * @property integer $project_member_pro_member_id
 *
 * @property Advisors[] $advisors
 * @property ArewardOrder[] $arewardOrders
 * @property ProjectMember $projectMemberProMember
 * @property PublicationOrder[] $publicationOrders
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'owner';
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
            [['std_id', 'STUDENTID', 'project_member_pro_member_id'], 'required'],
            [['std_id', 'STUDENTID', 'project_member_pro_member_id'], 'integer'],
            [['project_member_pro_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectMember::className(), 'targetAttribute' => ['project_member_pro_member_id' => 'pro_member_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'owner_id' => 'Owner ID',
            'std_id' => 'Std ID',
            'STUDENTID' => 'Studentid',
            'project_member_pro_member_id' => 'Project Member Pro Member ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvisors()
    {
        return $this->hasMany(Advisors::className(), ['owner_owner_id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArewardOrders()
    {
        return $this->hasMany(ArewardOrder::className(), ['owner_owner_id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMemberProMember()
    {
        return $this->hasOne(ProjectMember::className(), ['pro_member_id' => 'project_member_pro_member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationOrders()
    {
        return $this->hasMany(PublicationOrder::className(), ['owner_owner_id' => 'owner_id']);
    }
}

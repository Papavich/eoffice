<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "areward_order".
 *
 * @property integer $areward_order_id
 * @property string $areward_name
 * @property integer $date_areward
 * @property integer $level_level_id
 * @property string $owner_owner_id
 * @property integer $level_level_id1
 * @property integer $project_member_pro_member_id
 *
 * @property Advisors[] $advisors
 * @property Level $levelLevelId1
 * @property ProjectMember $projectMemberProMember
 */
class AwardOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areward_order';
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
            [['areward_name', 'date_areward', 'level_level_id', 'owner_owner_id'], 'required'],
            [['date_areward', 'level_level_id', 'level_level_id1', 'project_member_pro_member_id'], 'integer'],
            [['areward_name'], 'string', 'max' => 50],
            [['owner_owner_id'], 'string', 'max' => 20],
            [['level_level_id1'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_level_id1' => 'level_id']],
            [['project_member_pro_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectMember::className(), 'targetAttribute' => ['project_member_pro_member_id' => 'pro_member_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'areward_order_id' => 'Areward Order ID',
            'areward_name' => 'Areward Name',
            'date_areward' => 'Date Areward',
            'level_level_id' => 'Level Level ID',
            'owner_owner_id' => 'Owner Owner ID',
            'level_level_id1' => 'Level Level Id1',
            'project_member_pro_member_id' => 'Project Member Pro Member ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvisors()
    {
        return $this->hasMany(Advisors::className(), ['areward_order_areward_order_id' => 'areward_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevelLevelId1()
    {
        return $this->hasOne(Level::className(), ['level_id' => 'level_level_id1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMemberProMember()
    {
        return $this->hasOne(ProjectMember::className(), ['pro_member_id' => 'project_member_pro_member_id']);
    }
}

<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "req_approve_group".
 *
 * @property int $user_id
 * @property int $template_id
 * @property string $cr_date
 * @property int $cr_term
 * @property int $cr_year
 * @property string $approve_group_name
 * @property int $approve_group_queue
 * @property string $approve_group_status
 * @property string $approve_group_visible
 * @property string $approve_group_enddate
 *
 * @property ReqApproval[] $reqApprovals
 * @property ReqTracking $user
 */
class ReqApproveGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_approve_group';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_form');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year', 'approve_group_queue'], 'required'],
            [['user_id', 'template_id', 'cr_term', 'cr_year', 'approve_group_queue'], 'integer'],
            [['cr_date', 'approve_group_enddate'], 'safe'],
            [['approve_group_name'], 'string', 'max' => 150],
            [['approve_group_status', 'approve_group_visible'], 'string', 'max' => 45],
            [['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year', 'approve_group_queue'], 'unique', 'targetAttribute' => ['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year', 'approve_group_queue']],
            [['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year'], 'exist', 'skipOnError' => true, 'targetClass' => ReqTracking::className(), 'targetAttribute' => ['user_id' => 'user_id', 'template_id' => 'template_id', 'cr_date' => 'cr_date', 'cr_term' => 'cr_term', 'cr_year' => 'cr_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'template_id' => 'Template ID',
            'cr_date' => 'Cr Date',
            'cr_term' => 'Cr Term',
            'cr_year' => 'Cr Year',
            'approve_group_name' => 'Approve Group Name',
            'approve_group_queue' => 'Approve Group Queue',
            'approve_group_status' => 'Approve Group Status',
            'approve_group_visible' => 'Approve Group Visible',
            'approve_group_enddate' => 'Approve Group Enddate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqApprovals()
    {
        return $this->hasMany(ReqApproval::className(), ['user_id' => 'user_id', 'template_id' => 'template_id', 'cr_date' => 'cr_date', 'cr_term' => 'cr_term', 'cr_year' => 'cr_year', 'approve_group_queue' => 'approve_group_queue']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ReqTracking::className(), ['user_id' => 'user_id', 'template_id' => 'template_id', 'cr_date' => 'cr_date', 'cr_term' => 'cr_term', 'cr_year' => 'cr_year']);
    }
}

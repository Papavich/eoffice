<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_approve".
 *
 * @property integer $approve_running
 * @property integer $approve_id
 * @property string $approve_name
 * @property string $approve_status
 * @property string $approve_comment
 * @property string $approve_receivedate
 * @property string $approve_date
 * @property integer $req_flow_flow_id
 * @property integer $approve_visible
 * @property integer $approve_queue
 *
 * @property ReqFlow $reqFlowFlow
 */
class ReqApprove extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_approve';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['approve_id', 'approve_queue'], 'required'],
            [['approve_id', 'req_flow_flow_id', 'approve_visible', 'approve_queue'], 'integer'],
            [['approve_receivedate', 'approve_date'], 'safe'],
            [['approve_name'], 'string', 'max' => 150],
            [['approve_status'], 'string', 'max' => 100],
            [['approve_comment'], 'string', 'max' => 500],
            [['req_flow_flow_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqFlow::className(), 'targetAttribute' => ['req_flow_flow_id' => 'flow_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'approve_running' => 'Approve Running',
            'approve_id' => 'Approve ID',
            'approve_name' => 'Approve Name',
            'approve_status' => 'Approve Status',
            'approve_comment' => 'Approve Comment',
            'approve_receivedate' => 'Approve Receivedate',
            'approve_date' => 'Approve Date',
            'req_flow_flow_id' => 'Req Flow Flow ID',
            'approve_visible' => 'Approve Visible',
            'approve_queue' => 'Approve Queue',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqFlowFlow()
    {
        return $this->hasOne(ReqFlow::className(), ['flow_id' => 'req_flow_flow_id']);
    }
}

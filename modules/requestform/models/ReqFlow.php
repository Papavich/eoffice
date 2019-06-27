<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_flow".
 *
 * @property integer $flow_id
 * @property string $flow_status
 * @property string $flow_startdate
 * @property string $flow_enddate
 * @property integer $req_form_form_id
 *
 * @property ReqApprove[] $reqApproves
 * @property ReqForm $reqFormForm
 */
class ReqFlow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_flow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flow_startdate', 'flow_enddate'], 'safe'],
            [['req_form_form_id'], 'required'],
            [['req_form_form_id'], 'integer'],
            [['flow_status'], 'string', 'max' => 100],
            [['req_form_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqForm::className(), 'targetAttribute' => ['req_form_form_id' => 'form_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'flow_id' => 'Flow ID',
            'flow_status' => 'Flow Status',
            'flow_startdate' => 'Flow Startdate',
            'flow_enddate' => 'Flow Enddate',
            'req_form_form_id' => 'Req Form Form ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqApproves()
    {
        return $this->hasMany(ReqApprove::className(), ['req_flow_flow_id' => 'flow_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqFormForm()
    {
        return $this->hasOne(ReqForm::className(), ['form_id' => 'req_form_form_id']);
    }
}

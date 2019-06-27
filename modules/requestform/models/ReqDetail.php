<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_detail".
 *
 * @property integer $crterm
 * @property integer $cryear
 * @property integer $req_template_template_id
 * @property integer $req_form_form_id
 *
 * @property ReqForm $reqFormForm
 * @property ReqTemplate $reqTemplateTemplate
 */
class ReqDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['crterm', 'cryear', 'req_template_template_id', 'req_form_form_id'], 'required'],
            [['crterm', 'cryear', 'req_template_template_id', 'req_form_form_id'], 'integer'],
            [['req_form_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqForm::className(), 'targetAttribute' => ['req_form_form_id' => 'form_id']],
            [['req_template_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqTemplate::className(), 'targetAttribute' => ['req_template_template_id' => 'template_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'crterm' => 'Crterm',
            'cryear' => 'Cryear',
            'req_template_template_id' => 'Req Template Template ID',
            'req_form_form_id' => 'Req Form Form ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqFormForm()
    {
        return $this->hasOne(ReqForm::className(), ['form_id' => 'req_form_form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqTemplateTemplate()
    {
        return $this->hasOne(ReqTemplate::className(), ['template_id' => 'req_template_template_id']);
    }
}

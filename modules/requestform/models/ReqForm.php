<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_form".
 *
 * @property integer $form_id
 * @property string $form_value
 * @property string $form_layout
 * @property integer $user_id
 * @property string $req_formcol
 * @property string $crdate
 * @property integer $cryear
 * @property integer $crterm
 * @property integer $req_template_template_id
 *
 * @property ReqFlow[] $reqFlows
 * @property ReqTemplate $reqTemplateTemplate
 * @property User $user
 */
class ReqForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_value', 'user_id', 'req_template_template_id'], 'required'],
            [['form_value', 'form_layout'], 'string'],
            [['user_id', 'cryear', 'crterm', 'req_template_template_id'], 'integer'],
            [['crdate'], 'safe'],
            [['req_formcol'], 'string', 'max' => 45],
            [['req_template_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqTemplate::className(), 'targetAttribute' => ['req_template_template_id' => 'template_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'form_id' => 'Form ID',
            'form_value' => 'Form Value',
            'form_layout' => 'Form Layout',
            'user_id' => 'User ID',
            'req_formcol' => 'Req Formcol',
            'crdate' => 'Crdate',
            'cryear' => 'Cryear',
            'crterm' => 'Crterm',
            'req_template_template_id' => 'Req Template Template ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqFlows()
    {
        return $this->hasOne(ReqFlow::className(), ['req_form_form_id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqTemplateTemplate()
    {
        return $this->hasOne(ReqTemplate::className(), ['template_id' => 'req_template_template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

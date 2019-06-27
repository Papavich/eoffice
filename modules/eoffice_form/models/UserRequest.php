<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "user_request".
 *
 * @property int $user_id
 * @property int $template_id
 * @property string $cr_date
 * @property int $cr_term
 * @property int $cr_year
 * @property string $req_json
 * @property string $req_doc
 *
 * @property ReqStatus $reqStatus
 * @property ReqTemplate $template
 */
class UserRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_request';
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
            [['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year'], 'required'],
            [['user_id', 'template_id', 'cr_term', 'cr_year'], 'integer'],
            [['cr_date'], 'safe'],
            [['req_json', 'req_doc'], 'string'],
            [['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year'], 'unique', 'targetAttribute' => ['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year']],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqTemplate::className(), 'targetAttribute' => ['template_id' => 'template_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'รหัสผู้ใช้งาน',
            'template_id' => 'แบบฟอร์มคำร้อง',
            'cr_date' => 'วันที่สร้าง',
            'cr_term' => 'เทอม',
            'cr_year' => 'ปีการศึกษา',
            'req_json' => 'Req Json',
            'req_doc' => 'Req Doc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqStatus()
    {
        return $this->hasOne(ReqStatus::className(), ['user_id' => 'user_id', 'template_id' => 'template_id', 'cr_date' => 'cr_date', 'cr_term' => 'cr_term', 'cr_year' => 'cr_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(ReqTemplate::className(), ['template_id' => 'template_id']);
    }
}

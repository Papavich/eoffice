<?php

namespace app\modules\eoffice_form\models;

use Yii;

/**
 * This is the model class for table "req_tracking".
 *
 * @property int $user_id
 * @property int $template_id
 * @property string $cr_date
 * @property int $cr_term
 * @property int $cr_year
 * @property string $req_status
 * @property string $req_enddate
 *
 * @property ReqApproveGroup[] $reqApproveGroups
 * @property UserRequest $user
 */
class ReqTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_tracking';
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
            [['cr_date', 'req_enddate'], 'safe'],
            [['req_status'], 'string', 'max' => 45],
            [['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year'], 'unique', 'targetAttribute' => ['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year']],
            [['user_id', 'template_id', 'cr_date', 'cr_term', 'cr_year'], 'exist', 'skipOnError' => true, 'targetClass' => UserRequest::className(), 'targetAttribute' => ['user_id' => 'user_id', 'template_id' => 'template_id', 'cr_date' => 'cr_date', 'cr_term' => 'cr_term', 'cr_year' => 'cr_year']],
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
            'cr_date' => 'วันที่สร้าง',
            'cr_term' => 'เทอม',
            'cr_year' => 'ปีการศึกษา',
            'req_status' => 'สถานะ',
            'req_enddate' => 'วันที่สิ้นสุด',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqApproveGroups()
    {
        return $this->hasMany(ReqApproveGroup::className(), ['user_id' => 'user_id', 'template_id' => 'template_id', 'cr_date' => 'cr_date', 'cr_term' => 'cr_term', 'cr_year' => 'cr_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserRequest::className(), ['user_id' => 'user_id', 'template_id' => 'template_id', 'cr_date' => 'cr_date', 'cr_term' => 'cr_term', 'cr_year' => 'cr_year']);
    }

    public function getUsername()
    {
        return $this->hasOne(ViewStudentJoinUser::className(), ['id' => 'user_id']);
    }
}

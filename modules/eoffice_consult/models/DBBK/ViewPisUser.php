<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "view_pis_user".
 *
 * @property int $consult_user_id
 * @property string $consult_user_fname
 * @property string $consult_user_lname
 * @property int $consult_user_tel
 * @property string $consult_user_email
 * @property string $consult__user_password
 *
 * @property ConsultChatDetail[] $consultChatDetails
 * @property ConsultPost[] $consultPosts
 * @property ConsultTopicOwner[] $consultTopicOwners
 */
class ViewPisUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_pis_user';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_consult');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_user_id', 'consult_user_fname', 'consult_user_lname', 'consult_user_tel', 'consult_user_email', 'consult__user_password'], 'required'],
            [['consult_user_id', 'consult_user_tel'], 'integer'],
            [['consult_user_fname', 'consult_user_lname', 'consult_user_email'], 'string', 'max' => 45],
            [['consult__user_password'], 'string', 'max' => 20],
            [['consult_user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_user_id' => 'Consult User ID',
            'consult_user_fname' => 'Consult User Fname',
            'consult_user_lname' => 'Consult User Lname',
            'consult_user_tel' => 'Consult User Tel',
            'consult_user_email' => 'Consult User Email',
            'consult__user_password' => 'Consult  User Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultChatDetails()
    {
        return $this->hasMany(ConsultChatDetail::className(), ['consult_user_id' => 'consult_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPosts()
    {
        return $this->hasMany(ConsultPost::className(), ['consult_user_id' => 'consult_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultTopicOwners()
    {
        return $this->hasMany(ConsultTopicOwner::className(), ['consult_user_id' => 'consult_user_id']);
    }
}

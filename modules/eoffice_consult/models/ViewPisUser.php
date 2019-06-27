<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "view_pis_user".
 *
 * @property int $user_id
 * @property string $user_fname
 * @property string $user_lname
 * @property int $user_tel
 * @property string $user_email
 * @property string $user_tpye
 *
 * @property ConsultFaq[] $consultFaqs
 * @property ConsultPost[] $consultPosts
 * @property ConsultUserRoom[] $consultUserRooms
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
            [['user_id', 'user_fname', 'user_lname', 'user_tel', 'user_email', 'user_tpye'], 'required'],
            [['user_id', 'user_tel'], 'integer'],
            [['user_fname', 'user_lname', 'user_email'], 'string', 'max' => 45],
            [['user_tpye'], 'string', 'max' => 20],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_fname' => 'User Fname',
            'user_lname' => 'User Lname',
            'user_tel' => 'User Tel',
            'user_email' => 'User Email',
            'user_tpye' => 'User Tpye',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultFaqs()
    {
        return $this->hasMany(ConsultFaq::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPosts()
    {
        return $this->hasMany(ConsultPost::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultUserRooms()
    {
        return $this->hasMany(ConsultUserRoom::className(), ['user_id' => 'user_id']);
    }
}

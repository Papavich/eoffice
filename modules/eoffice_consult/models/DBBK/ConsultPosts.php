<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_post".
 *
 * @property int $consult_post_id
 * @property string $consult_post_ark_detail
 * @property string $consult_post_ark_date
 * @property int $consult_user_id
 * @property int $consult_status_id
 * @property int $consult_faq_id
 * @property string $consult_Answer
 *
 * @property ConsultAnswer[] $consultAnswers
 * @property ConsultFaq $consultFaq
 * @property ConsultStatus $consultStatus
 * @property ViewPisUser $consultUser
 * @property ConsultSatis[] $consultSatis
 * @property ConsultTopicOwner[] $consultTopicOwners
 */
class ConsultPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_post';
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
            [['consult_post_ark_date'], 'safe'],
            [['consult_user_id', 'consult_status_id', 'consult_faq_id'], 'integer'],
            [['consult_post_ark_detail', 'consult_Answer'], 'string', 'max' => 100],
            [['consult_faq_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultFaq::className(), 'targetAttribute' => ['consult_faq_id' => 'consult_faq_id']],
            [['consult_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultStatus::className(), 'targetAttribute' => ['consult_status_id' => 'consult_status_id']],
            [['consult_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewPisUser::className(), 'targetAttribute' => ['consult_user_id' => 'consult_user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_post_id' => 'รหัสคำถาม',
            'consult_post_ark_detail' => 'คำถาม',
            'consult_post_ark_date' => 'วันที่ถาม',
            'consult_user_id' => 'ผู้สอบถาม',
            'consult_status_id' => 'สถานะ',
            'consult_faq_id' => 'FAQ',
            'consult_Answer' => 'คำตอบ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultAnswers()
    {
        return $this->hasMany(ConsultAnswer::className(), ['consult_post_id' => 'consult_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultFaq()
    {
        return $this->hasOne(ConsultFaq::className(), ['consult_faq_id' => 'consult_faq_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultStatus()
    {
        return $this->hasOne(ConsultStatus::className(), ['consult_status_id' => 'consult_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultUser()
    {
        return $this->hasOne(ViewPisUser::className(), ['consult_user_id' => 'consult_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultSatis()
    {
        return $this->hasMany(ConsultSatis::className(), ['consult_post_id' => 'consult_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultTopicOwners()
    {
        return $this->hasMany(ConsultTopicOwner::className(), ['consult_post_id' => 'consult_post_id']);
    }
}

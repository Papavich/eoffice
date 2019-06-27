<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_topic_owner".
 *
 * @property int $consult_topic_owner_id
 * @property string $consult_topic_owner_name
 * @property int $consult_post_id
 * @property int $consult_user_id
 * @property int $consult_topic_id
 *
 * @property ConsultPost $consultPost
 * @property ConsultTopic $consultTopic
 * @property ViewPisUser $consultUser
 */
class ConsultTopicOwner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_topic_owner';
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
            [['consult_topic_owner_id', 'consult_topic_owner_name', 'consult_post_id', 'consult_user_id', 'consult_topic_id'], 'required'],
            [['consult_topic_owner_id', 'consult_post_id', 'consult_user_id', 'consult_topic_id'], 'integer'],
            [['consult_topic_owner_name'], 'string', 'max' => 45],
            [['consult_topic_owner_id'], 'unique'],
            [['consult_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultPost::className(), 'targetAttribute' => ['consult_post_id' => 'consult_post_id']],
            [['consult_topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultTopic::className(), 'targetAttribute' => ['consult_topic_id' => 'consult_topic_id']],
            [['consult_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewPisUser::className(), 'targetAttribute' => ['consult_user_id' => 'consult_user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_topic_owner_id' => 'Consult Topic Owner ID',
            'consult_topic_owner_name' => 'Consult Topic Owner Name',
            'consult_post_id' => 'Consult Post ID',
            'consult_user_id' => 'Consult User ID',
            'consult_topic_id' => 'Consult Topic ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPost()
    {
        return $this->hasOne(ConsultPost::className(), ['consult_post_id' => 'consult_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultTopic()
    {
        return $this->hasOne(ConsultTopic::className(), ['consult_topic_id' => 'consult_topic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultUser()
    {
        return $this->hasOne(ViewPisUser::className(), ['consult_user_id' => 'consult_user_id']);
    }
}

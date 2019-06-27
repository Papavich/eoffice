<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_topic_owner".
 *
 * @property int $topic_owner_id
 * @property string $topic_owner_name
 * @property int $respon_id
 * @property int $topic_id
 *
 * @property ConsultPost[] $consultPosts
 * @property ConsultTopic $topic
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
            [['respon_id', 'topic_id'], 'required'],
            [['respon_id', 'topic_id'], 'integer'],
            [['topic_owner_name'], 'string', 'max' => 45],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultTopic::className(), 'targetAttribute' => ['topic_id' => 'topic_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic_owner_id' => 'Topic Owner ID',
            'topic_owner_name' => 'หัวข้อปัญหา',
            'respon_id' => 'ผู้รับผิดชอบ',
            'topic_id' => 'Topic ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPosts()
    {
        return $this->hasMany(ConsultPost::className(), ['topic_owner_id' => 'topic_owner_id', 'respon_id' => 'respon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(ConsultTopic::className(), ['topic_id' => 'topic_id']);
    }
}

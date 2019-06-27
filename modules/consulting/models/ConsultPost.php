<?php

namespace app\modules\consulting\models;

use Yii;

/**
 * This is the model class for table "consult_post".
 *
 * @property int $post_id
 * @property string $post_ark_detail
 * @property string $post_ark_date
 * @property int $user_id
 * @property int $status_id
 * @property string $post_ans
 * @property int $topic_owner_id
 * @property int $respon_id
 *
 * @property ConsultStatus $status
 * @property ViewPisUser $user
 * @property ConsultTopicOwner $topicOwner
 * @property ConsultSatis[] $consultSatis
 */
class ConsultPost extends \yii\db\ActiveRecord
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
            [['post_ark_detail', 'topic_owner_id', 'respon_id'], 'required'],
            [['post_ark_date'], 'safe'],
            [['user_id', 'status_id', 'topic_owner_id', 'respon_id'], 'integer'],
            [['post_ark_detail', 'post_ans'], 'string', 'max' => 100],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultStatus::className(), 'targetAttribute' => ['status_id' => 'status_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewPisUser::className(), 'targetAttribute' => ['user_id' => 'user_id']],
            [['topic_owner_id', 'respon_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultTopicOwner::className(), 'targetAttribute' => ['topic_owner_id' => 'topic_owner_id', 'respon_id' => 'respon_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'ID',
            'post_ark_detail' => 'รายละเอียดคำถาม',
            'post_ark_date' => 'วันที่ถาม',
            'user_id' => 'ผู้ถาม',
            'status_id' => 'สถานะ',
            'post_ans' => 'คำตอบ',
            'topic_owner_id' => 'หัวข้อปัญหา',
            'respon_id' => 'ผู้รับผิดชอบ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ConsultStatus::className(), ['status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ViewPisUser::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopicOwner()
    {
        return $this->hasOne(ConsultTopicOwner::className(), ['topic_owner_id' => 'topic_owner_id', 'respon_id' => 'respon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultSatis()
    {
        return $this->hasMany(ConsultSatis::className(), ['post_id' => 'post_id']);
    }
}

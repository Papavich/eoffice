<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_post".
 *
 * @property int $post_id
 * @property string $post_ark_detail
 * @property string $post_ark_date
 * @property int $status_id
 * @property string $post_ans
 * @property string $post_ans_date
 * @property int $topic_owner_id
 * @property int $respon_id
 * @property int $user_id
 *
 * @property ConsultStatus $status
 */
class ConsultPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_ark_detail', 'topic_owner_id', 'respon_id'], 'required'],
            [['post_ark_date', 'post_ans_date'], 'safe'],
            [['status_id', 'topic_owner_id', 'respon_id', 'user_id'], 'integer'],
            // [['post_ark_detail', 'post_ans'], 'string', 'max' => 100],

            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultStatus::className(), 'targetAttribute' => ['status_id' => 'status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'ID',
            'post_ark_detail' => 'รายละเอียดคำถาม',
            'post_ark_date' => 'วันที่ถาม',
            'status_id' => 'สถานะ',
            'post_ans' => 'คำตอบ',
            'post_ans_date' => 'วันที่ตอบ',
            'topic_owner_id' => 'หัวข้อปัญหา',
            'respon_id' => 'ผู้รับผิดชอบ',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ConsultStatus::className(), ['status_id' => 'status_id']);
    }

    public function getTopicOwner()
    {
        return $this->hasOne(ConsultTopicOwner::className(), ['topic_owner_id' => 'topic_owner_id']);
    }

    public function getUsername()
    {

        return $this->hasOne(EofficeCentralViewPisPerson::className(), ['id' => 'user_id']);
    }


    public function getStaff()
    {
        return $this->hasOne(EofficeCentralViewPisPerson::className(), ['person_card_id' => 'respon_id']);
    }

    public function getStudent()
    {
        return $this->hasOne(ViewStudentJoinUser::className(), ['id' => 'user_id']);
    }
}

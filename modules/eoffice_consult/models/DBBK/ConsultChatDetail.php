<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_chat_detail".
 *
 * @property string $consult_chat_detail_id
 * @property string $consult_chat_detail_name
 * @property string $consult_chat_detail_message
 * @property string $consult_chat_detail_message_date
 * @property int $consult_chat_room_id
 *
 * @property ConsultChatRoom $consultChatRoom
 */
class ConsultChatDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_chat_detail';
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
            [['consult_chat_detail_id', 'consult_chat_detail_name', 'consult_chat_detail_message', 'consult_chat_room_id'], 'required'],
            [['consult_chat_detail_message'], 'string'],
            [['consult_chat_room_id'], 'integer'],
            [['consult_chat_detail_id'], 'string', 'max' => 50],
            [['consult_chat_detail_name'], 'string', 'max' => 45],
            [['consult_chat_detail_message_date'], 'string', 'max' => 60],
            [['consult_chat_detail_id'], 'unique'],
            [['consult_chat_room_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultChatRoom::className(), 'targetAttribute' => ['consult_chat_room_id' => 'consult_chat_room_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_chat_detail_id' => 'Consult Chat Detail ID',
            'consult_chat_detail_name' => 'Consult Chat Detail Name',
            'consult_chat_detail_message' => 'Consult Chat Detail Message',
            'consult_chat_detail_message_date' => 'Consult Chat Detail Message Date',
            'consult_chat_room_id' => 'Consult Chat Room ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultChatRoom()
    {
        return $this->hasOne(ConsultChatRoom::className(), ['consult_chat_room_id' => 'consult_chat_room_id']);
    }
}

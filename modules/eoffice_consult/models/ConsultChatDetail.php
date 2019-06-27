<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_chat_detail".
 *
 * @property int $chat_detail_id
 * @property string $chat_detail_name
 * @property string $chat_detail_message
 * @property string $chat_detail_message_date
 * @property int $chat_room_id
 *
 * @property ConsultChatRoom $chatRoom
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
            [['chat_detail_name', 'chat_detail_message', 'chat_room_id'], 'required'],
            [['chat_detail_message'], 'string'],
            [['chat_room_id'], 'integer'],
            [['chat_detail_name'], 'string', 'max' => 45],
            [['chat_detail_message_date'], 'string', 'max' => 60],
            [['chat_room_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultChatRoom::className(), 'targetAttribute' => ['chat_room_id' => 'chat_room_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chat_detail_id' => 'Chat Detail ID',
            'chat_detail_name' => 'Chat Detail Name',
            'chat_detail_message' => 'Chat Detail Message',
            'chat_detail_message_date' => 'Chat Detail Message Date',
            'chat_room_id' => 'Chat Room ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatRoom()
    {
        return $this->hasOne(ConsultChatRoom::className(), ['chat_room_id' => 'chat_room_id']);
    }
}

<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_chat_room".
 *
 * @property int $chat_room_id
 * @property string $chat_room_date
 *
 * @property ConsultChatDetail[] $consultChatDetails
 * @property ConsultUserRoom[] $consultUserRooms
 */
class ConsultChatRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_chat_room';
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
            [['chat_room_id'], 'required'],
            [['chat_room_id'], 'integer'],
            [['chat_room_date'], 'safe'],
            [['chat_room_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chat_room_id' => 'Chat Room ID',
            'chat_room_date' => 'Chat Room Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultChatDetails()
    {
        return $this->hasMany(ConsultChatDetail::className(), ['chat_room_id' => 'chat_room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultUserRooms()
    {
        return $this->hasMany(ConsultUserRoom::className(), ['chat_room_id' => 'chat_room_id']);
    }
}

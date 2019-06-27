<?php

namespace app\modules\pfc\models;

use Yii;

/**
 * This is the model class for table "chat_room".
 *
 * @property string $chat_room_id
 * @property string $chat_date
 * @property int $project_id
 *
 * @property ChatDetail[] $chatDetails
 */
class ChatRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_room';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfc');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_room_id', 'chat_date', 'project_id'], 'required'],
            [['chat_date'], 'safe'],
            [['project_id'], 'integer'],
            [['chat_room_id'], 'string', 'max' => 30],
            [['chat_room_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chat_room_id' => 'Chat Room ID',
            'chat_date' => 'Chat Date',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatDetails()
    {
        return $this->hasMany(ChatDetail::className(), ['chat_room_id' => 'chat_room_id']);
    }
}

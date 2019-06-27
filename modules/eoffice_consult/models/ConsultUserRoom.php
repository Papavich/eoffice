<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_user_room".
 *
 * @property int $consult_user_id
 * @property int $consult_chat_room_id
 *
 * @property ConsultChatRoom $consultChatRoom
 * @property ViewPisUser $consultUser
 */
class ConsultUserRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_user_room';
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
            [['consult_user_id', 'consult_chat_room_id'], 'required'],
            [['consult_user_id', 'consult_chat_room_id'], 'integer'],
            [['consult_chat_room_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultChatRoom::className(), 'targetAttribute' => ['consult_chat_room_id' => 'consult_chat_room_id']],
            [['consult_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewPisUser::className(), 'targetAttribute' => ['consult_user_id' => 'consult_user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_user_id' => 'Consult User ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultUser()
    {
        return $this->hasOne(ViewPisUser::className(), ['consult_user_id' => 'consult_user_id']);
    }
}

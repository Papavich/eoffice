<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_chat_room".
 *
 * @property int $consult_chat_room_id
 * @property string $consult_chat_room_date
 * @property int $consult_user_id
 *
 * @property ConsultChatDetail[] $consultChatDetails
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
            [['consult_chat_room_id'], 'required'],
            [['consult_chat_room_id', 'consult_user_id'], 'integer'],
            [['consult_chat_room_date'], 'safe'],
            [['consult_chat_room_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_chat_room_id' => 'Consult Chat Room ID',
            'consult_chat_room_date' => 'Consult Chat Room Date',
            'consult_user_id' => 'Consult User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultChatDetails()
    {
        return $this->hasMany(ConsultChatDetail::className(), ['consult_chat_room_id' => 'consult_chat_room_id']);
    }
}

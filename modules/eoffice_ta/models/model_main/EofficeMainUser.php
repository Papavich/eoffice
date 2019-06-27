<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_main.user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property int $confirmed_at
 * @property string $unconfirmed_email
 * @property int $blocked_at
 * @property string $registration_ip
 * @property int $created_at
 * @property int $updated_at
 * @property int $flags
 * @property int $last_login_at
 * @property int $status
 * @property string $password_reset_token
 * @property string $type
 * @property int $person_id
 */
class EofficeMainUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_main5.user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at', 'type'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'status', 'person_id'], 'integer'],
            [['username', 'email', 'unconfirmed_email', 'password_reset_token'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['type'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'last_login_at' => 'Last Login At',
            'status' => 'Status',
            'password_reset_token' => 'Password Reset Token',
            'type' => 'Type',
            'person_id' => 'Person ID',
        ];
    }
}

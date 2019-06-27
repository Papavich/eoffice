<?php

namespace app\modules\repairsystem\models;

use Yii;

/**
 * This is the model class for table "user2".
 *
 * @property integer $user_id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $tel
 *
 * @property RepairDescription[] $repairDescriptions
 */
class User2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'tel'], 'required'],
            [['fname', 'lname'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'email' => 'อีเมลล์',
            'tel' => 'เบอร์โทรศัพท์',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairDescriptions()
    {
        return $this->hasMany(RepairDescription::className(), ['user_id' => 'user_id']);
    }
}

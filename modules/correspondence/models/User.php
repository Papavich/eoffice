<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $prefix_th
 * @property string $lname
 * @property string $fname
 * @property string $person_position
 * @property int $person_type
 * @property string $username
 * @property string $email
 * @property int $group_id
 * @property string $personcode
 *
 * @property CmsDeleteRoll[] $cmsDeleteRolls
 * @property CmsDocDept[] $cmsDocDepts
 * @property CmsDocument[] $cmsDocuments
 * @property CmsInbox[] $cmsInboxes
 * @property CmsInbox[] $cmsInboxes0
 * @property CmsInboxLabel[] $cmsInboxLabels
 * @property CmsLog[] $cmsLogs
 * @property CmsLog[] $cmsLogs0
 * @property CmsOutbox[] $cmsOutboxes
 * @property CmsGroup $group
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_type', 'group_id'], 'integer'],
            [['username'], 'required'],
            [['prefix_th', 'personcode'], 'string', 'max' => 45],
            [['lname', 'fname'], 'string', 'max' => 50],
            [['person_position'], 'string', 'max' => 100],
            [['username', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsGroup::className(), 'targetAttribute' => ['group_id' => 'group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prefix_th' => 'Prefix Th',
            'lname' => 'Lname',
            'fname' => 'Fname',
            'person_position' => 'Person Position',
            'person_type' => 'Person Type',
            'username' => 'Username',
            'email' => 'Email',
            'group_id' => 'Group ID',
            'personcode' => 'Personcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDeleteRolls()
    {
        return $this->hasMany(CmsDeleteRoll::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocDepts()
    {
        return $this->hasMany(CmsDocDept::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocuments()
    {
        return $this->hasMany(CmsDocument::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsInboxes()
    {
        return $this->hasMany(CmsInbox::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsInboxes0()
    {
        return $this->hasMany(CmsInbox::className(), ['approve_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsInboxLabels()
    {
        return $this->hasMany(CmsInboxLabel::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsLogs()
    {
        return $this->hasMany(CmsLog::className(), ['crby_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsLogs0()
    {
        return $this->hasMany(CmsLog::className(), ['udby_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsOutboxes()
    {
        return $this->hasMany(CmsOutbox::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CmsGroup::className(), ['group_id' => 'group_id']);
    }
}

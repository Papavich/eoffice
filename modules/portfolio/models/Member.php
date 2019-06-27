<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $member_id
 * @property string $member_name
 * @property string $member_lname
 * @property int $person_id
 *
 * @property Areward[] $arewards
 * @property ProjectOrder[] $projectOrders
 * @property PublicationOrder[] $publicationOrders
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'integer'],
            [['member_name'], 'string', 'max' => 255],
            [['member_lname'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => 'Member ID',
            'member_name' => 'Member Name',
            'member_lname' => 'Member Lname',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArewards()
    {
        return $this->hasMany(Areward::className(), ['member_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectOrders()
    {
        return $this->hasMany(ProjectOrder::className(), ['project_member_pro_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationOrders()
    {
        return $this->hasMany(PublicationOrder::className(), ['project_member_pro_member_id' => 'member_id']);
    }

    public function getMember()
    {
        return $this->member_name.'   '.$this->member_lname;
    }
}

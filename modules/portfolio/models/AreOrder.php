<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "are_order".
 *
 * @property int $are_order_id
 * @property int $member_member_id
 * @property int $areward_areward_id
 *
 * @property Areward $arewardAreward
 * @property Member $memberMember
 */
class AreOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'are_order';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['are_order_id'], 'required'],
            [['are_order_id', 'member_member_id', 'areward_areward_id'], 'integer'],
            [['are_order_id'], 'unique'],
            [['areward_areward_id'], 'exist', 'skipOnError' => true, 'targetClass' => Areward::className(), 'targetAttribute' => ['areward_areward_id' => 'areward_id']],
            [['member_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_member_id' => 'member_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'are_order_id' => 'Are Order ID',
            'member_member_id' => 'Member Member ID',
            'areward_areward_id' => 'Areward Areward ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArewardAreward()
    {
        return $this->hasOne(Areward::className(), ['areward_id' => 'areward_areward_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_member_id']);
    }
}

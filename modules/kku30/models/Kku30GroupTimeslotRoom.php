<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_group_timeslot_room".
 *
 * @property string $group_no
 * @property string $timeslot_id
 * @property int $timeslot_lenght
 * @property int $room_id
 * @property int $time_insert
 *
 * @property Kku30Group $groupNo
 * @property Kku30Timeslot $timeslot
 */
class Kku30GroupTimeslotRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kku30_group_timeslot_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_no', 'timeslot_id', 'timeslot_lenght'], 'required'],
            [['timeslot_lenght', 'room_id', 'time_insert'], 'integer'],
            [['group_no'], 'string', 'max' => 25],
            [['timeslot_id'], 'string', 'max' => 10],
            [['group_no', 'timeslot_id'], 'unique', 'targetAttribute' => ['group_no', 'timeslot_id']],
            [['group_no'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Group::className(), 'targetAttribute' => ['group_no' => 'group_no']],
            [['timeslot_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Timeslot::className(), 'targetAttribute' => ['timeslot_id' => 'timeslot_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function attributeLabels()
    {
        return [
            'group_no' => 'Group No',
            'timeslot_id' => 'Timeslot ID',
            'timeslot_lenght' => 'Timeslot Lenght',
            'room_id' => 'Room ID',
            'time_insert' => 'Time Insert',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupNo()
    {
        return $this->hasOne(Kku30Group::className(), ['group_no' => 'group_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeslot()
    {
        return $this->hasOne(Kku30Timeslot::className(), ['timeslot_id' => 'timeslot_id']);
    }
}

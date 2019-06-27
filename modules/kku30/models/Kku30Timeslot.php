<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_timeslot".
 *
 * @property string $timeslot_id
 * @property string $timeslot_day
 * @property string $timeslot_starttime
 * @property string $timeslot_endtime
 *
 * @property Kku30GroupTimeslotRoom[] $kku30GroupTimeslotRooms
 * @property Kku30TimeslotCount[] $kku30TimeslotCounts
 */
class Kku30Timeslot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_timeslot';
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['timeslot_id', 'timeslot_day', 'timeslot_starttime', 'timeslot_endtime'], 'required'],
            [['timeslot_id'], 'string', 'max' => 10],
            [['timeslot_day', 'timeslot_starttime', 'timeslot_endtime'], 'string', 'max' => 45],
            [['timeslot_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'timeslot_id' => 'Timeslot ID',
            'timeslot_day' => 'Timeslot Day',
            'timeslot_starttime' => 'Timeslot Starttime',
            'timeslot_endtime' => 'Timeslot Endtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30GroupTimeslotRooms()
    {
        return $this->hasMany(Kku30GroupTimeslotRoom::className(), ['timeslot_id' => 'timeslot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30TimeslotCounts()
    {
        return $this->hasMany(Kku30TimeslotCount::className(), ['timeslot_id' => 'timeslot_id']);
    }
}

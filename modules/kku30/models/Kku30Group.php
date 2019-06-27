<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_group".
 *
 * @property string $group_no
 * @property int $group_amount
 * @property int $group_type
 * @property int $group_priority
 * @property int $group_length
 * @property int $group_room_condition
 *
 * @property Kku30GroupSection[] $kku30GroupSections
 * @property Kku30Section[] $sectionNos
 * @property Kku30GroupTimeslotRoom[] $kku30GroupTimeslotRooms
 * @property Kku30Timeslot[] $timeslots
 */
class Kku30Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kku30_group';
    }

    /**
     * {@inheritdoc}
     */

    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['group_no'], 'required'],
            [['group_amount', 'group_type', 'group_priority', 'group_length', 'group_room_condition'], 'integer'],
            [['group_no'], 'string', 'max' => 25],
            [['group_no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'group_no' => 'Group No',
            'group_amount' => 'Group Amount',
            'group_type' => 'Group Type',
            'group_priority' => 'Group Priority',
            'group_length' => 'Group Length',
            'group_room_condition' => 'Group Room Condition',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30GroupSections()
    {
        return $this->hasMany(Kku30GroupSection::className(), ['group_no' => 'group_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNos()
    {
        return $this->hasMany(Kku30Section::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year'])->viaTable('kku30_group_section', ['group_no' => 'group_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30GroupTimeslotRooms()
    {
        return $this->hasMany(Kku30GroupTimeslotRoom::className(), ['group_no' => 'group_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeslots()
    {
        return $this->hasMany(Kku30Timeslot::className(), ['timeslot_id' => 'timeslot_id'])->viaTable('kku30_group_timeslot_room', ['group_no' => 'group_no']);
    }
}

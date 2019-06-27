<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "exam_room".
 *
 * @property string $rooms_id
 * @property string $rooms_name
 * @property string $rooms_floor
 * @property int $rooms_capacity
 * @property string $buildings_id
 */
class ExamRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_room';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_exam');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rooms_id', 'rooms_name', 'rooms_floor', 'rooms_capacity', 'buildings_id'], 'required'],
            [['rooms_capacity'], 'integer'],
            [['rooms_id'], 'string', 'max' => 11],
            [['rooms_name'], 'string', 'max' => 100],
            [['rooms_floor'], 'string', 'max' => 2],
            [['buildings_id'], 'string', 'max' => 4],
            [['rooms_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rooms_id' => 'Rooms ID',
            'rooms_name' => 'Rooms Name',
            'rooms_floor' => 'Rooms Floor',
            'rooms_capacity' => 'Rooms Capacity',
            'buildings_id' => 'Buildings ID',
        ];
    }
}

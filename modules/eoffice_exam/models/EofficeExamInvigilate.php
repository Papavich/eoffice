<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "eoffice_exam_invigilate".
 *
 * @property int $person_id
 * @property string $exam_date
 * @property string $examstart_time
 * @property string $exam_end_time
 * @property string $rooms_id
 */
class EofficeExamInvigilate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_exam_invigilate';
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
            [['person_id', 'exam_date', 'examstart_time', 'exam_end_time', 'rooms_id'], 'required'],
            [['person_id'], 'integer'],
            [['exam_date'], 'safe'],
            [['examstart_time', 'exam_end_time'], 'string', 'max' => 10],
            [['rooms_id'], 'string', 'max' => 11],
            [['person_id', 'exam_date', 'examstart_time', 'exam_end_time'], 'unique', 'targetAttribute' => ['person_id', 'exam_date', 'examstart_time', 'exam_end_time']],
        ];
    }
    public function getPername()
    {
        return $this->hasOne(ViewPisPerson::className(), ['person_id' => 'person_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'exam_date' => 'Exam Date',
            'examstart_time' => 'Examstart Time',
            'exam_end_time' => 'Exam End Time',
            'rooms_id' => 'Rooms ID',
        ];
    }
}

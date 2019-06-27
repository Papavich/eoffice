<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_progress_file".
 *
 * @property int $progress_seq
 * @property string $student_id
 * @property int $year
 * @property int $semester
 * @property string $progress_file
 *
 * @property ScbStudent $student
 * @property ScbYearHasSemester $year0
 */
class ScbProgressFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_progress_file';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['progress_seq', 'student_id', 'year', 'semester'], 'required'],
            [['progress_seq', 'year', 'semester'], 'integer'],
            [['student_id'], 'string', 'max' => 11],
            [['progress_file'], 'string', 'max' => 255],
            [['progress_seq', 'student_id', 'year', 'semester'], 'unique', 'targetAttribute' => ['progress_seq', 'student_id', 'year', 'semester']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
            [['year', 'semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYearHasSemester::className(), 'targetAttribute' => ['year' => 'year', 'semester' => 'semester']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'progress_seq' => 'Progress Seq',
            'student_id' => 'Student ID',
            'year' => 'Year',
            'semester' => 'Semester',
            'progress_file' => 'Progress File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYearHasSemester::className(), ['year' => 'year', 'semester' => 'semester']);
    }
}

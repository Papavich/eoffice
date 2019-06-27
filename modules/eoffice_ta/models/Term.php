<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "term".
 *
 * @property string $term_id
 * @property string $term_name
 * @property string $year
 *
 * @property SubjectOpen0[] $subjectOpen0s
 * @property Subject0[] $subjects
 * @property TaAssessmentOpen[] $taAssessmentOpens
 * @property TaClassSchedule[] $taClassSchedules
 * @property Person[] $people
 * @property TaSchedule[] $taSchedules
 * @property TaSchedule[] $taSchedules0
 * @property Year $year0
 */
class Term extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'term';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['term_id', 'year'], 'required'],
            [['term_id', 'year'], 'string', 'max' => 10],
            [['term_name'], 'string', 'max' => 45],
            [['term_id', 'year'], 'unique', 'targetAttribute' => ['term_id', 'year']],
            [['year'], 'exist', 'skipOnError' => true, 'targetClass' => Year::className(), 'targetAttribute' => ['year' => 'year_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'term_id' => 'Term ID',
            'term_name' => 'Term Name',
            'year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectOpen0s()
    {
        return $this->hasMany(SubjectOpen0::className(), ['subopen_semester' => 'term_id', 'subopen_year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject0::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version'])->viaTable('subject_open0', ['subopen_semester' => 'term_id', 'subopen_year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssessmentOpens()
    {
        return $this->hasMany(TaAssessmentOpen::className(), ['term' => 'term_id', 'year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaClassSchedules()
    {
        return $this->hasMany(TaClassSchedule::className(), ['term_id' => 'term_id', 'year_id' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])->viaTable('ta_class_schedule', ['term_id' => 'term_id', 'year_id' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaSchedules()
    {
        return $this->hasMany(TaSchedule::className(), ['term' => 'term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaSchedules0()
    {
        return $this->hasMany(TaSchedule::className(), ['year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(Year::className(), ['year_id' => 'year']);
    }
}

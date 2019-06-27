<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_request_subject".
 *
 * @property string $person_id
 * @property string $subject_id
 * @property string $term_id
 * @property string $year
 *
 * @property TaPayment[] $taPayments
 * @property TaRequest0 $person
 * @property Kku30SubjectOpen $subject
 * @property Kku30SubjectOpen $term
 * @property Kku30SubjectOpen $year0
 */
class TaRequestSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_request_subject';
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
            [['person_id', 'subject_id', 'term_id', 'year'], 'required'],
            [['person_id'], 'string', 'max' => 15],
            [['subject_id', 'term_id', 'year'], 'string', 'max' => 10],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaRequest0::className(), 'targetAttribute' => ['person_id' => 'person_id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30SubjectOpen::className(), 'targetAttribute' => ['subject_id' => 'subject_id']],
            [['term_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30SubjectOpen::className(), 'targetAttribute' => ['term_id' => 'subopen_semester']],
            [['year'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30SubjectOpen::className(), 'targetAttribute' => ['year' => 'subopen_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'subject_id' => 'Subject ID',
            'term_id' => 'Term ID',
            'year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPayments()
    {
        return $this->hasMany(TaPayment::className(), ['subject_id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(TaRequest0::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Kku30SubjectOpen::className(), ['subject_id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerm()
    {
        return $this->hasOne(Kku30SubjectOpen::className(), ['subopen_semester' => 'term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(Kku30SubjectOpen::className(), ['subopen_year' => 'year']);
    }
}

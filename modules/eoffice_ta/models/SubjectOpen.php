<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "view_kku30_subject_open".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property string $subopen_semester
 * @property string $subopen_year
 * @property int $amount_sec
 *
 * @property Section[] $sections
 * @property Subject $subject
 * @property Term $subopenSemester
 * @property Year $subopenYear
 * @property TaRegister[] $taRegisters
 */
class SubjectOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_kku30_subject_open';
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
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'required'],
            [['subject_version', 'amount_sec'], 'integer'],
            [['subject_id', 'subopen_semester', 'subopen_year'], 'string', 'max' => 10],
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'subopen_semester', 'subopen_year']],
            [['subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
            [['subopen_semester'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['subopen_semester' => 'term_id']],
            [['subopen_year'], 'exist', 'skipOnError' => true, 'targetClass' => Year::className(), 'targetAttribute' => ['subopen_year' => 'year_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'subopen_semester' => 'Subopen Semester',
            'subopen_year' => 'Subopen Year',
            'amount_sec' => 'Amount Sec',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'term_id' => 'subopen_semester', 'year_id' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubopenSemester()
    {
        return $this->hasOne(Term::className(), ['term_id' => 'subopen_semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubopenYear()
    {
        return $this->hasOne(Year::className(), ['year_id' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRegisters()
    {
        return $this->hasMany(TaRegister::className(), ['subject_id' => 'subject_id', 'term' => 'subopen_semester', 'year' => 'subopen_year']);
    }
}

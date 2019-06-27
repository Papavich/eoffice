<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_subject_open".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 *
 * @property Kku30Section[] $kku30Sections
 * @property Kku30Subject $subject
 * @property Kku30SubjectOpenProgram[] $kku30SubjectOpenPrograms
 * @property Kku30Program[] $programs
 */
class Kku30SubjectOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subject_open';
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
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'subopen_semester', 'subopen_year']],
            [['subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30Sections()
    {
        return $this->hasMany(Kku30Section::className(), ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Kku30Subject::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectOpenPrograms()
    {
        return $this->hasMany(Kku30SubjectOpenProgram::className(), ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrograms()
    {
        return $this->hasMany(Kku30Program::className(), ['program_id' => 'program_id', 'program_class' => 'program_class'])->viaTable('kku30_subject_open_program', ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }
}

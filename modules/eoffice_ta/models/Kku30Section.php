<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "kku30_section".
 *
 * @property string $section_no
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 * @property int $section_size
 * @property string $section_join_lec
 * @property string $section_join_lab
 * @property int $section_count_lec
 * @property int $section_count_lab
 * @property string $section_condition_lab
 *
 * @property Kku30SubjectOpen $subject
 * @property Kku30SectionProgram[] $kku30SectionPrograms
 * @property Kku30Program[] $programs
 * @property Kku30SectionTeacher[] $kku30SectionTeachers
 */
class Kku30Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_section';
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
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'section_size'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year', 'section_size', 'section_count_lec', 'section_count_lab'], 'integer'],
            [['section_no', 'subject_id'], 'string', 'max' => 10],
            [['section_join_lec', 'section_join_lab'], 'string', 'max' => 50],
            [['section_condition_lab'], 'string', 'max' => 15],
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'unique', 'targetAttribute' => ['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year']],
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30SubjectOpen::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_no' => 'Section No',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'subopen_semester' => 'Subopen Semester',
            'subopen_year' => 'Subopen Year',
            'section_size' => 'Section Size',
            'section_join_lec' => 'Section Join Lec',
            'section_join_lab' => 'Section Join Lab',
            'section_count_lec' => 'Section Count Lec',
            'section_count_lab' => 'Section Count Lab',
            'section_condition_lab' => 'Section Condition Lab',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Kku30SubjectOpen::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SectionPrograms()
    {
        return $this->hasMany(Kku30SectionProgram::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrograms()
    {
        return $this->hasMany(Kku30Program::className(), ['program_id' => 'program_id', 'program_class' => 'program_class'])->viaTable('kku30_section_program', ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SectionTeachers()
    {
        return $this->hasMany(Kku30SectionTeacher::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }
}

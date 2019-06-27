<?php

namespace app\modules\kku30\models;

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
 * @property int $section_condition_lab
 *
 * @property Kku30GroupSection[] $kku30GroupSections
 * @property Kku30Group[] $groupNos
 * @property Kku30SubjectOpen $subopenSemester
 * @property Kku30SectionProgram[] $kku30SectionPrograms
 * @property Kku30SectionTeacher[] $kku30SectionTeachers
 * @property Kku30Teacher[] $teacherNos
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
     * @inheritdoc
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'section_size'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year', 'section_size', 'section_count_lec', 'section_count_lab', 'section_condition_lab'], 'integer'],
            [['section_no', 'subject_id'], 'string', 'max' => 10],
            [['section_join_lec', 'section_join_lab'], 'string', 'max' => 50],
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'unique', 'targetAttribute' => ['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year']],
            [['subopen_semester', 'subopen_year', 'subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30SubjectOpen::className(), 'targetAttribute' => ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
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
    public function getKku30GroupSections()
    {
        return $this->hasMany(Kku30GroupSection::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupNos()
    {
        return $this->hasMany(Kku30Group::className(), ['group_no' => 'group_no'])->viaTable('kku30_group_section', ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubopenSemester()
    {
        return $this->hasOne(Kku30SubjectOpen::className(), ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
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
    public function getKku30SectionTeachers()
    {
        return $this->hasMany(Kku30SectionTeacher::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherNos()
    {
        return $this->hasMany(Kku30Teacher::className(), ['teacher_no' => 'teacher_no'])->viaTable('kku30_section_teacher', ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }
}

<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "view_kku30_section".
 *
 * @property string $section_no
 * @property string $term_id
 * @property string $year_id
 * @property string $subject_id
 * @property int $subject_version
 * @property int $section_size
 * @property string $section_hour
 * @property int $section_type
 * @property string $section_programs_type
 * @property int $amount_student
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property SubjectOpen $subject
 * @property SectionTeacher[] $SectionTeachers
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_kku30_section';
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
            [['section_no', 'term_id', 'year_id', 'subject_id', 'subject_version'], 'required'],
            [['subject_version', 'section_size', 'section_type', 'amount_student', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['section_no', 'term_id', 'year_id', 'subject_id'], 'string', 'max' => 10],
            [['section_hour'], 'string', 'max' => 5],
            [['section_programs_type'], 'string', 'max' => 45],
            [['section_no', 'term_id', 'year_id', 'subject_id', 'subject_version'], 'unique', 'targetAttribute' => ['section_no', 'term_id', 'year_id', 'subject_id', 'subject_version']],
            [['subject_id', 'subject_version', 'term_id', 'year_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubjectOpen::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'term_id' => 'subopen_semester', 'year_id' => 'subopen_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_no' => 'Section No',
            'term_id' => 'Term ID',
            'year_id' => 'Year ID',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'section_size' => 'Section Size',
            'section_hour' => 'Section Hour',
            'section_type' => 'Section Type',
            'section_programs_type' => 'Section Programs Type',
            'amount_student' => 'Amount Student',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(SubjectOpen::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'term_id', 'subopen_year' => 'year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionTeachers()
    {
        return $this->hasMany(SectionTeacher::className(), ['section_no' => 'section_no', 'term_id' => 'term_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }
}

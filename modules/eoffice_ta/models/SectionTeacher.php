<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "view_kku30_section_teacher".
 *
 * @property string $teacher_id
 * @property string $section_no
 * @property string $term_id
 * @property string $year_id
 * @property string $subject_id
 * @property int $subject_version
 *
 * @property Section $sectionNo
 */
class SectionTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_kku30_section_teacher';
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
            [['teacher_id', 'section_no', 'term_id', 'year_id', 'subject_id', 'subject_version'], 'required'],
            [['subject_version'], 'integer'],
            [['teacher_id'], 'string', 'max' => 15],
            [['section_no', 'term_id', 'year_id', 'subject_id'], 'string', 'max' => 10],
            [['teacher_id', 'section_no', 'term_id', 'year_id', 'subject_id', 'subject_version'], 'unique', 'targetAttribute' => ['teacher_id', 'section_no', 'term_id', 'year_id', 'subject_id', 'subject_version']],
            [['section_no', 'term_id', 'year_id', 'subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Section::className(), 'targetAttribute' => ['section_no' => 'section_no', 'term_id' => 'term_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => 'Teacher ID',
            'section_no' => 'Section No',
            'term_id' => 'Term ID',
            'year_id' => 'Year ID',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNo()
    {
        return $this->hasOne(Kku30Section::className(), ['section_no' => 'section_no', 'term_id' => 'term_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }
}

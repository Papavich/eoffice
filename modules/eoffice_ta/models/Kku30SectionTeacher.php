<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "kku30_section_teacher".
 *
 * @property string $section_no
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 * @property int $teacher_no
 *
 * @property Kku30Section $sectionNo
 */
class Kku30SectionTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_section_teacher';
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
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'teacher_no'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year', 'teacher_no'], 'integer'],
            [['section_no', 'subject_id'], 'string', 'max' => 10],
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'teacher_no'], 'unique', 'targetAttribute' => ['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'teacher_no']],
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Section::className(), 'targetAttribute' => ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']],
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
            'teacher_no' => 'Teacher No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNo()
    {
        return $this->hasOne(Kku30Section::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }
}

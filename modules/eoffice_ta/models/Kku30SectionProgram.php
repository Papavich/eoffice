<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "kku30_section_program".
 *
 * @property string $section_no
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 * @property string $program_id
 * @property int $program_class
 *
 * @property Kku30Program $program
 * @property Kku30Section $sectionNo
 */
class Kku30SectionProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_section_program';
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
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year', 'program_class'], 'integer'],
            [['section_no', 'subject_id', 'program_id'], 'string', 'max' => 10],
            [['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class'], 'unique', 'targetAttribute' => ['section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class']],
            [['program_id', 'program_class'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Program::className(), 'targetAttribute' => ['program_id' => 'program_id', 'program_class' => 'program_class']],
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
            'program_id' => 'Program ID',
            'program_class' => 'Program Class',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Kku30Program::className(), ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNo()
    {
        return $this->hasOne(Kku30Section::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }
}

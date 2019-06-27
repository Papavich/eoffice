<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_teacher".
 *
 * @property int $teacher_no
 * @property string $teacher_id
 * @property string $teacher_prefix
 * @property string $teacher_name
 * @property string $teacher_name_eng
 * @property string $teacher_surname
 * @property string $teacher_surname_eng
 * @property string $teacher_department_id
 * @property string $teacher_position_type
 * @property string $teacher_mobile
 * @property string $teacher_email
 * @property string $teacher_academic_positions
 * @property string $teacher_academic_positions_eng
 * @property string $teacher_academic_positions_abb
 *
 * @property Kku30SectionTeacher[] $kku30SectionTeachers
 * @property Kku30Section[] $sectionNos
 */
class Kku30Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_teacher';
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
            [['teacher_id', 'teacher_prefix', 'teacher_name', 'teacher_name_eng'], 'required'],
            [['teacher_id', 'teacher_prefix', 'teacher_name', 'teacher_name_eng', 'teacher_surname', 'teacher_surname_eng', 'teacher_department_id', 'teacher_position_type', 'teacher_academic_positions', 'teacher_academic_positions_eng', 'teacher_academic_positions_abb'], 'string', 'max' => 50],
            [['teacher_mobile'], 'string', 'max' => 20],
            [['teacher_email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_no' => 'Teacher No',
            'teacher_id' => 'Teacher ID',
            'teacher_prefix' => 'Teacher Prefix',
            'teacher_name' => 'Teacher Name',
            'teacher_name_eng' => 'Teacher Name Eng',
            'teacher_surname' => 'Teacher Surname',
            'teacher_surname_eng' => 'Teacher Surname Eng',
            'teacher_department_id' => 'Teacher Department ID',
            'teacher_position_type' => 'Teacher Position Type',
            'teacher_mobile' => 'Teacher Mobile',
            'teacher_email' => 'Teacher Email',
            'teacher_academic_positions' => 'Teacher Academic Positions',
            'teacher_academic_positions_eng' => 'Teacher Academic Positions Eng',
            'teacher_academic_positions_abb' => 'Teacher Academic Positions Abb',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SectionTeachers()
    {
        return $this->hasMany(Kku30SectionTeacher::className(), ['teacher_no' => 'teacher_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNos()
    {
        return $this->hasMany(Kku30Section::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year'])->viaTable('kku30_section_teacher', ['teacher_no' => 'teacher_no']);
    }
}

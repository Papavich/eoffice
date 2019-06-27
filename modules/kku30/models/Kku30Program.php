<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_program".
 *
 * @property string $program_id
 * @property int $program_class
 * @property string $program_name
 * @property string $program_nameeng
 *
 * @property Kku30ProgramsCourse[] $kku30ProgramsCourses
 * @property Kku30SectionProgram[] $kku30SectionPrograms
 * @property Kku30SubjectOpenProgram[] $kku30SubjectOpenPrograms
 * @property Kku30SubjectOpen[] $subopenSemesters
 */
class Kku30Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_program';
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
            [['program_id', 'program_class', 'program_name', 'program_nameeng'], 'required'],
            [['program_class'], 'integer'],
            [['program_id'], 'string', 'max' => 10],
            [['program_name', 'program_nameeng'], 'string', 'max' => 50],
            [['program_id', 'program_class'], 'unique', 'targetAttribute' => ['program_id', 'program_class']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'program_id' => 'Program ID',
            'program_class' => 'Program Class',
            'program_name' => 'Program Name',
            'program_nameeng' => 'Program Nameeng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30ProgramsCourses()
    {
        return $this->hasMany(Kku30ProgramsCourse::className(), ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SectionPrograms()
    {
        return $this->hasMany(Kku30SectionProgram::className(), ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectOpenPrograms()
    {
        return $this->hasMany(Kku30SubjectOpenProgram::className(), ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubopenSemesters()
    {
        return $this->hasMany(Kku30SubjectOpen::className(), ['subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version'])->viaTable('kku30_subject_open_program', ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }
}

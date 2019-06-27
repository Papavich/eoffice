<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "kku30_program".
 *
 * @property string $program_id
 * @property int $program_class
 * @property string $program_name
 * @property string $program_nameeng
 *
 * @property Kku30SectionProgram[] $kku30SectionPrograms
 * @property Kku30Section[] $sectionNos
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
    public function getKku30SectionPrograms()
    {
        return $this->hasMany(Kku30SectionProgram::className(), ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionNos()
    {
        return $this->hasMany(Kku30Section::className(), ['section_no' => 'section_no', 'subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year'])->viaTable('kku30_section_program', ['program_id' => 'program_id', 'program_class' => 'program_class']);
    }
}

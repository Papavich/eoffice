<?php

namespace app\modules\eoffice_ta\models\model_kku30;

use Yii;

/**
 * This is the model class for table "eoffice_kku30.kku30_section".
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
 */
class Kku30Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_kku30.kku30_section';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
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
}

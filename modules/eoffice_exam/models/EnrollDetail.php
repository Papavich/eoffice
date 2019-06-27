<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "eoffice_exam_enroll_detail".
 *
 * @property string $STUDENTID
 * @property string $section_no
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 * @property string $program_id
 * @property int $program_class
 */
class EnrollDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_exam_enroll_detail';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_exam');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year', 'program_class'], 'integer'],
            [['STUDENTID'], 'string', 'max' => 20],
            [['section_no', 'subject_id', 'program_id'], 'string', 'max' => 10],
            [['STUDENTID', 'section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class'], 'unique', 'targetAttribute' => ['STUDENTID', 'section_no', 'subject_id', 'subject_version', 'subopen_semester', 'subopen_year', 'program_id', 'program_class']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
            'section_no' => 'Section No',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'subopen_semester' => 'Subopen Semester',
            'subopen_year' => 'Subopen Year',
            'program_id' => 'Program ID',
            'program_class' => 'Program Class',
        ];
    }
}

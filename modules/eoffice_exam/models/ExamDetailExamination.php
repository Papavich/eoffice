<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "exam_detail_examination".
 *
 * @property string $exam_detail_date_start
 * @property string $exam_detail_date_end
 * @property int $subopen_semester
 * @property int $subopen_year
 * @property string $Examcode
 * @property string $TimeStamp
 */
class ExamDetailExamination extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_detail_examination';
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
            [['exam_detail_date_start', 'exam_detail_date_end', 'subopen_semester', 'subopen_year', 'Examcode', 'TimeStamp'], 'required'],
            [['exam_detail_date_start', 'exam_detail_date_end'], 'safe'],
            [['subopen_semester', 'subopen_year'], 'integer'],
            [['Examcode', 'TimeStamp'], 'string', 'max' => 100],
            [['exam_detail_date_start', 'exam_detail_date_end', 'subopen_semester', 'subopen_year', 'Examcode'], 'unique', 'targetAttribute' => ['exam_detail_date_start', 'exam_detail_date_end', 'subopen_semester', 'subopen_year', 'Examcode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exam_detail_date_start' => 'Exam Detail Date Start',
            'exam_detail_date_end' => 'Exam Detail Date End',
            'subopen_semester' => 'ภาคการศึกษา',
            'subopen_year' => 'ปีการศึกษา',
            'Examcode' => 'ประเภทการสอบ',
            'TimeStamp' => 'Time Stamp',
        ];
    }
}

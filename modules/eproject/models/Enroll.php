<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_enroll".
 *
 * @property int $student_id
 * @property int $year_id
 * @property int $subject_id
 * @property int $semester_id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property OpenSubject $year
 * @property User $student
 * @property StudentProject $studentProject
 * @property StudentRequestAdviser[] $studentRequestAdvisers
 * @property RequestAdviser[] $adviserRequests
 */
class Enroll extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_enroll_eproject';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'year_id', 'subject_id', 'semester_id', ], 'required'],
            [['student_id', 'year_id', 'semester_id', 'crby', 'udby'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['crtime', 'udtime'], 'safe'],
            [['student_id', 'year_id', 'subject_id', 'semester_id'], 'unique', 'targetAttribute' => ['student_id', 'year_id', 'subject_id', 'semester_id']],
            [['year_id', 'subject_id', 'semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => OpenSubject::className(), 'targetAttribute' => ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'year_id' => 'Year ID',
            'subject_id' => 'Subject ID',
            'semester_id' => 'Semester ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(OpenSubject::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
            return $this->hasOne(User::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentProject()
    {
        return $this->hasOne(StudentProject::className(), ['student_id' => 'student_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentRequestAdvisers()
    {
        return $this->hasMany(StudentRequestAdviser::className(), ['student_id' => 'student_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviserRequests()
    {
        return $this->hasMany(RequestAdviser::className(), ['id' => 'adviser_request_id'])->viaTable('epro_student_request_adviser', ['student_id' => 'student_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }
}

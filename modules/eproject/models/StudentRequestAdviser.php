<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_student_request_adviser".
 *
 * @property int $adviser_request_id
 * @property int $student_id
 * @property int $year_id
 * @property int $subject_id
 * @property int $semester_id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Enroll $student
 * @property RequestAdviser $adviserRequest
 */
class StudentRequestAdviser extends \yii\db\ActiveRecord
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
        return 'epro_student_request_adviser';
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
            [['adviser_request_id', 'student_id', 'year_id', 'subject_id', 'semester_id', ], 'required'],
            [['adviser_request_id', 'student_id', 'year_id', 'semester_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['subject_id'], 'string', 'max' => 10],
            [['adviser_request_id', 'student_id', 'year_id', 'subject_id', 'semester_id'], 'unique', 'targetAttribute' => ['adviser_request_id', 'student_id', 'year_id', 'subject_id', 'semester_id']],
            [['student_id', 'year_id', 'subject_id', 'semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enroll::className(), 'targetAttribute' => ['student_id' => 'student_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']],
            [['adviser_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestAdviser::className(), 'targetAttribute' => ['adviser_request_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adviser_request_id' => 'Adviser Request ID',
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
    public function getStudent()
    {
        return $this->hasOne(Enroll::className(), ['student_id' => 'student_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviserRequest()
    {
        return $this->hasOne(RequestAdviser::className(), ['id' => 'adviser_request_id']);
    }
}

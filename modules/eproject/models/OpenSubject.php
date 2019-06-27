<?php

namespace app\modules\eproject\models;

use Yii;

/**
 * This is the model class for table "eoffice_kku30.view_kku30_open_subject".
 *
 * @property string $subject_id
 * @property int $semester_id
 * @property int $year_id
 */
class OpenSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
//        return 'eoffice_kku30.view_kku30_open_subject';
        return 'eoffice_central.view_pis_open_subject';
    }
    public static function primaryKey()
    {
        return ['subject_id', 'semester_id', 'year_id'];
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
            [['subject_id', 'semester_id', 'year_id'], 'required'],
            [['semester_id', 'year_id'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'semester_id' => 'Semester ID',
            'year_id' => 'Year ID',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviserBroadcasts()
    {
        return $this->hasMany(AdviserBroadcast::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolls()
    {
        return $this->hasMany(Enroll::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(User::className(), ['id' => 'student_id'])->viaTable('epro_enroll', ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamCommittees()
    {
        return $this->hasMany(ExamCommittee::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectExamGroups()
    {
        return $this->hasMany(ProjectExamGroup::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvisers()
    {
        return $this->hasMany(User::className(), ['id' => 'adviser_id'])->viaTable('epro_request_advisee', ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(SubjectView::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(YearSemester::className(), ['year_id' => 'year_id', 'semester_id' => 'semester_id']);
    }
}

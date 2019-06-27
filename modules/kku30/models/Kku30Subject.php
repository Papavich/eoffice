<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_subject".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property string $subject_namethai
 * @property string $subject_nameeng
 * @property int $subject_credit
 * @property string $subject_time
 * @property string $subject_description
 * @property string $host_programs
 * @property int $subject_type
 * @property double $subject_time_lecture
 * @property double $subject_time_lab
 * @property int $subject_status
 *
 * @property Kku30SubjectCoruse[] $kku30SubjectCoruses
 * @property Kku30SubjectCoursePlan[] $kku30SubjectCoursePlans
 * @property Kku30SubjectOpen[] $kku30SubjectOpens
 */
class Kku30Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subject';
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
            [['subject_id', 'subject_version', 'subject_namethai', 'subject_nameeng', 'subject_credit', 'subject_time', 'subject_description'], 'required'],
            [['subject_version', 'subject_credit', 'subject_type', 'subject_status'], 'integer'],
            [['subject_description'], 'string'],
            [['subject_time_lecture', 'subject_time_lab'], 'number'],
            [['subject_id'], 'string', 'max' => 10],
            [['subject_namethai', 'subject_nameeng'], 'string', 'max' => 100],
            [['subject_time'], 'string', 'max' => 6],
            [['host_programs'], 'string', 'max' => 5],
            [['subject_id', 'subject_version'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'subject_namethai' => 'Subject Namethai',
            'subject_nameeng' => 'Subject Nameeng',
            'subject_credit' => 'Subject Credit',
            'subject_time' => 'Subject Time',
            'subject_description' => 'Subject Description',
            'host_programs' => 'Host Programs',
            'subject_type' => 'Subject Type',
            'subject_time_lecture' => 'Subject Time Lecture',
            'subject_time_lab' => 'Subject Time Lab',
            'subject_status' => 'Subject Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectCoruses()
    {
        return $this->hasMany(Kku30SubjectCoruse::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectCoursePlans()
    {
        return $this->hasMany(Kku30SubjectCoursePlan::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectOpens()
    {
        return $this->hasMany(Kku30SubjectOpen::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }
}

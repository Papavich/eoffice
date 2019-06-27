<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_exam_committee".
 *
 * @property int $user_id
 * @property int $year_id
 * @property int $subject_id
 * @property int $semester_id
 * @property int $exam_group_id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property ExamGroup $examGroup
 * @property OpenSubject $year
 * @property User $user
 */
class ExamCommittee extends \yii\db\ActiveRecord
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
        return 'epro_exam_committee';
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
            [['user_id', 'year_id', 'subject_id', 'semester_id', 'exam_group_id', ], 'required'],
            [['user_id', 'year_id', 'semester_id', 'exam_group_id', 'crby', 'udby'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['crtime', 'udtime'], 'safe'],
            [['user_id', 'year_id', 'subject_id', 'semester_id'], 'unique', 'targetAttribute' => ['user_id', 'year_id', 'subject_id', 'semester_id']],
            [['exam_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExamGroup::className(), 'targetAttribute' => ['exam_group_id' => 'id']],
            [['year_id', 'subject_id', 'semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => OpenSubject::className(), 'targetAttribute' => ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'year_id' => 'Year ID',
            'subject_id' => 'Subject ID',
            'semester_id' => 'Semester ID',
            'exam_group_id' => 'Exam Group ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamGroup()
    {
        return $this->hasOne(ExamGroup::className(), ['id' => 'exam_group_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

<?php

namespace app\modules\pfc\models;

use app\modules\pfc\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_student_project".
 *
 * @property int $student_id
 * @property int $year_id
 * @property int $subject_id
 * @property int $semester_id
 * @property int $project_id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *

 * @property Project $project
 */
class ViewStudentProject extends \yii\db\ActiveRecord
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
        return 'epro_student_project';
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
            [['student_id', 'year_id', 'subject_id', 'semester_id', 'project_id', ], 'required'],
            [['student_id', 'year_id', 'semester_id', 'project_id', 'crby', 'udby'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['crtime', 'udtime'], 'safe'],
            [['student_id', 'year_id', 'subject_id', 'semester_id', 'project_id'], 'unique', 'targetAttribute' => ['student_id', 'year_id', 'subject_id', 'semester_id', 'project_id']],
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
            'project_id' => 'Project ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(ViewProject::className(), ['id' => 'project_id']);
    }
}

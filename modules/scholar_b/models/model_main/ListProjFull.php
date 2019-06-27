<?php

namespace app\modules\scholar_b\models\model_main;

use Yii;

/**
 * This is the model class for table "list_proj_full".
 *
 * @property string $teacher_id_card
 * @property int $adviser_status
 * @property int $project_code
 * @property int $crby
 * @property int $udby
 * @property string $student_id
 * @property string $project_name
 * @property string $project_detail
 * @property string $project_date
 * @property int $project_status
 * @property string $project_file
 * @property string $project_image
 * @property int $pro_status
 * @property string $crtime
 * @property string $udtime
 * @property int $semester
 * @property int $year
 * @property int $project_type_id
 */
class ListProjFull extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'list_proj_full';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id_card', 'adviser_status', 'student_id', 'semester', 'year', 'project_type_id'], 'required'],
            [['adviser_status', 'project_code', 'crby', 'udby', 'project_status', 'pro_status', 'semester', 'year', 'project_type_id'], 'integer'],
            [['project_detail'], 'string'],
            [['project_date', 'crtime', 'udtime'], 'safe'],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['student_id'], 'string', 'max' => 11],
            [['project_name', 'project_file', 'project_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_id_card' => 'Teacher Id Card',
            'adviser_status' => 'Adviser Status',
            'project_code' => 'Project Code',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'student_id' => 'Student ID',
            'project_name' => 'Project Name',
            'project_detail' => 'Project Detail',
            'project_date' => 'Project Date',
            'project_status' => 'Project Status',
            'project_file' => 'Project File',
            'project_image' => 'Project Image',
            'pro_status' => 'Pro Status',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'semester' => 'Semester',
            'year' => 'Year',
            'project_type_id' => 'Project Type ID',
        ];
    }
}

<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "listproject".
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
 */
class Listproject extends \yii\db\ActiveRecord
{
    /**
<<<<<<< HEAD
     * @inheritdoc
=======
     * {@inheritdoc}
>>>>>>> origin/master
     */
    public static function tableName()
    {
        return 'listproject';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }


    public function rules()
    {
        return [

            [['teacher_id_card', 'adviser_status', 'student_id'], 'required'],
            [['teacher_id_card', 'student_id'], 'required'],
            [['adviser_status', 'project_code', 'crby', 'udby', 'project_status', 'pro_status'], 'integer'],
            [['project_detail'], 'string'],
            [['project_date', 'crtime', 'udtime'], 'safe'],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['student_id'], 'string', 'max' => 11],
            [['project_name', 'project_file', 'project_image'], 'string', 'max' => 255],
        ];
    }

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
        ];
    }
}

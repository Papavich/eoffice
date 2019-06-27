<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "listport".
 *
 * @property string $teacher_id_card
 * @property int $project_code
 * @property int $project_type_id
 * @property string $project_name
 * @property int $id_portfolio
 * @property string $port_name
 * @property string $port_img
 * @property string $port_date
 * @property string $port_location
 * @property string $port_detail
 * @property string $port_file
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property int $port_type_id
 * @property string $student_id
 * @property int $adviser_status
 * @property int $port_status
 */
class Listport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listport';
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
            [['teacher_id_card', 'project_type_id', 'port_type_id', 'student_id', 'adviser_status'], 'required'],
            [['project_code', 'project_type_id', 'id_portfolio', 'crby', 'udby', 'port_type_id', 'adviser_status', 'port_status'], 'integer'],
            [['port_date', 'crtime', 'udtime'], 'safe'],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['project_name', 'port_img', 'port_file'], 'string', 'max' => 255],
            [['port_name', 'port_location', 'port_detail'], 'string', 'max' => 45],
            [['student_id'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_id_card' => 'Teacher Id Card',
            'project_code' => 'Project Code',
            'project_type_id' => 'Project Type ID',
            'project_name' => 'Project Name',
            'id_portfolio' => 'Id Portfolio',
            'port_name' => 'Port Name',
            'port_img' => 'Port Img',
            'port_date' => 'Port Date',
            'port_location' => 'Port Location',
            'port_detail' => 'Port Detail',
            'port_file' => 'Port File',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'port_type_id' => 'Port Type ID',
            'student_id' => 'Student ID',
            'adviser_status' => 'Adviser Status',
            'port_status' => 'Port Status',
        ];
    }
}

<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "listactivity".
 *
 * @property int $act_main_id
 * @property int $act_type_id
 * @property string $act_main_name
 * @property string $act_main_location
 * @property string $act_main_date_start
 * @property string $act_main_date_end
 * @property string $act_main_detail
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property string $student_id
 * @property int $activity_main_id
 * @property int $year
 * @property int $select_activity_status
 * @property string $activity_img
 */
class Listactivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'listactivity';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_main_id', 'act_type_id', 'student_id', 'activity_main_id', 'year'], 'required'],
            [['act_main_id', 'act_type_id', 'crby', 'udby', 'activity_main_id', 'year', 'select_activity_status'], 'integer'],
            [['act_main_date_start', 'act_main_date_end', 'crtime', 'udtime'], 'safe'],
            [['act_main_detail'], 'string'],
            [['act_main_name', 'act_main_location'], 'string', 'max' => 45],
            [['student_id'], 'string', 'max' => 11],
            [['activity_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'act_main_id' => 'Act Main ID',
            'act_type_id' => 'Act Type ID',
            'act_main_name' => 'Act Main Name',
            'act_main_location' => 'Act Main Location',
            'act_main_date_start' => 'Act Main Date Start',
            'act_main_date_end' => 'Act Main Date End',
            'act_main_detail' => 'Act Main Detail',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'student_id' => 'Student ID',
            'activity_main_id' => 'Activity Main ID',
            'year' => 'Year',
            'select_activity_status' => 'Select Activity Status',
            'activity_img' => 'Activity Img',
        ];
    }
}

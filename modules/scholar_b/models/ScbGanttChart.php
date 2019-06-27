<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_gantt_chart".
 *
 * @property integer $gantt_id
 * @property string $student_id
 * @property string $gantt_name
 * @property string $gantt_detail
 * @property string $gantt_date_start
 * @property string $gantt_date_end
 * @property string $gantt_deadline
 * @property integer $gantt_status
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property ScbStudent $student
 */
class ScbGanttChart extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_gantt_chart';
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
            [['gantt_id', 'student_id'], 'required'],
            [['gantt_id', 'gantt_status', 'crby', 'udby'], 'integer'],
            [['gantt_date_start', 'gantt_date_end', 'gantt_deadline', 'crtime', 'udtime'], 'safe'],
            [['student_id'], 'string', 'max' => 11],
            [['gantt_name'], 'string', 'max' => 45],
            [['gantt_detail'], 'string', 'max' => 100],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gantt_id' => 'Gantt ID',
            'student_id' => 'Student ID',
            'gantt_name' => 'Gantt Name',
            'gantt_detail' => 'Gantt Detail',
            'gantt_date_start' => 'Gantt Date Start',
            'gantt_date_end' => 'Gantt Date End',
            'gantt_deadline' => 'Gantt Deadline',
            'gantt_status' => 'Gantt Status',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }
}

<?php

namespace app\modules\eoffice_ta\models\model_kku30;

use Yii;

/**
 * This is the model class for table "eoffice_kku30.kku30_subject".
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
 */
class Kku30Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_kku30.kku30_subject';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    /**
     * @inheritdoc
     */
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
}

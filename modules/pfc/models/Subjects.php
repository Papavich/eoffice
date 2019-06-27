<?php

namespace app\modules\pfc\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property string $subjects_id
 * @property string $subjects_code
 * @property string $subjects_name_thai
 * @property string $subjects_name_eng
 * @property int $subject_year
 * @property int $subject_semester
 *
 * @property ProcessGanttType[] $processGanttTypes
 * @property ProjectConnect[] $projectConnects
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfc');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subjects_id', 'subjects_code', 'subjects_name_thai', 'subjects_name_eng', 'subject_year', 'subject_semester'], 'required'],
            [['subject_year', 'subject_semester'], 'integer'],
            [['subjects_id'], 'string', 'max' => 45],
            [['subjects_code'], 'string', 'max' => 11],
            [['subjects_name_thai', 'subjects_name_eng'], 'string', 'max' => 100],
            [['subjects_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subjects_id' => 'Subjects ID',
            'subjects_code' => 'Subjects Code',
            'subjects_name_thai' => 'Subjects Name Thai',
            'subjects_name_eng' => 'Subjects Name Eng',
            'subject_year' => 'Subject Year',
            'subject_semester' => 'Subject Semester',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessGanttTypes()
    {
        return $this->hasMany(ProcessGanttType::className(), ['subjects_id' => 'subjects_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectConnects()
    {
        return $this->hasMany(ProjectConnect::className(), ['subjects_id' => 'subjects_id']);
    }
}

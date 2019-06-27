<?php

namespace app\modules\pfc\models;

use Yii;

/**
 * This is the model class for table "kku30_subject_open".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 *

 */
class ViewSubjectOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subject_open';
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
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'subopen_semester', 'subopen_year']],
            [['subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => ViewSubject::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
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
            'subopen_semester' => 'Subopen Semester',
            'subopen_year' => 'Subopen Year',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(ViewSubject::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

}

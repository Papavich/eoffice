<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "exam_subject".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property string $subject_namethai
 * @property string $subject_nameeng
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_subject';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_exam');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'subject_version'], 'required'],
            [['subject_version'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['subject_namethai', 'subject_nameeng'], 'string', 'max' => 100],
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
            'subject_namethai' => 'ชื่อวิชา',
            'subject_nameeng' => 'Subject Nameeng',
        ];
    }
}

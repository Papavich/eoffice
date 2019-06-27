<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "view_kku30_subject".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property string $subject_namethai
 * @property string $subject_nameeng
 * @property int $subject_credit
 * @property string $subject_time
 * @property string $subject_description
 * @property int $subject_status
 *
 * @property Kku30SubjectOpen[] $kku30SubjectOpens
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_kku30_subject';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'subject_version'], 'required'],
            [['subject_version', 'subject_credit', 'subject_status'], 'integer'],
            [['subject_description'], 'string'],
            [['subject_id'], 'string', 'max' => 10],
            [['subject_namethai', 'subject_nameeng'], 'string', 'max' => 100],
            [['subject_time'], 'string', 'max' => 6],
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
            'subject_status' => 'Subject Status',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectOpens()
    {
        return $this->hasMany(SubjectOpen::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }
}

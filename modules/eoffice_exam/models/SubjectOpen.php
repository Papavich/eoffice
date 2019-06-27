<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "exam_subject_open".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semster
 * @property int $subopen_year
 */
class SubjectOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_subject_open';
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
            [['subject_id', 'subject_version', 'subopen_semster', 'subopen_year'], 'required'],
            [['subject_version', 'subopen_semster', 'subopen_year'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['subject_id', 'subject_version', 'subopen_semster', 'subopen_year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'subopen_semster', 'subopen_year']],
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
            'subopen_semster' => 'Subopen Semster',
            'subopen_year' => 'Subopen Year',
        ];
    }

    public function getSubname()
    {
        return $this->hasOne(Subject::className(), ['subject_id' => 'subject_id']);
    }
}

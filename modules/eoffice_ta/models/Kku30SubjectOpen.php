<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "kku30_subject_open".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property int $subopen_semester
 * @property int $subopen_year
 *
 * @property Kku30Section[] $kku30Sections
 * @property Kku30Subject $subject
 */
class Kku30SubjectOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subject_open';
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
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'required'],
            [['subject_version', 'subopen_semester', 'subopen_year'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['subject_id', 'subject_version', 'subopen_semester', 'subopen_year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'subopen_semester', 'subopen_year']],
            [['subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
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
    public function getKku30Sections()
    {
        return $this->hasMany(Kku30Section::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version', 'subopen_semester' => 'subopen_semester', 'subopen_year' => 'subopen_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Kku30Subject::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    public static function getNowSemester()
    {
        return  Term::find()->orderBy(['year'=>SORT_DESC,'term_id'=>SORT_DESC])->one()->term_id;
    }
    public static function getRecentlyYearSemester()
    {
        return  Term::find()->orderBy(['year'=>SORT_DESC,'term_id'=>SORT_DESC])->all()[1];
    }

    public static function getNowYear()
    {
        return Year::find()->orderBy( ['year_id' => SORT_DESC] )->one()->id;
    }
}

<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_year_semester".
 *
 * @property int $year_id
 * @property int $semester_id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Project[] $eproProjects
 * @property Semester $semester
 * @property Year $year
 * @property OpenSubject[] $viewKku30OpenSubjects
 * @property SubjectView[] $subjects
 */
class YearSemester extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_year_semester';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_id', 'semester_id', ], 'required'],
            [['year_id', 'semester_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['year_id', 'semester_id'], 'unique', 'targetAttribute' => ['year_id', 'semester_id']],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semester::className(), 'targetAttribute' => ['semester_id' => 'id']],
            [['year_id'], 'exist', 'skipOnError' => true, 'targetClass' => Year::className(), 'targetAttribute' => ['year_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year_id' => controllers::t( 'label', 'Year' ),
            'semester_id' => controllers::t( 'label', 'Semester' ),
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['year_id' => 'year_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semester::className(), ['id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpenSubjects()
    {
        return $this->hasMany(OpenSubject::className(), ['year_id' => 'year_id', 'semester_id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(SubjectView::className(), ['id' => 'subject_id'])->viaTable('view_kku30_open_subject', ['year_id' => 'year_id', 'semester_id' => 'semester_id']);
    }
}

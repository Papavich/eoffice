<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "scb_progress".
 *
 * @property int $progress_seq
 * @property string $student_id
 * @property int $year
 * @property int $semester
 * @property string $progress_file
 * @property double $GPA_mid
 * @property double $GPA_final
 * @property double $GPA_sum
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbYearHasSemester $year0
 * @property ScbStudent $student
 * @property ScbProgressComment[] $scbProgressComments
 * @property ScbTeacherHasType[] $teacherIdCards
 */
class ScbProgress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */



    public $uploadFilesFolder = 'web_scb/uploads/progress';
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    public static function tableName()
    {
        return 'scb_progress';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['progress_seq', 'student_id', 'year', 'semester'], 'required'],
            [['progress_seq', 'year', 'semester', 'crby', 'udby','sum_result'], 'integer'],
            [['GPA_mid', 'GPA_final', 'GPA_sum'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['student_id'], 'string', 'max' => 11],
            [['progress_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,ppt,pptx'],
            [['progress_seq', 'student_id', 'year', 'semester'], 'unique', 'targetAttribute' => ['progress_seq', 'student_id', 'year', 'semester']],
            [['year', 'semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYearHasSemester::className(), 'targetAttribute' => ['year' => 'year', 'semester' => 'semester']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'progress_seq' => 'Progress Seq',
            'student_id' => 'Student ID',
            'year' => 'Year',
            'semester' => 'Semester',
            'progress_file' => 'Progress File',
            'GPA_mid' => 'Gpa Mid',
            'GPA_final' => 'Gpa Final',
            'GPA_sum' => 'Gpa Sum',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYearHasSemester::className(), ['year' => 'year', 'semester' => 'semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbProgressComments()
    {
        return $this->hasMany(ScbProgressComment::className(), ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'progress_year' => 'year', 'progress_semester' => 'semester']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCards()
    {
        return $this->hasMany(ScbTeacherHasType::className(), ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id'])->viaTable('scb_progress_comment', ['progress_seq' => 'progress_seq', 'student_id' => 'student_id', 'progress_year' => 'year', 'progress_semester' => 'semester']);
    }

    public function uploadFile()
    {
        if ($this->validate()) {
            if ($this->progress_file) {
                if ($this->isNewRecord) {
                    $fileName = $this->student_id . time() . '.' . $this->progress_file->extension;
                    //$fileName = iconv('UTF-8','WINDOWS-874',$this->scholarship_file).'.'.$this->extension;
                } else {
                    $fileName = $this->getOldAttribute('progress_file');
                }
                $this->progress_file->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadFilesFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('progress_file');
    }

    public function getFile()
    {
        return Yii::getAlias('@web') . $this->uploadFilesFolder . '/' . $this->progress_file;
    }

}

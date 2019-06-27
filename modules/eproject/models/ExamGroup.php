<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_exam_group".
 *
 * @property int $id
 * @property int $year_id
 * @property int $subject_id
 * @property int $semester_id
 * @property string $name
 * @property string $room
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property ExamCommittee[] $eproExamCommittees
 * @property User[] $users
 * @property OpenSubject $year
 */
class ExamGroup extends \yii\db\ActiveRecord
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
        return 'epro_exam_group';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get( 'db_eproject' );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_id', 'subject_id', 'semester_id', ], 'required'],
            [['year_id', 'semester_id', 'crby', 'udby'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['crtime', 'udtime'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['room'], 'string', 'max' => 10],
            [['year_id', 'subject_id', 'semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => OpenSubject::className(), 'targetAttribute' => ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_id' => 'Year ID',
            'subject_id' => 'Subject ID',
            'semester_id' => 'Semester ID',
            'name' => 'Name',
            'room' => 'Room',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamCommittees()
    {
        return $this->hasMany( ExamCommittee::className(), ['exam_group_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany( User::className(), ['id' => 'user_id'] )->viaTable( 'epro_exam_committee', ['exam_group_id' => 'id'] );
    }

    public function getProjectCount()
    {
//        $projectCount = ProjectExamGroup::find()
//            ->where( ['exam_group_id' => $this->id] )
//            ->andWhere( ['year_id' => $this->year_id] )
//            ->andWhere( ['semester_id' => $this->semester_id] )
//            ->andWhere( ['subject_id' => $this->subject_id] )
//            ->count();
        $userIds = ExamCommittee::find()
            ->where( ['exam_group_id' => $this->id] )
            ->select('user_id');
        $projectCount = Advise::find()->where( ['adviser_id' => $userIds] )
            ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
            ->andWhere( ['year_id' => $this->year_id] )
            ->andWhere( ['semester_id' => $this->semester_id] )
            ->andWhere( ['subject_id' => $this->subject_id] )->count();

        return $projectCount;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne( OpenSubject::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id'] );
    }
}

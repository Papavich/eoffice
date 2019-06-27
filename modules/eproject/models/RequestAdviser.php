<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_request_adviser".
 *
 * @property int $id
 * @property int $adviser_id
 * @property string $topic
 * @property string $detail
 * @property string $status
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 * @property string $comment
 *
 * @property StudentRequestAdviser[] $eproStudentRequestAdvisers
 * @property Enroll[] $students
 */
class RequestAdviser extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    const STATUS_PENDING = '0';
    const STATUS_APPROVED = '1';
    const STATUS_DISAPPROVED = '2';
    const STATUS_CANCELED = '3';
    const STATUS_WAITING = '4';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_request_adviser';
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
            [['adviser_id', 'topic', 'detail', 'status'], 'required'],
            [['adviser_id', 'crby', 'udby'], 'integer'],
            [['detail'], 'string'],
            [['crtime', 'udtime'], 'safe'],
            [['topic'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['comment'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic' => controllers::t( 'label', 'Topic/Your Interesting' ),
            'detail' => controllers::t( 'label', 'Students Aptitude' ),
            'adviser_id' => controllers::t( 'label', 'Adviser' ),
            'comment' => 'Comment',
            'status' => 'Status',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentRequestAdvisers()
    {
        return $this->hasMany(StudentRequestAdviser::className(), ['adviser_request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviser()
    {
        return $this->hasOne( User::className(), ['id' => 'adviser_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestAdviserXStudents()
    {
        return $this->hasMany( RequestAdviserXStudent::className(), ['adviser_request_id' => 'id'] );
    }

    public function getStudents()
    {
        return $this->hasMany( User::className(), ['id' => 'student_id'] )
            ->viaTable( StudentRequestAdviser::tableName(), ['adviser_request_id' => 'id'] );
    }


    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAvailableStudent()
    {
        $subQuery = StudentProject::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
            ->select( 'student_id' );

        $student_id = Enroll::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
            ->andWhere( ['not in', 'student_id', $subQuery] )
            ->all();
        foreach ($student_id as $item) {
            $tmp[] = $item->student_id;
        }
        $major = User::findOne( Yii::$app->user->identity->getId() )->major_id;
//        $branch= User::findOne( Yii::$app->user->identity->getId() )->branch_id; ไม่แยก ปก วิป
        return User::find()
            ->where( ['in', 'id', $tmp] )
//            ->andWhere(['<>','id',Yii::$app->user->identity->getId()])
//            ->andWhere(['branch_id'=>$branch])
            ->andWhere(['major_id'=>$major])
            ->all();
    }
    public static function getAvailableStudentWithoutMe()
    {
        $subQuery = StudentProject::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
            ->select( 'student_id' );

        $student_id = Enroll::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
            ->andWhere( ['not in', 'student_id', $subQuery] )
            ->all();
        foreach ($student_id as $item) {
            $tmp[] = $item->student_id;
        }


        $major = User::findOne( Yii::$app->user->identity->getId() )->major_id;
//        $branch= User::findOne( Yii::$app->user->identity->getId() )->branch_id; ไม่แยก ปก วิป
//        echo $student_id->createCommand()->sql;

        return User::find()
            ->where( ['in', 'id', $tmp] )
            ->andWhere( ['<>', 'id', Yii::$app->user->identity->getId()] )
//            ->andWhere(['branch_id'=>$branch])
            ->andWhere( ['major_id' => $major] )
            ->all();
    }
}

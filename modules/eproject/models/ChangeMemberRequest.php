<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_change_member_request".
 *
 * @property int $id ไม่ได้ มีหลาย request
 * @property int $project_id
 * @property string $reason
 * @property int $status
 * @property string $comment
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Project $project
 * @property StudentRequestMember[] $eproStudentRequestMembers
 */
class ChangeMemberRequest extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DISAPPROVED = 2;
    const STATUS_CANCELED = 3;
    const STATUS_WAITING = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_change_member_request';
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
            [['project_id', 'status'], 'required'],
            [['project_id', 'status', 'crby', 'udby'], 'integer'],
            [['reason'], 'string'],
            [['comment'], 'string', 'max' => 512],
            [['crtime', 'udtime'], 'safe'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'reason' => controllers::t( 'label', 'Reason' ),
            'status' => 'Status',
            'comment' => 'Comment',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    public static function getAvailableStudent()
    {
        $projectId = Project::findProjectId();
        $subStd = StudentProject::find()
            ->where( ['project_id' => $projectId] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->select( 'student_id' );

        $subQuery = StudentProject::find()
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
            ->andWhere( ['not in', 'student_id', $subStd] )
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
        return User::find()
            ->where( ['in', 'id', $tmp] )
            ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne( Project::className(), ['id' => 'project_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentRequestMembers()
    {
        return $this->hasMany( StudentRequestMember::className(), ['change_member_request_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany( User::className(), ['id' => 'student_id'] )->viaTable( StudentRequestMember::tableName(), ['change_member_request_id' => 'id'] );
    }
    public function getFrom()
    {
        $ids=StudentRequestMember::find()->where( ['change_member_request_id' => $this->id] )->andWhere( ['type' => 0] )->select( 'student_id' );
        $tmp = [];
        foreach (User::find()->where(['in','id',$ids])->all() as $item) {
            $tmp[] = $item->name;
        }
        return implode( ', ', $tmp );
    }

    public function getTo()
    {
        $ids=StudentRequestMember::find()->where( ['change_member_request_id' => $this->id] )->andWhere( ['type' => 1] )->select( 'student_id' );
        $tmp = [];
        foreach (User::find()->where(['in','id',$ids])->all() as $item) {
            $tmp[] = $item->name;
        }
        return implode( ', ', $tmp );
    }


}

<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $user_type_id
 * @property int $user_id
 * @property string $department_id
 * @property string $major_id
 * @property string $student_fname_th
 * @property string $student_lname_th
 * @property string $student_fname_en
 * @property string $student_lname_en
 * @property string $person_fname_th
 * @property string $person_fname_en
 * @property string $person_lname_th
 * @property string $person_lname_en
 * @property string $prefix_th
 * @property string $prefix_en
 */
class User extends \yii\db\ActiveRecord
{
    const TYPE_ADMIN = 3;
    const TYPE_TEACHER = 1;
    const TYPE_STUDENT = 0;
    const TYPE_VISITOR = 2;

    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_user';
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
            [['id', 'user_id'], 'integer'],
            [['username', 'email', 'user_type_id'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['user_type_id'], 'string', 'max' => 20],
            [['department_id', 'major_id', 'person_fname_th', 'person_fname_en', 'person_lname_th', 'person_lname_en', 'prefix_th', 'prefix_en'], 'string', 'max' => 50],
            [['student_fname_th', 'student_lname_th', 'student_fname_en', 'student_lname_en'], 'string', 'max' => 100],
            [['user_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'user_type_id' => 'User Type Type',
            'user_id' => 'User ID',
            'department_id' => 'Department ID',
            'major_id' => 'Major ID',
            'student_fname_th' => 'Student Fname Th',
            'student_lname_th' => 'Student Lname Th',
            'student_fname_en' => 'Student Fname En',
            'student_lname_en' => 'Student Lname En',
            'person_fname_th' => 'Person Fname Th',
            'person_fname_en' => 'Person Fname Eng',
            'person_lname_th' => 'Person Lname Th',
            'person_lname_en' => 'Person Lname Eng',
            'prefix_th' => 'Prefix Th',
            'prefix_en' => 'Prefix En',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviserBroadcasts()
    {
        return $this->hasMany( AdviserBroadcast::className(), ['adviser_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeAdviserRequests()
    {
        return $this->hasMany( ChangeAdviserRequest::className(), ['from' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeAdviserRequests0()
    {
        return $this->hasMany( ChangeAdviserRequest::className(), ['to' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolls()
    {
        return $this->hasMany( Enroll::className(), ['student_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYears()
    {
        return $this->hasMany( OpenSubject::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id'] )->viaTable( 'epro_enroll', ['student_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamCommittees()
    {
        return $this->hasMany( ExamCommittee::className(), ['user_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamGroups()
    {
        return $this->hasMany( ExamGroup::className(), ['id' => 'exam_group_id', 'year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id'] )->viaTable( 'epro_exam_committee', ['user_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestAdvisees()
    {
        return $this->hasMany( RequestAdvisee::className(), ['adviser_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYears0()
    {
        return $this->hasMany( OpenSubject::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id'] )->viaTable( 'epro_request_advisee', ['adviser_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestAdvisers()
    {
        return $this->hasMany( RequestAdviser::className(), ['adviser_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne( UserType::className(), ['id' => 'user_type_id'] );
    }

    public function getChangeTopicRequests()
    {
        return $this->hasMany( ChangeTopicRequest::className(), ['project_id' => 'project_id'] )
            ->viaTable( Advise::tableName(), ['adviser_id' => 'id'] )
            ->onCondition( ['or', [ChangeTopicRequest::tableName() . '.status' => ChangeTopicRequest::STATUS_PENDING], [ChangeTopicRequest::tableName() . '.status' => ChangeTopicRequest::STATUS_WAITING]] );
    }

    public function getChangeMemberRequests()
    {
        return $this->hasMany( ChangeMemberRequest::className(), ['project_id' => 'project_id'] )
            ->viaTable( Advise::tableName(), ['adviser_id' => 'id'] )
            ->onCondition( ['or', [ChangeMemberRequest::tableName() . '.status' => ChangeMemberRequest::STATUS_PENDING], [ChangeMemberRequest::tableName() . '.status' => ChangeMemberRequest::STATUS_WAITING]] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserXExamGroups()
    {
        return $this->hasMany( UserXExamGroup::className(), ['user_id' => 'id'] );
    }

    public function getName()
    {
        //return \app\models\User::findOne( $this->id )->username;
//        if ($this->user_type_id == self::TYPE_ADMIN) {
//            return "Sirirat Tintanai" . $this->id;
//        } else if ($this->user_type_id == self::TYPE_TEACHER) {
//            return "Nunnapus Moungmingsuk" . $this->id;
//        } else if ($this->user_type_id == self::TYPE_VISITOR) {
//            return "External Adviser" . $this->id;
//        }
//        else {
//            return "Komkeao Tangprasert" . $this->id;
//        }

        $userType = AuthHelper::getUserType();
        if (Yii::$app->language == "en") {
            if ($userType == User::TYPE_TEACHER) {
                if ($this->user_type_id == self::TYPE_STUDENT) {
                    return "<a href='" . Yii::getAlias( "@web/eproject/student/view" ) . "?id=" . $this->id . "'>" . $this->student_fname_en . " " . $this->student_lname_en . "</a>";
                } else if ($this->user_type_id == self::TYPE_TEACHER) {
                    return $this->academic_positions_abb . $this->person_fname_en . " " . $this->person_lname_en;
                } else {
                    return $this->person_fname_en . " " . $this->person_lname_en;
                }
            } else {
                if ($this->user_type_id == self::TYPE_STUDENT) {
                    return $this->student_fname_en . " " . $this->student_lname_en;
                } else if ($this->user_type_id == self::TYPE_TEACHER) {
                    return $this->academic_positions_abb . $this->person_fname_en . " " . $this->person_lname_en;
                } else {
                    return $this->person_fname_en . " " . $this->person_lname_en;
                }
            }

        } else {
            if ($userType == User::TYPE_TEACHER) {
                if ($this->user_type_id == self::TYPE_STUDENT) {
                    return "<a href='" . Yii::getAlias( "@web/eproject/student/view" ) . "?id=" . $this->id . "'>" . $this->student_fname_th . " " . $this->student_lname_th . "</a>";
                } else if ($this->user_type_id == self::TYPE_TEACHER) {
                    return $this->academic_positions_abb_thai . $this->person_fname_th . " " . $this->person_lname_th;
                } else {
                    return $this->person_fname_th . " " . $this->person_lname_th;
                }
            } else {
                if ($this->user_type_id == self::TYPE_STUDENT) {
                    return $this->student_fname_th . " " . $this->student_lname_th;
                } else if ($this->user_type_id == self::TYPE_TEACHER) {
                    return $this->academic_positions_abb_thai . $this->person_fname_th . " " . $this->person_lname_th;
                } else {
                    return $this->person_fname_th . " " . $this->person_lname_th;
                }
            }
        }


    }

    public function getCurrentRequestAdvisee()
    {
        return RequestAdvisee::find()
            ->where( ['adviser_id' => $this->id] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentEnroll()
    {
        return $this->hasMany( Enroll::className(), ['student_id' => 'id'] )
            ->onCondition( [] )
            ->andOnCondition( [] );
    }

    public function getMajor()
    {
        if ($major = Major::findOne( $this->major_id )) {
            return $major;
        } else {
            $major = new Major();
            $major->id = 0;
            $major->name_en = "Undefined";
            $major->name_th = "ไม่ได้ระบุ";
            $major->code = "N/A";
            return $major;
        }
    }

    public function getWorkLoad()
    {
        $arr['total'] = 0;
        foreach (Major::find()->all() as $major) {
            $tmp = Advise::find()
                ->innerJoin( Project::tableName(), Project::tableName() . '.id = ' . Advise::tableName() . '.project_id' )
                ->where( ['adviser_id' => $this->id] )
                ->andWhere( [Advise::tableName().'.year_id' => ModelHelper::getNowYear()] )
                ->andWhere( [Advise::tableName().'.semester_id' => ModelHelper::getNowSemester()] )
                ->andWhere( ['major_id' => $major->id] )
                ->count();
            $arr['total'] += $tmp;
            $arr['data'][$major->code] = $tmp;
        }
        return $arr;
    }

    public function getAdviseStatus($subjectId){
        $data= [];
        if(Advise::find()
            ->innerJoin(StudentProject::tableName(),StudentProject::tableName().'.project_id = '.Advise::tableName().'.project_id')
        ->where(['student_id'=>$this->id])
        ->andWhere([StudentProject::tableName().'.year_id'=>ModelHelper::getNowYear()])
        ->andWhere([StudentProject::tableName().'.semester_id'=>ModelHelper::getNowSemester()])
        ->andWhere([StudentProject::tableName().'.subject_id'=>$subjectId])
            ->one()
        ){
            $data['status'] = 'yes';
        }else if(RequestAdviser::find()
            ->innerJoin(StudentRequestAdviser::tableName(),StudentRequestAdviser::tableName().'.adviser_request_id = '.RequestAdviser::tableName().'.id')
            ->where(['student_id'=>$this->id])
            ->andWhere(['year_id'=>ModelHelper::getNowYear()])
            ->andWhere(['semester_id'=>ModelHelper::getNowSemester()])
            ->andWhere(['subject_id'=>ModelHelper::getNowSubject($this->id)])
            ->andWhere(['or',
                ['status'=>RequestAdviser::STATUS_PENDING],
                ['status'=>RequestAdviser::STATUS_WAITING]
            ])->one()
        ){
            $data['status'] = 'pending';
        }else{
            $data['status'] = 'no';
        }
        return $data;
    }
}

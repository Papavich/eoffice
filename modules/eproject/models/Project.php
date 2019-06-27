<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "epro_project".
 *
 * @property int $id
 * @property int $year_id
 * @property int $semester_id
 * @property int $major_id
 * @property int $number
 * @property string $name_th
 * @property string $name_en
 * @property string $image
 * @property string $abstract
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Advise[] $eproAdvises
 * @property ChangeAdviserRequest[] $ChangeAdviserRequests
 * @property ChangeTopicRequest[] $ChangeTopicRequests
 * @property Major $major
 * @property YearSemester $year
 * @property ProjectDocument[] $ProjectDocuments
 * @property ProjectTheory[] $ProjectTheories
 * @property Theory[] $theories
 * @property ProjectTool[] $ProjectTools
 * @property Tool[] $tools
 * @property ProjectXProjectType[] $ProjectXProjectTypes
 * @property ProjectType[] $projectTypes
 * @property PublicDocument[] $PublicDocuments
 * @property StudentProject[] $StudentProjects
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    const UPLOAD_FOLDER = 'web_eproject/uploads/project_images'; //ที่เก็บรูปภาพ

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_project';
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
            [['year_id', 'semester_id', 'major_id', 'number', 'crby', 'udby'], 'integer'],
            [['major_id',], 'required'],
            [['abstract'], 'string'],
            ['image', 'file', 'maxSize' => 1024 * 1024 * 50, 'extensions' => ['png', 'jpg','gif','jpeg'], 'checkExtensionByMimeType' => false],
            [['crtime', 'udtime'], 'safe'],
            [['name_th', 'name_en',], 'string', 'max' => 255],
            [['major_id'], 'exist', 'skipOnError' => true, 'targetClass' => Major::className(), 'targetAttribute' => ['major_id' => 'id']],
            [['year_id', 'semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => YearSemester::className(), 'targetAttribute' => ['year_id' => 'year_id', 'semester_id' => 'semester_id']],
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
            'semester_id' => 'Semester ID',
            'major_id' => 'Major ID',
            'number' => 'Number',
            'name_th' => controllers::t( 'label', 'Project Name (Thai)' ),
            'name_en' => controllers::t( 'label', 'Project Name (English)' ),
            'image' => 'Image',
            'abstract' => controllers::t( 'label', 'Abstract' ),
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvises()
    {
        if($tmp=Advise::find()->where(['project_id'=>$this->id])
            ->orderBy(['year_id'=>SORT_DESC, 'semester_id' => SORT_DESC,
            ])->one()){
            $year=$tmp->year_id;
            $semester=$tmp->semester_id;
            return $this->hasMany( Advise::className(), ['project_id' => 'id'] )
                ->onCondition(['year_id'=>$year,'semester_id'=>$semester]);
        }else{
            return $this->hasMany( Advise::className(), ['project_id' => 'id'] );
        }

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeAdviserRequests()
    {
        return $this->hasMany( ChangeAdviserRequest::className(), ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeTopicRequests()
    {
        return $this->hasMany( ChangeTopicRequest::className(), ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajor()
    {
        return $this->hasOne( Major::className(), ['id' => 'major_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne( YearSemester::className(), ['year_id' => 'year_id', 'semester_id' => 'semester_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectDocuments()
    {
        return $this->hasMany( ProjectDocument::className(), ['project_id' => 'id'] );
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamGroup($year, $semester, $subject)
    {
        $examGroupId = Advise::find()
            ->innerJoin( ExamCommittee::tableName(), ExamCommittee::tableName() . '.user_id= ' . Advise::tableName() . '.adviser_id' )
            ->where( ['project_id' => $this->id] )
            ->andWhere( [ExamCommittee::tableName() . '.year_id' => $year] )
            ->andWhere( [ExamCommittee::tableName() . '.semester_id' => $semester] )
            ->andWhere( [ExamCommittee::tableName() . '.subject_id' => $subject] )
            ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
            ->select( 'exam_group_id' );

        if ($examGroupId) {
            return ExamGroup::findOne( $examGroupId );
        } else {
            return false;
        }

    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTheories()
    {
        return $this->hasMany( ProjectTheory::className(), ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheories()
    {
        return $this->hasMany( Theory::className(), ['id' => 'theory_id'] )->viaTable( 'epro_project_theory', ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTools()
    {
        return $this->hasMany( ProjectTool::className(), ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTools()
    {
        return $this->hasMany( Tool::className(), ['id' => 'tool_id'] )->viaTable( 'epro_project_tool', ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectXProjectTypes()
    {
        return $this->hasMany( ProjectXProjectType::className(), ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTypes()
    {
        return $this->hasMany( ProjectType::className(), ['id' => 'project_type_id'] )->viaTable( 'epro_project_x_project_type', ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicDocuments()
    {
        return $this->hasMany( PublicDocument::className(), ['project_id' => 'id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentProjects()
    {
        return $this->hasMany( StudentProject::className(), ['project_id' => 'id'] );
    }

    /**
     * @param int|string $userId
     * @return int|mixed
     */
    public static function findProjectIds($userId = true)
    {
        if ($userId === true) {
            $userId = Yii::$app->user->identity->getId();
        }
        if (StudentProject::find()
            ->where( ['student_id' => $userId] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->one()) {
            return StudentProject::find()
                ->where( ['student_id' => $userId] )
                ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->one()->project_id;
        } else {
            return false;
        }
    }

    /**
     * @param int|string $userId
     * @return int|mixed
     */
    public static function findProjectId($userId = true)
    {

        if ($userId === true) {
            $userId = Yii::$app->user->identity->getId();
        }
        if (StudentProject::find()
            ->where( ['student_id' => $userId] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->one()) {
            return StudentProject::find()
                ->where( ['student_id' => $userId] )
                ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )->one()->project_id;
        } else {
            return false;
        }
    }

    public function getCoAdvisers()
    {
        return $this->hasMany( User::className(), ['id' => 'adviser_id'] )
            ->viaTable( Advise::tableName(), ['project_id' => 'id'], function ($query) {
                /* @var $query \yii\db\ActiveQuery */
                $query->andWhere( ['adviser_type_id' => 2] );
            } );

//        return ProjectXAdviser::find()->where( ['project_id' => $this->id] )->andWhere(['type_id'=>2])->all();
    }

    public function getExternalAdvisers()
    {
        return $this->hasMany( User::className(), ['id' => 'adviser_id'] )
            ->viaTable( Advise::tableName(), ['project_id' => 'id'], function ($query) {
                /* @var $query \yii\db\ActiveQuery */
                $query->andWhere( ['adviser_type_id' => 3] );
            } );

//        return ProjectXAdviser::find()->where( ['project_id' => $this->id] )->andWhere(['type_id'=>2])->all();
    }

    public function getAdvisers()
    {
        return $this->hasMany( User::className(), ['id' => 'adviser_id'] )
            ->viaTable( Advise::tableName(), ['project_id' => 'id'] );
    }
    public function getName()
    {
        if (Yii::$app->language == "th") {
            return $this->name_th;
        } else {
            return $this->name_en;
        }

    }
    public function getMainAdviser()
    {
        return $this->hasOne( User::className(), ['id' => 'adviser_id'] )
            ->viaTable( Advise::tableName(), ['project_id' => 'id'], function ($query) {
                /* @var $query \yii\db\ActiveQuery */
                $query->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] );
            } );
    }

    public function getAvailableCoAdviser()
    {
        $subQuery = Advise::find()
            ->where( ['project_id' => $this->id] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
            ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
            ->select( 'adviser_id' );
        return User::find()
            ->where( ['not in', 'id', $subQuery] )
            ->andWhere( [User::tableName() . '.user_type_id' => 1] )
            ->all();
//        return User::find()
//            ->join('left outer join', Advise::tableName(), Advise::tableName() . '.adviser_id =' . User::tableName() . '.id ' )
//            ->where( [User::tableName() . '.user_type_id' => 1] )
//            ->andWhere( [Advise::tableName().'.project_id' => $this->id] )
//            ->andWhere( [Advise::tableName() . '.year_id' => ModelHelper::getNowYear()] )
//            ->andWhere( [Advise::tableName() . '.semester_id' => ModelHelper::getNowSemester()] )
//            ->andWhere( [Advise::tableName() . '.subject_id' => ModelHelper::getSubjectId()] )
//            ->andWhere([Advise::tableName().'adviser_type_id'=>AdviserType::TYPE_PRIMARY_ADVISER])
//            ->andWhere( Advise::tableName() . '.project_id is null' )
//            ->all();
//
//        return $this->hasMany( User::className(), ['id' => 'adviser_id'] )
//            ->viaTable( Advise::tableName(), ['project_id' => 'id'], function ($query) {
//                /* @var $query \yii\db\ActiveQuery */
//                $query->andWhere( ['adviser_type_id' => 3] );
//            } );
    }

    public function getStudents()
    {
        return $this->hasMany( User::className(), ['id' => 'student_id'] )
            ->viaTable( StudentProject::tableName(), ['project_id' => 'id'] );
    }

    public function getCurrentStudents()
    {
        return $this->hasMany( User::className(), ['id' => 'student_id'] )
            ->viaTable( StudentProject::tableName(), ['project_id' => 'id'], function ($query) {
                /* @var $query \yii\db\ActiveQuery */
                $query->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] );
            } );
    }

    public function uploadFile()
    {

        if ($this->validate()) {

            if ($this->image) {
                if ($this->isNewRecord || $this->getOldAttribute( 'image' ) == "") {//ถ้าเป็นการเพิ่มใหม่ ให้ตั้งชื่อไฟล์ใหม่

                    $fileName = substr( md5( rand( 1, 1000 ) . time() ), 0, 10 ) . date( 'YmdHi' ) . '.' . $this->image->extension;//เลือกมา 15 อักษร .นามสกุล

                } else {//ถ้าเป็นการ update ให้ใช้ชื่อเดิม
                    $fileName = $this->getOldAttribute( 'image' );
                }
                $this->image->saveAs( Yii::getAlias( '@webroot' ) . '/' . self::UPLOAD_FOLDER . '/' . $fileName );
                return $fileName;
            }//end file upload
        } else {
            $errors = $this->getErrors();
            var_dump( $errors ); //or print_r($errors)
            exit;
        }
        return $this->isNewRecord ? false : $this->getOldAttribute( 'image' ); //ถ้าไม่มีการ upload ให้ใช้ข้อมูลเดิม
    }

    public static function getUploadPath()
    {
        return Yii::getAlias( '@webroot' ) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl()
    {
        return Url::base( true ) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function getFilePath()
    {
        return self::UPLOAD_FOLDER . '/' . $this->image;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateElastic();
//        parent::afterSave( $insert, $changedAttributes );
    }

    public function updateElastic()
    {
        if (ElasticProject::get( $this->id )) {
            $model = ElasticProject::get( $this->id );
            if ($this->name_th != "") {
                $model->activated = true; //เป็นการอัพเดตข้อมูล
            }
        } else {
            $model = new ElasticProject();
            $model->primaryKey = $this->id;
            $model->activated = false;
        }
        $model->name_th = $this->name_th;
        $model->name_en = $this->name_en;
        $model->theory = $this->retrieveProjectTheory();
        $model->tool = $this->retrieveProjectTool();
        $model->detail = $this->abstract;
        $model->owner = $this->retrieveOwner();
        $model->major = $this->major_id;
        $model->semester = $this->semester_id;
        $model->year = $this->year_id;
        $model->type = $this->retrieveProjectType();
        $model->adviser = $this->retrieveAdviser();
        $model->save();
    }

    /**
     * @return string
     */
    public function retrieveProjectTheory()
    {
        $data = "";
        foreach ($this->theories as $item) {
            $data .= $item->name . " ";
        }
        return $data;
    }

    public function retrieveProjectTool()
    {
        $data = "";
        foreach ($this->tools as $item) {
            $data .= $item->name . " ";
        }
        return $data;
    }

    public function retrieveOwner()
    {
        $data = "";
        foreach ($this->students as $item) {
            $data .= $item->name . " ";
        }
        return $data;
    }

    public function retrieveProjectType()
    {
        $data = [];
        foreach ($this->projectTypes as $item) {
            $data[] = $item->id;
        }
        return $data;
    }

    public function retrieveAdviser()
    {
        $data = [];
        foreach ($this->advisers as $item) {
            $data[] = $item->id;
        }
        return $data;
    }

    public function getSubject()
    {
        return StudentProject::find()->where( ['project_id' => $this->id] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->one()->subject_id;
    }
    public function getSubjectOld()
    {
        return StudentProject::find()->where( ['project_id' => $this->id] )
            ->andWhere( ['semester_id' => $this->semester_id] )
            ->andWhere( ['year_id' => $this->year_id] )
            ->one()->subject_id;
    }

    public function getSubjectName()
    {
        $subjectId = StudentProject::find()->where( ['project_id' => $this->id] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
            ->one()->subject_id;

        return Subject::findOne( $subjectId )->name;
    }

    public function getCurrentUnsentDocument()
    {
        return SubjectDocumentType::find()
            ->leftJoin( ProjectDocument::tableName()
                , SubjectDocumentType::tableName() . '.document_type_id=' . ProjectDocument::tableName()
                . '.document_type_id
                         AND ' . ProjectDocument::tableName() . '.project_id = ' . $this->id )
            ->where( ['subject_id' => self::getSubject()] )
            ->andWhere( ProjectDocument::tableName() . '.project_id is null' )
            ->all();
    }

    public function getUnsentDocument()
    {
        return SubjectDocumentType::find()
            ->leftJoin( ProjectDocument::tableName()
                , SubjectDocumentType::tableName() . '.document_type_id=' . ProjectDocument::tableName()
                . '.document_type_id
                         AND ' . ProjectDocument::tableName() . '.project_id = ' . $this->id )
            ->where( ['subject_id' => self::getSubjectOld()] )
            ->andWhere( ProjectDocument::tableName() . '.project_id is null' )
            ->all();
    }

    /**
     *
     */
    public function getProjectNumber()
    {
        if ($this->number == "" || $this->number == null) {
            return $this->major->code . ' - ' . $this->number . '/' . $this->year_id;
        } else {
            return $this->major->code . '' . $this->number . '/' . $this->year_id;
        }

    }
    public function getProjectCode()
    {
        if ($this->number == "" || $this->number == null) {
            return $this->major->code . ' - ' . $this->number;
        } else {
            return $this->major->code . '' . $this->number ;
        }

    }
}

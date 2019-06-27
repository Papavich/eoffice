<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 4/7/2560
 * Time: 9:53
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\ChangeAdviserRequest;
use app\modules\eproject\models\ChangeMemberRequest;
use app\modules\eproject\models\ChangeTopicRequest;
use app\modules\eproject\models\ElasticProject;
use app\modules\eproject\models\ElasticTheory;
use app\modules\eproject\models\ElasticTool;
use app\modules\eproject\models\ExternalAdviser;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\ProjectDocument;
use app\modules\eproject\models\ProjectPublic;
use app\modules\eproject\models\ProjectTheory;
use app\modules\eproject\models\ProjectTool;
use app\modules\eproject\models\ProjectType;
use app\modules\eproject\models\ProjectXProjectType;
use app\modules\eproject\models\PublicDocument;
use app\modules\eproject\models\PublicXDocument;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\StudentRequestMember;
use app\modules\eproject\models\Theory;
use app\modules\eproject\models\Tool;
use Yii;
use yii\base\Exception;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProjectController extends Controller
{
    //Constant
    const KEYWORD = 1;
    const PROJECT_NAME = self::SECOUNDARY_ADVISER_TYPE;
    const OWNER = 3;
    const SECOUNDARY_ADVISER_TYPE = 2;
    const FILE_TYPE_URL = 5;
    const IS_NOT_PUBLIC_DOCUMENT = 0;

    /**
     * @return string
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $searchBy = $request->get( 'search_by' );
        $keyword = $request->get( 'keyword' );
        $branch = $request->get( 'branch' );
        $semester = $request->get( 'semester' );
        $year = $request->get( 'year' );
        $type = $request->get( 'type' );
        $teacher = $request->get( 'teacher' );
        //ข้อมูลเอาไปใช้แสดง Input search ที่่เคยกรอก
        $searchData = [
            'keyword' => $keyword,
            'search_by' => $searchBy,
            'branch' => $branch,
            'semester' => $semester,
            'year' => $year,
            'type' => $type,
            'teacher' => $teacher
        ];
//        var_dump( $request->get( 'keyword' ) );
//        exit();
        $filter[] = [
            'terms' => ['activated' => [true]]
        ];
        if ($request->get( 'keyword' ) !== null) {

            $fields = $this->assignSearchFields( $searchBy );
            if ($branch != 0) {
                $filter[] = [
                    'terms' => ['major' => [(int)$branch]]
                ];
            }
            if ($semester != 0) {
                $filter[] = [
                    'terms' => ['semester' => [(int)$semester]]
                ];
            }
            if ($year != 9999) {
                $filter[] = [
                    'terms' => ['year' => [(int)$year]]
                ];
            }
            if ($type != null) {

                foreach ($type as $item) {
                    $tmp[] = (int)$item;
                }
                $filter[] = [
                    'terms' => ['type' => $tmp]
                ];
            }
            if ($teacher != null) {
                $tmp = [];
                foreach ($teacher as $item) {

                    $tmp[] = (int)$item;
                }
                $filter[] = [
                    'terms' => ['adviser' => $tmp]
                ];
            }

            $raw = [
                "bool" => [
                    (trim( $keyword ) == "") ? 'should' : 'must' => [
                        'multi_match' => [
                            'query' => $keyword,
                            'fields' => $fields
                        ]
                    ],
                    'filter' => [
                        'bool' => [
                            'must' => [
                                $filter
                            ],


                        ]
                    ]
                ]
            ];
            if (trim( $keyword ) == "") {
                $query = ElasticProject::find()->query( $raw );
            } else {

                $query = ElasticProject::find()->query( $raw )->minScore( 20 );
            }


        } else {
            $raw = [
                "bool" => [
                    'filter' => [
                        'bool' => [
                            'must' => [
                                $filter
                            ],

                        ]
                    ]
                ]
            ];
//            $query = ElasticProject::find()->query( $raw )->orderBy( ['year' => SORT_DESC] );
            $query = ElasticProject::find()->query( $raw );
        }
        $countQuery = clone $query;
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 5] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $projectIds = [];
        foreach ($models as $item) {
            $projectIds[] = $item->project_id;
        }
        $projectData = Project::find()->where( ['id' => $projectIds] )->all();
        $projectData = array_reverse( $projectData );
        return $this->render( 'index', [
            'searchData' => $searchData,
            'projectData' => $projectData,
            'pages' => $pages
        ] );
    }

    public function actionUpdate()
    {
        if (Yii::$app->request->isGet) {
            $projectId = Yii::$app->request->get( 'id' );
            $projectModel = Project::findOne( $projectId );
            return $this->render( 'update', [
                'model' => $projectModel,
            ] );


        } else {
            $projectId = Yii::$app->request->post( 'id' );
            $projectModel = Project::findOne( $projectId );
            if ($projectModel->load( Yii::$app->request->post() )) {
                try {
                    $projectModel->image = UploadedFile::getInstance( $projectModel, 'image' );

                    $projectModel->image = $projectModel->uploadFile(); //method return ชื่อไฟล์
                    $projectModel->save();//บันทึกข้อมูล

                    $this->deleteCasecadeUpdate( $projectModel->id );
                    Project::findOne( $projectId )->updateElastic();
                    Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                    return $this->redirect( ['update?id='.$projectModel->id] );
                } catch (Exception $e) {

                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                    return $this->redirect( ['update'] );
                }
            }

        }

    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isGet) {
            $projectId = Project::findProjectId();
            if ($projectId && Advise::find()
                    ->where( ['project_id' => $projectId] )
                    ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                    ->one()) {
                $projectModel = Project::findOne( $projectId );
                return $this->render( 'create', [
                    'model' => $projectModel,
                ] );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'You Not Have Adviser' ) );
                return $this->redirect( '../adviser/request' );
            }

        } else {
            $projectId = Project::findProjectId();
            $projectModel = Project::findOne( $projectId );
            if ($projectModel->load( Yii::$app->request->post() )) {
                try {
                    $projectModel->image = UploadedFile::getInstance( $projectModel, 'image' );

                    $projectModel->image = $projectModel->uploadFile(); //method return ชื่อไฟล์
                    $projectModel->save();//บันทึกข้อมูล

                    $this->deleteCasecade( $projectModel->id );
                    Project::findOne( $projectId )->updateElastic();
                    Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                    return $this->redirect( ['create'] );
                } catch (Exception $e) {

                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                    return $this->redirect( ['create'] );
                }
            }

        }

    }

    /**
     * @return string
     */
    public function actionUnsentProjectStd()
    {
        return $this->render( 'unsent-project-std' );
    }

    /**
     * @return string
     */
    public function actionUnsentDocumentStd()
    {
        $subject = Yii::$app->request->get( 'subject' );

        if ($subject == NULL) {
            $subject = 0;
        }
        $query = Project::find()
            ->innerJoin( StudentProject::tableName(), Project::tableName() . '.id = ' . StudentProject::tableName() . '.project_id')
            ->where([StudentProject::tableName().'.year_id'=>ModelHelper::getNowYear()])
            ->andWhere([StudentProject::tableName().'.semester_id'=>ModelHelper::getNowSemester()]);
        if($subject != 0){
            $query->andWhere([StudentProject::tableName().'.subject_id'=>$subject]);
        }
        $query->orderBy( [StudentProject::tableName().'.subject_id'=>SORT_ASC,'number'=>SORT_ASC]);
        return $this->render( 'unsent-document-std',
            ['oldData' => $subject,
                'projects' => $query->all()] );
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionChangeTopic()
    {
        $model = new ChangeTopicRequest();
        if (Yii::$app->request->isGet) {
            $projectId = Project::findProjectId();
            if ($projectId && Advise::find()
                    ->where( ['project_id' => $projectId] )
                    ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                    ->one()) {
                if (ChangeTopicRequest::find()->where( ['project_id' => Project::findProjectId()] )->andWhere( ['status' => ChangeTopicRequest::STATUS_PENDING] )->one()) {
                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Your Requesting is Processing' ) );
                    return $this->redirect( ['requesting/out'] );
                } else {
                    return $this->render( 'change-topic', [
                        'model' => $model,
                        'project' => Project::findOne( Project::findProjectId() )
                    ] );
                }

            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'You Not Have Adviser' ) );
                return $this->redirect( Yii::$app->request->referrer );
            }

        } else {
            if ($model->load( Yii::$app->request->post() )) {
                $project = Project::findOne( Project::findProjectId() );
                $model->status = ChangeTopicRequest::STATUS_PENDING;
                $model->project_id = $project->id;
                $model->pro_name_en_old = $project->name_en;
                $model->pro_name_th_old = $project->name_th;
                $model->save();
                Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
            }
            return $this->redirect( ['requesting/out'] );

        }

    }

    /**
     * @return string
     */
    public function actionView($id)
    {
        $model = Project::findOne( $id );
        $data = $this->prepareDocumentData( $id );
        $public = ProjectPublic::find()->where( ['project_id' => $id] )->all();
        return $this->render( 'view', [
            'model' => $model,
            'data' => $data,
            'public' => $public
        ] );
    }

    public function prepareDocumentData($id)
    {
        $data['proposal'] = $this->getDocumentData( 1, $id );
        $data['progress1'] = $this->getDocumentData( 2, $id );
        $data['progress2'] = $this->getDocumentData( 3, $id );
        $data['final'] = $this->getDocumentData( 4, $id );
        $data['userManual'] = $this->getDocumentData( self::FILE_TYPE_URL, $id );
        $data['poster'] = $this->getDocumentData( 6, $id );
        $data['abstract'] = $this->getDocumentData( 7, $id );
        return $data;
    }

    private function getDocumentData($type, $id)
    {
        return ProjectDocument::find()->where( ['project_id' => $id] )
            ->andWhere( ['document_type_id' => $type] )
            ->all();
    }

    /**
     * @return array|null|\yii\db\ActiveRecord
     */
    private function findExternalAdviser()
    {
        return ExternalAdviser::find()->where( ['project_id' => Project::findProjectId()] )->one();
    }


    /**
     * @param $projectModel
     */
    public function deleteCasecade($id)
    {
        ProjectTool::deleteAll( ['project_id' => $id] );
        ProjectTheory::deleteAll( ['project_id' => $id] );
        ProjectXProjectType::deleteAll( ['project_id' => $id] );
        Advise::deleteAll( ['project_id' => $id, 'adviser_type_id' => [2, 3]] );
        if (Yii::$app->request->post( 'Project' )['tools']) {
            foreach (Yii::$app->request->post( 'Project' )['tools'] as $item) {
                if (!is_numeric( $item )) {
                    $projectType = new Tool();
                    $projectType->name = $item;
                    $projectType->save();
                    $item = $projectType->id;
                }
                $relationModel = new ProjectTool();
                $relationModel->tool_id = $item;
                $relationModel->project_id = $id;
                $relationModel->save();
            }
        }
        if (Yii::$app->request->post( 'Project' )['theories']) {
            foreach (Yii::$app->request->post( 'Project' )['theories'] as $item) {
                if (!is_numeric( $item )) {
                    $projectType = new Theory();
                    $projectType->name = $item;
                    $projectType->save();
                    $item = $projectType->id;
                }
                $relationModel = new ProjectTheory();
                $relationModel->theory_id = $item;
                $relationModel->project_id = $id;
                $relationModel->save();
            }
        }
        if (Yii::$app->request->post( 'Project' )['projectTypes']) {
            foreach (Yii::$app->request->post( 'Project' )['projectTypes'] as $item) {
                if (!is_numeric( $item )) {
                    $projectType = new ProjectType();
                    $projectType->name = $item;
                    $projectType->save();
                    $item = $projectType->id;
                }
                $relationModel = new ProjectXProjectType();
                $relationModel->project_type_id = $item;
                $relationModel->project_id = $id;
                $relationModel->save();
            }
        }
        if (Yii::$app->request->post( 'Project' )['coAdvisers']) {
            foreach (Yii::$app->request->post( 'Project' )['coAdvisers'] as $item) {
                $relationModel = new Advise();
                $relationModel->adviser_id = $item;
                $relationModel->project_id = $id;
                $relationModel->year_id = ModelHelper::getNowYear();
                $relationModel->semester_id = ModelHelper::getNowSemester();
                $relationModel->subject_id = ModelHelper::getSubjectId();
                $relationModel->adviser_type_id = AdviserType::TYPE_SECONDARY_ADVISER;
                $relationModel->save();
            }
        }
        if (Yii::$app->request->post( 'Project' )['externalAdvisers']) {
            foreach (Yii::$app->request->post( 'Project' )['externalAdvisers'] as $item) {
                $relationModel = new Advise();
                $relationModel->adviser_id = $item;
                $relationModel->project_id = $id;
                $relationModel->year_id = ModelHelper::getNowYear();
                $relationModel->semester_id = ModelHelper::getNowSemester();
                $relationModel->subject_id = ModelHelper::getSubjectId();
                $relationModel->adviser_type_id = AdviserType::TYPE_EXTERNAL_ADVISER;
                $relationModel->save();
            }
        }

    }
    /**
     * @param $projectModel
     */
    public function deleteCasecadeUpdate($id)
    {
        ProjectTool::deleteAll( ['project_id' => $id] );
        ProjectTheory::deleteAll( ['project_id' => $id] );
        ProjectXProjectType::deleteAll( ['project_id' => $id] );
       if (Yii::$app->request->post( 'Project' )['tools']) {
            foreach (Yii::$app->request->post( 'Project' )['tools'] as $item) {
                if (!is_numeric( $item )) {
                    $projectType = new Tool();
                    $projectType->name = $item;
                    $projectType->save();
                    $item = $projectType->id;
                }
                $relationModel = new ProjectTool();
                $relationModel->tool_id = $item;
                $relationModel->project_id = $id;
                $relationModel->save();
            }
        }
        if (Yii::$app->request->post( 'Project' )['theories']) {
            foreach (Yii::$app->request->post( 'Project' )['theories'] as $item) {
                if (!is_numeric( $item )) {
                    $projectType = new Theory();
                    $projectType->name = $item;
                    $projectType->save();
                    $item = $projectType->id;
                }
                $relationModel = new ProjectTheory();
                $relationModel->theory_id = $item;
                $relationModel->project_id = $id;
                $relationModel->save();
            }
        }
        if (Yii::$app->request->post( 'Project' )['projectTypes']) {
            foreach (Yii::$app->request->post( 'Project' )['projectTypes'] as $item) {
                if (!is_numeric( $item )) {
                    $projectType = new ProjectType();
                    $projectType->name = $item;
                    $projectType->save();
                    $item = $projectType->id;
                }
                $relationModel = new ProjectXProjectType();
                $relationModel->project_type_id = $item;
                $relationModel->project_id = $id;
                $relationModel->save();
            }
        }


    }
    /**
     * @param $searchBy
     * @return array
     */
    public function assignSearchFields($searchBy)
    {
        if ($searchBy == self::KEYWORD) {
            $fields = [
                'name_th^3',
                'name_en^6',
                'theory^50',
                'tool^30',
                'detail^2',
            ];
        } else if ($searchBy == self::PROJECT_NAME) {
            $fields = [
                'name_th^3',
                'name_en^6'
            ];
        } else if ($searchBy == self::OWNER) {
            $fields = ['owner^3'];
        } else {
            $fields = [];
        }
        return $fields;
    }

    public function actionChangeMember()
    {
        $model = new ChangeMemberRequest();
        if (Yii::$app->request->isGet) {
            $projectId = Project::findProjectId();
            if ($projectId && Advise::find()
                    ->where( ['project_id' => $projectId] )
                    ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                    ->one()) {
                $project = Project::findOne( $projectId );
                return $this->render( 'change-member', [
                    'project' => $project,
                    'model' => $model
                ] );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'You Not Have Project' ) );
                return $this->redirect( Yii::$app->request->referrer );
            }
        } else {
            if ($model->load( Yii::$app->request->post() )) {
                $model->status = ChangeMemberRequest::STATUS_PENDING;
                $model->project_id = Project::findProjectId();
                if ($model->save()) {
                    $project = Project::findOne( $model->project_id );
                    foreach ($project->currentStudents as $item) {
                        $relationModel = new StudentRequestMember();
                        $relationModel->student_id = $item->id;
                        $relationModel->type = StudentRequestMember::TYPE_FROM;
                        $relationModel->change_member_request_id = $model->id;
                        $relationModel->save();
                    }
                    if (Yii::$app->request->post( 'Project' )['currentStudents']) {
                        foreach (Yii::$app->request->post( 'Project' )['currentStudents'] as $item) {
                            $relationModel = new StudentRequestMember();
                            $relationModel->student_id = $item;
                            $relationModel->type = StudentRequestMember::TYPE_TO;
                            $relationModel->change_member_request_id = $model->id;
                            $relationModel->save();
                        }
                    }
                    Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                    return $this->redirect( ['requesting/out'] );
                } else {
                    Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                    return $this->redirect( ['project/change-member'] );
                }
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                return $this->redirect( ['project/change-member'] );
            }

        }


    }

    public function actionLog($id)
    {

        $modelChangeTopic = ChangeTopicRequest::find()
            ->where( ['project_id' => $id] )
            ->all();
        $modelChangeAdviser = ChangeAdviserRequest::find()
            ->where( ['project_id' => $id] )
            ->all();
        $modelChangeMember = ChangeMemberRequest::find()
            ->where( ['project_id' => $id] )
            ->all();
        $model = Project::findOne( $id );
        return $this->render( 'log',
            [
                'modelChangeTopic' => $modelChangeTopic,
                'modelChangeAdviser' => $modelChangeAdviser,
                'modelChangeMember' => $modelChangeMember,
                'model' => $model
            ] );

    }

}
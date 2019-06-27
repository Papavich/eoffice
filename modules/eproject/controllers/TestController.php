<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 4/7/2560
 * Time: 13:35
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ElasticHelper;
use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\components\office2text\DocxConversion;
use app\modules\eproject\components\thsplitlib\Segment;
use app\modules\eproject\models\Advise;
use app\modules\eproject\models\AdviserType;
use app\modules\eproject\models\ElasticProject;
use app\modules\eproject\models\ElasticTheory;
use app\modules\eproject\models\ElasticTool;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\ProjectDocument;
use app\modules\eproject\models\ProjectDocumentTmp;
use app\modules\eproject\models\ProjectOld;
use app\modules\eproject\models\ProjectTemp;
use app\modules\eproject\models\StudentProject;
use app\modules\eproject\models\Temp;
use app\modules\eproject\models\TempAdviser;
use app\modules\eproject\models\Upload;
use app\modules\eproject\models\User;
use app\modules\eproject\models\Year;
use app\modules\eproject\models\YearSemester;
use http\Exception;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\httpclient\Client;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class TestController extends Controller
{

    /**
     *
     */
    public function actionTheory()
    {
        $keyword = Project::findOne( Project::findProjectId() )->abstract;
        $raw = [

            "bool" => [
                'should' => [
                    'multi_match' => [
                        'query' => "Android",
                        'fields' => ['title']

                    ]
                ],


            ],

        ];
        $model = ElasticTool::find()->query( $raw )->minScore( 0.2 )->limit( 10 )->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [$model
        ];
    }

    public function actionTool()
    {
        $model = ElasticTool::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [$model
        ];
    }

    public function actionSearch()
    {
        $user = ElasticProject::find()->query( [
            "bool" => [
                'must' => [
                    'multi_match' => [
                        'query' => 'โครงงาน',
                        'fields' => [
                            'name_th^3',
                            'name_en'
                        ]
                    ]
                ],
                'filter' => [
                    'bool' => [
                        'should' => [
                            ['terms' => ['type' => [1, 2]]]
                        ],
                        'should' => [
                            ['terms' => ['adviser' => [1]]]
                        ]
                    ]
                ]
            ]
        ] )->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [$user
        ];
    }

    public function actionDelete()
    {
        $model = ElasticProject::get( 5 );
        $model->delete();
    }

    public function actionUpdate()
    {
        $model = ElasticProject::get( 1 );
        $model->name_en = "Thailand";
        $model->save();
    }

    public function actionInsert()
    {
        $user = new ElasticProject();
        $user->primaryKey = 1;
        $user->name_th = "ประเทศไทย";
        $user->save();
    }

    public function actionTest()
    {

        $model = Project::findOne( 48 );
        var_dump( $model->retrieveProjectType() );
    }

    public function actionIndex()
    {
//        $id = $_GET['id'];
////        echo ElasticHelper::search('komkeao','ประเทศลาวและพม่า');
//        $model=AdviserType::find()->all();
//        $data = [];
//        foreach ($model as $item) {
//            $data[]=$item->getAttributes(['id','name']);
//        }
        ElasticProject::deleteIndex();
        ElasticProject::createIndex();
        ElasticProject::updateMapping();

    }

    public function actionRead()
    {
        $text = new DocxConversion( 'web_eproject/uploads/project_documents/52/c9e1f96893201711131213.docx' );
        echo $text->convertToText();
    }

    public function actionImportProject()
    {
//        StudentProject::deleteAll();
//        Advise::deleteAll();
//        Project::deleteAll();
        ini_set( 'max_execution_time', 300 );
        ini_set( 'memory_limit', '-1' );
        $all = Temp::find()->all();
        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($all as $item) {
            $studentProject = new StudentProject();
            $studentProject->project_id = $item->pro_id;
            $user = User::find()->where( ['username' => $item->std_id] )->one();
            if (!$user) {
                //echo "0:";
                // var_dump( $item->pro_id );
                //    var_dump($item->std_id );

                //    echo "<br>";
                $i++;
                continue;
            }
            $studentProject->student_id = $user->id;
            $project = Project::findOne( $item->pro_id );
            if (!$project) {

                // echo "1:";
                // var_dump( $item->pro_id );
                var_dump( $item->pro_id );

                echo "<br>";
                $j++;
                continue;
            }
            $studentProject->semester_id = $project->semester_id;
            $studentProject->year_id = $project->year_id;
            if ($project->major_id == 3) {
                $studentProject->subject_id = "324494";
            }
            if ($project->major_id == 2) {
                if ($project->semester_id = 1) {
                    $studentProject->subject_id = "322494";
                } else {
                    $studentProject->subject_id = "322496";
                }
            }
            if ($project->major_id == 1) {
                $start = (int)substr( $item->std_id, 0, 2 );
                if ($start <= 54) {
                    if ($project->semester_id = 1) {
                        $studentProject->subject_id = "322494";
                    } else {
                        $studentProject->subject_id = "322496";
                    }
                } else {
                    if ($project->semester_id = 1) {
                        $studentProject->subject_id = "322498";
                    } else {
                        $studentProject->subject_id = "322499";
                    }
                }


            }
            if (!$studentProject->save()) {

                //  echo "3:";
                // var_dump( $studentProject->errors );
                $k++;
                continue;
            }
        }


        return "OK<br>" . $i . " " . $j . " " . $k;
    }

    public function actionImportAdviser()
    {
        ini_set( 'max_execution_time', 300 );
        ini_set( 'memory_limit', '-1' );
        $advisers = TempAdviser::find()->where( ['project_id' => 824] )->all();
        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($advisers as $item) {
            $advise = new Advise();
            $advise->project_id = $item->project_id;
            $advise->adviser_type_id = $item->type;
            $project = Project::findOne( $item->project_id );
            if (!$project) {
                // echo "1:";
                // var_dump( $item->project_id );
                echo "<br>";
                $i++;
                continue;
            }
            $advise->semester_id = $project->semester_id;
            $advise->year_id = $project->year_id;
            if ($project->major_id == 3) {
                $advise->subject_id = "324494";
            }
            if ($project->major_id == 2) {
                if ($project->semester_id = 1) {
                    $advise->subject_id = "322494";
                } else {
                    $advise->subject_id = "322496";
                }
            }
            if ($project->major_id == 1) {
//                $student_id=StudentProject::find()->where( ['project_id'=>$item->project_id] )->one()->student_id;
//                $user_id=User::findOne( $student_id )->username;
//                $start = (int)substr($user_id, 0, 2 );
                if ($project->year_id <= 2557) {
                    if ($project->semester_id = 1) {
                        $advise->subject_id = "322494";
                    } else {
                        $advise->subject_id = "322496";
                    }
                } else {
                    if ($project->semester_id = 1) {
                        $advise->subject_id = "322498";
                    } else {
                        $advise->subject_id = "322499";
                    }
                }


            }
            if ($item->adviser_id == "Somjit") {
                $advise->adviser_id = 821;
            } else if ($item->adviser_id == "khamron") {
                $advise->adviser_id = 8352;
            } else if ($item->adviser_id == "Khamron") {
                $advise->adviser_id = 8352;
            } else if ($item->adviser_id == "Sirapat") {
                $advise->adviser_id = 8348;
            } else if ($item->adviser_id == "Punyapol") {
                $advise->adviser_id = 535;
            } else if ($item->adviser_id == "Somchai") {
                $advise->adviser_id = 8379;
            } else if ($item->adviser_id == "Pasin") {
                $advise->adviser_id = 8362;
            } else if ($item->adviser_id == "chakchai") {
                $advise->adviser_id = 8356;
            } else if ($item->adviser_id == "Silada") {
                $advise->adviser_id = 8349;
            } else if ($item->adviser_id == "Boonsong") {
                $advise->adviser_id = 8378;
            } else if ($item->adviser_id == "Pusadee") {
                $advise->adviser_id = 533;
            } else if ($item->adviser_id == "Sunti") {
                $advise->adviser_id = 8351;
            } else if ($item->adviser_id == "sumonta") {
                $advise->adviser_id = 8364;
            } else if ($item->adviser_id == "Urachart") {
                $advise->adviser_id = 534;
            } else if ($item->adviser_id == "saiyan") {
                $advise->adviser_id = 8363;
            } else if ($item->adviser_id == "Ngamnij") {
                $advise->adviser_id = 8355;
            } else if ($item->adviser_id == "wararat") {
                $advise->adviser_id = 8357;
            } else if ($item->adviser_id == "Boonsup") {
                $advise->adviser_id = 8350;
            } else if ($item->adviser_id == "Kraisorn") {
                $advise->adviser_id = 8358;
            } else if ($item->adviser_id == "theerayut") {
                $advise->adviser_id = 536;
            } else if ($item->adviser_id == "Sartra") {
                $advise->adviser_id = 8354;
            } else if ($item->adviser_id == "Monlica") {
                $advise->adviser_id = 8361;
            } else if ($item->adviser_id == "nunnapus") {
                $advise->adviser_id = 8359;
            } else if ($item->adviser_id == "Chitsutha") {
                $advise->adviser_id = 8353;
            } else if ($item->adviser_id == "Satapron") {
                $advise->adviser_id = 8377;
            } else if ($item->adviser_id == "Rusamee") {
                $advise->adviser_id = 8367;
            } else if ($item->adviser_id == "Pipat") {
                $advise->adviser_id = 8366;
            } else if ($item->adviser_id == "Urawan") {
                $advise->adviser_id = 8370;
            } else if ($item->adviser_id == "Chaiyapon") {
                $advise->adviser_id = 8368;
            } else if ($item->adviser_id == "Wachirawut") {
                $advise->adviser_id = 818;
            } else if ($item->adviser_id == "Nagon") {
                $advise->adviser_id = 8369;
            } else if ($item->adviser_id == "Paweena") {
                $advise->adviser_id = 8360;
            } else if ($item->adviser_id == "Apisak") {
                $advise->adviser_id = 8365;
            } else {
                echo $item->adviser_id . "<br>";
                $j++;
            }

            if (!$advise->save()) {

                echo "3:";
                var_dump( $advise->errors );
                $k++;
                continue;
            }
        }
        return "OK<br>" . $i . " " . $j . " " . $k;

    }

    public function actionImportProjectImage()
    {
        ini_set( 'max_execution_time', 300 );
        ini_set( 'memory_limit', '-1' );
        $projectOlds = ProjectOld::find()->all();
        $i = 0;
        $j = 0;
        $k = 0;
        foreach ($projectOlds as $projectOld) {
            if (strlen( $projectOld->pro_ImageURL ) > 0) {

                $i++;
                $scr = Yii::getAlias( '@webroot' ) . '/web_eproject/' . $projectOld->pro_ImageURL;
                $ext = pathinfo( $projectOld->pro_ImageURL, PATHINFO_EXTENSION );
                $fileName = substr( md5( rand( 1, 1000 ) . time() ), 0, 10 ) . date( 'YmdHi' ) . '.' . $ext;//เลือกมา 15 อักษร .นามสกุล;
                $dest = Yii::getAlias( '@webroot' ) . '/web_eproject/uploads/project_images/' . $fileName;
                copy( $scr, $dest );
                if ($project = Project::findOne( $projectOld->pro_ID )) {
                    $project->image = $fileName;
                    if (!$project->save()) {
                        $k++;
                    }
                } else {
                    $j++;
                }
            }
        }
        echo "Has Image:" . $i . " Can't Find Project Id:" . $j . " Can't Save:" . $k;

    }

    const UPLOAD_FOLDER = 'web_eproject/uploads/project_documents'; //ที่เก็บรูปภาพ

    public function actionImportProjectDocument()
    {
        ini_set( 'max_execution_time', 100000 );
        ini_set( 'memory_limit', '-1' );
        $projectOlds = ProjectDocumentTmp::find()->all();
        $i = 0;
        $j = 0;
        foreach ($projectOlds as $projectOld) {
            if (strlen( $projectOld->pdc_Path ) > 0) {
                if (self::startsWith( $projectOld->pdc_Path, 'http' )) {
                    $projectDoc = new ProjectDocument();
                    $projectDoc->project_id = $projectOld->pdc_pro_ID_F;
                    $projectDoc->document_type_id = $projectOld->pdc_Type;
                    $projectDoc->file_type_id = 5;//
                    $projectDoc->path = $projectOld->pdc_Path;//
                    if (!$projectDoc->save()) {
                        $j++;
                    }

                } else {
                    $path = self::UPLOAD_FOLDER . '/' . $projectOld->pdc_pro_ID_F;
                    FileHelper::createDirectory( $path );
                    $scr = Yii::getAlias( '@webroot' ) . '/web_eproject/' . $projectOld->pdc_Path;
                    $ext = pathinfo( $projectOld->pdc_Path, PATHINFO_EXTENSION );
                    $fileName = substr( md5( rand( 1, 1000 ) . time() ), 0, 10 ) . date( 'YmdHi' ) . '.' . $ext;//เลือกมา 15 อักษร .นามสกุล;
                    $dest = Yii::getAlias( '@webroot' ) . '/' . $path . '/' . $fileName;
                    if (file_exists( $scr )) {
                        copy( $scr, $dest );
                        $projectDoc = new ProjectDocument();
                        $projectDoc->project_id = $projectOld->pdc_pro_ID_F;
                        $projectDoc->document_type_id = $projectOld->pdc_Type;
                        if ($projectOld->pdc_Type == 6) {
                            $projectDoc->file_type_id = 4;//
                        } else {
                            $projectDoc->file_type_id = 2;//
                        }
                        $projectDoc->path = $fileName;//
                        if (!$projectDoc->save()) {
                            $j++;
                        }

                    } else {
                        $i++;
                    }

                }
            }
            if (strlen( $projectOld->pdc_Path2 ) > 0) {
                if (self::startsWith( $projectOld->pdc_Path2, 'http' )) {
                    $projectDoc = new ProjectDocument();
                    $projectDoc->project_id = $projectOld->pdc_pro_ID_F;
                    $projectDoc->document_type_id = $projectOld->pdc_Type;
                    $projectDoc->file_type_id = 5;//
                    $projectDoc->path = $projectOld->pdc_Path2;//
                    if (!$projectDoc->save()) {
                        $j++;
                    }

                } else {
                    $path = self::UPLOAD_FOLDER . '/' . $projectOld->pdc_pro_ID_F;
                    FileHelper::createDirectory( $path );
                    $scr = Yii::getAlias( '@webroot' ) . '/web_eproject/' . $projectOld->pdc_Path2;
                    $ext = pathinfo( $projectOld->pdc_Path2, PATHINFO_EXTENSION );
                    $fileName = substr( md5( rand( 1, 1000 ) . time() ), 0, 10 ) . date( 'YmdHi' ) . '.' . $ext;//เลือกมา 15 อักษร .นามสกุล;
                    $dest = Yii::getAlias( '@webroot' ) . '/' . $path . '/' . $fileName;
                    if (file_exists( $scr )) {
                        copy( $scr, $dest );
                        $projectDoc = new ProjectDocument();
                        $projectDoc->project_id = $projectOld->pdc_pro_ID_F;
                        $projectDoc->document_type_id = $projectOld->pdc_Type;
                        $projectDoc->file_type_id = 3;//
                        $projectDoc->path = $fileName;//
                        if (!$projectDoc->save()) {
                            $j++;
                        }

                    } else {
                        $i++;
                    }

                }

            }
            if (strlen( $projectOld->pdc_Path3 ) > 0) {
                if (self::startsWith( $projectOld->pdc_Path3, 'http' )) {
                    $projectDoc = new ProjectDocument();
                    $projectDoc->project_id = $projectOld->pdc_pro_ID_F;
                    $projectDoc->document_type_id = $projectOld->pdc_Type;
                    $projectDoc->file_type_id = 5;//
                    $projectDoc->path = $projectOld->pdc_Path3;//
                    if (!$projectDoc->save()) {
                        $j++;
                    }

                } else {
                    $path = self::UPLOAD_FOLDER . '/' . $projectOld->pdc_pro_ID_F;
                    FileHelper::createDirectory( $path );
                    $scr = Yii::getAlias( '@webroot' ) . '/web_eproject/' . $projectOld->pdc_Path3;
                    $ext = pathinfo( $projectOld->pdc_Path3, PATHINFO_EXTENSION );
                    $fileName = substr( md5( rand( 1, 1000 ) . time() ), 0, 10 ) . date( 'YmdHi' ) . '.' . $ext;//เลือกมา 15 อักษร .นามสกุล;
                    $dest = Yii::getAlias( '@webroot' ) . '/' . $path . '/' . $fileName;
                    if (file_exists( $scr )) {
                        copy( $scr, $dest );
                        $projectDoc = new ProjectDocument();
                        $projectDoc->project_id = $projectOld->pdc_pro_ID_F;
                        $projectDoc->document_type_id = $projectOld->pdc_Type;
                        $projectDoc->file_type_id = 1;//
                        $projectDoc->path = $fileName;//
                        if (!$projectDoc->save()) {
                            $j++;
                        }

                    } else {
                        $i++;
                    }

                }

            }
        }
        echo "Not Found:" . $i . " Can't Save:" . $j;

    }

    function startsWith($haystack, $needle)
    {
        $length = strlen( $needle );
        return (substr( $haystack, 0, $length ) === $needle);
    }
}
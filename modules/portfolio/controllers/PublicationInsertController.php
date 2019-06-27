<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 24/3/2561
 * Time: 17:34
 */

namespace app\modules\portfolio\controllers;

use app\models\ProjectMember;
use app\modules\portfolio\models\Category;
use app\modules\portfolio\models\PublicationOrder;
use app\modules\portfolio\models\PublicationSearch;
use app\modules\portfolio\models\Publication;
use yii\base\Model;

use app\modules\portfolio\models\PublicationOrderSearch;
use Yii;
use app\modules\portfolio\models\Member;
use app\modules\portfolio\models\MemberSearch;

use app\modules\portfolio\models\ModelProjectMember;
use app\modules\portfolio\models\ProjectQuery;
use yii\helpers\Json;
use yii\web\Controller;
use app\modules\portfolio\models\Cities;
use app\modules\portfolio\models\States;
use app\modules\portfolio\models\Countries;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

class PublicationInsertController extends Controller
{


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AssetDetail models.
     * @return mixed
     */
    public function actionIndex()
    {

        $this->layout = "main_modules";
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AssetDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);


        /* $model = $this->findModel($id);
         $assetdetail = $model->assetdetail;

         return $this->render('view', [
             'model' => $model,
             'assetdetail' => $assetdetail,
         ]);  */
    }

    /**
     * Creates a new AssetDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {

        $this->layout = "main";

        $modelPublication = new Publication();
        $modelsProjectMember = [new Member()];
        $publicationOrder = [new PublicationOrder()];


        $persons = [];
        $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
        foreach ($persons_main as $person_main) {
            $person['id'] = $person_main['id'];
            $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_fname_th'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
            array_push($persons, $person);
        }


        //   return Json::encode( $modelsProjectMember);
        // exit;

        if ($modelPublication->load(Yii::$app->request->post())) {
//            return Json::encode(Yii::$app->request->post());


            $post = Yii::$app->request->post();

            $publication = new Publication();
            $publication->pub_name_thai = $post['Publication']['pub_name_thai'];
            $publication->pub_name_eng = $post['Publication']['pub_name_eng'];
            //$publication->book_name = $post['Publication']['book_name'];
            $publication->date = $post['Publication']['date'];
            $publication->acticle_detail = $post['Publication']['acticle_detail'];
            $publication->page_number = $post['Publication']['page_number'];
            $publication->abstract = $post['Publication']['abstract'];
            $publication->press = $post['Publication']['press'];
            $publication->publisher = $post['Publication']['publisher'];
            $publication->ISBN = $post['Publication']['ISBN'];
            $publication->issn = $post['Publication']['issn'];
            //$publication->dataval = $post['Publication']['dataval'];
            $publication->article = $post['Publication']['article'];
            $publication->number = $post['Publication']['number'];
            // $publication->issuance = $post['Publication']['issuance'];

            //$publication->dataindex = $post['Publication']['dataindex'];
            $publication->impact_factor = $post['Publication']['impact_factor'];
            $publication->doi = $post['Publication']['doi'];
            $publication->score = $post['Publication']['score'];


            // $publication->category_category_id = $post['Publication']['cetagorys'];


            if (!$publication->save()) return Json::encode($publication->errors);


            foreach ($post['Member'] as $key => $member_) {
                $member = new Member();
                if ($post['cond'][$key] == "inside") {
                    $member->person_id = $member_['person_id'];
                } else if ($post['cond'][$key] == "outside") {
                    $member->member_name = $member_['member_name'];
                    $member->member_lname = $member_['member_lname'];
                }
                if (!$member->save()) return Json::encode($member->errors);
                $publication_order = new PublicationOrder();
                $publication_order->publication_pub_id = $publication->pub_id;
                $publication_order->publications_type_pub_type_id = $post['type'][$key];
                $publication_order->project_member_pro_member_id = $member->member_id;
                $publication_order->author_level_auth_level_id = $post['role'][$key];
                $publication_order->contributor_contributor_id1 = $post['status'][$key];
                $publication_order->person_id = $member->person_id = $member_['person_id'];
                if (!$publication_order->save()) return Json::encode($publication_order->errors);
            }

            // return


//            $modelProject->sponsor_sponsor_id=1235;
//            $modelProject->participation_participation_project_code=123456;

            //  $model = new Project();
            //$model->project_id
            //  $model->project_name_thai = $modelProject->project_name_thai;
            // $model->project_name_eng = $modelProject->project_name_eng;
            //$model->project_start = $modelProject->project_start;
            // $model->project_end = $modelProject->project_end;
            //  $model->project_duration = $modelProject->project_duration;
            // $model->project_budget = $modelProject->project_budget;
            //  $model->repayment = $modelProject->repayment;
            // $model->project_url = $modelProject->project_url;
            //  $model->advisor_id = $modelProject->advisor_id;
            //  $model->person_id = $modelProject->person_id;
            // $model->std_id = $modelProject->std_id;
            //$model->sponsor_sponsor_id=1234;
            //$model->participation_participation_project_code=123456;
//            $model->save();
//return Json::encode($model);
//exit;

            // $modelsProjectMember = ModelProjectMember::createMultiple(ProjectOrder::classname(), $modelsProjectMember);
            // ModelProjectMember::loadMultiple($modelsProjectMember, Yii::$app->request->post());

//return Json::encode($modelsProjectMember);
            // foreach ($modelsProjectMember as $row) {

            //   if ($row->member_name) {
            //   $model = new ProjectMember;
            //        $model->pro_member_id = $modelProject->project_id;
            //       $model->projectProject->project_name_eng = $row->project_name_eng;
            //         $model->projectProject->project_name_thai = $row->asset_univ_type;
            //      $model->projectProject->sponsor_sponsor_id = $row->asset_dept_code_start;
            //       $model->projectProject->project_start = $row->asset_dept_type;
            //       $model->projectProject->project_end = $row->asset_detail_name;
            //     $model->projectProject->project_duration = $row->asset_detail_brand;
            ///       $model->projectProject->project_budget = $row->asset_detail_amount;
            //  $model->projectProject->repayment = $row->asset_detail_age;
            //      $model->projectProject->project_url = $row->asset_detail_price;
            //  $model->projectProject->participation_project_participation_project_id = $row->asset_detail_price_wreck;
            //     $model->projectProject->advisors_advisors_id = $row->asset_detail_insurance;
            //     $model->projectProject->institution_ag_award_id = $row->asset_detail_building;
            //     $model->member_name = $row->member_name;
            //     $model->member_lname = $row->member_lname;
            //   $model->projectRole->project_role_name = $row->project_role_name;
            //  $model->person_person_id = $row->person_person_ide;

            //  $num = $row->member_name;
            //echo $num;
            //  $model->save();

            // for ($num1 = 1; $num1 < $num; $num1++) {
            //     $model = new ProjectMember;
            //      $model->pro_member_id = $modelProject->project_id;
            //   $model->projectProject->project_name_eng = $row->project_name_eng;
            //   $model->projectProject->project_name_thai = $row->project_name_thai;
            //   $model->projectProject->sponsor_sponsor_id = $row->sponsor_sponsor_id;
            //   $model->projectProject->project_start = $row->project_start;
            //   $model->projectProject->project_end = $row->project_end;
            //    $model->projectProject->project_budget = $row->project_budget;
            //   $model->projectProject->repayment = $row->repayment;
            //   $model->projectProject->project_url = $row->project_url;
            //    $model->projectProject->participation_project_participation_project_id = $row->participation_project_participation_project_id;
            //   $model->projectProject->institution_ag_award_id = $row->institution_ag_award_id;
            //   $model->project_project_id = $row->project_project_id;
            //   $model->member_name = $row->member_name;
            //   $model->member_lname = $row->member_lname;
            //    $model->projectRole->project_role_name = $row->project_role_name;
            //    $model->person_person_id = $row->person_person_ide;
            //  $num = $row->project_project_id;

            //   $model->save();
            //echo $num1;

            //  }


            // }
            // exit;

            //}


        }


        /*/    while (($modelsAssetDetail->asset_detail_amount)-1 ){
                foreach ($modelsAssetDetail as $row) {

                    if ($row->asset_detail_amount) {
                        $model = new AssetDetail;
                        $model->asset_asset_id = $modelAsset->asset_id;
                        $model->asset_univ_code_start = $row->asset_univ_code_start;
                        $model->asset_univ_type = $row->asset_univ_type;
                        $model->asset_dept_code_start = $row->asset_dept_code_start;
                        $model->asset_dept_type = $row->asset_dept_type;
                        $model->asset_detail_name = $row->asset_detail_name;
                        $model->asset_detail_brand = $row->asset_detail_brand;
                        $model->asset_detail_amount = $row->asset_detail_amount;
                        $model->asset_detail_age = $row->asset_detail_age;
                        $model->asset_detail_price = $row->asset_detail_price;
                        $model->asset_detail_price_wreck = $row->asset_detail_price_wreck;
                        $model->asset_detail_insurance = $row->asset_detail_insurance;
                        $model->asset_detail_building = $row->asset_detail_building;
                        $model->asset_detail_room = $row->asset_detail_room;


                        $model->save();
                    }
                }

            } */

        // return pri($modelsProjectMember);

//        return Json::encode($modelsProjectMember);


        return $this->render('create', [
            'modelPublication' => $modelPublication,
            'persons' => $persons,
            'modelsProjectMember' => (empty($modelsProjectMember)) ? [new Member()] : $modelsProjectMember,

        ]);
    }

    public function actionCreate2()
    {

        $this->layout = "main";

        $modelPublication = new Publication();
        $modelsProjectMember = [new Member()];
        $publicationOrder = [new PublicationOrder()];
        $cetagory = [new Category()];
        //$publication->skillToArray();

        $persons = [];
        $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
        foreach ($persons_main as $person_main) {
            $person['id'] = $person_main['id'];
            $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_fname_th'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
            array_push($persons, $person);
        }


        //   return Json::encode( $modelsProjectMember);
        // exit;


        if ($modelPublication->load(Yii::$app->request->post())) {
//            return Json::encode(Yii::$app->request->post());


            $post = Yii::$app->request->post();
            /* $checkbox = array_keys ($post);
             foreach ($checkbox as $value){
                 $publication =   new Publication();
                 $publication->dataindex[] = $publication->pub_id;
                 $publication->dataindex[] = $value;
                 $publication->save();
             }*/

            $publication = new Publication();
            //$publication->pub_name_thai = $post['Publication']['pub_name_thai'];
            //$publication->pub_name_eng = $post['Publication']['pub_name_eng'];
            //$publication->book_name = $post['Publication']['book_name'];
            $publication->date = $post['Publication']['date'];
            $publication->acticle_detail = $post['Publication']['acticle_detail'];
            $publication->page_number = $post['Publication']['page_number'];
            $publication->abstract = $post['Publication']['abstract'];
            $publication->press = $post['Publication']['press'];
            $publication->publisher = $post['Publication']['publisher'];
            $publication->ISBN = $post['Publication']['ISBN'];
            $publication->issn = $post['Publication']['issn'];
            $publication->dataval = $post['Publication']['dataval'];
            $publication->article = $post['Publication']['article'];
            $publication->number = $post['Publication']['number'];
            $publication->category_category_id = $post['Publication']['category_category_id'];

            $publication->issuance = $post['Publication']['issuance'];
            $publication->dataindex = $post['Publication']['dataindex'];
            $publication->impact_factor = $post['Publication']['impact_factor'];
            $publication->doi = $post['Publication']['doi'];


            if (!$publication->save()) return Json::encode($publication->errors);


            foreach ($post['Member'] as $key => $member_) {
                $member = new Member();
                if ($post['cond'][$key] == "inside") {
                    $member->person_id = $member_['person_id'];
                } else if ($post['cond'][$key] == "outside") {
                    $member->member_name = $member_['member_name'];
                    $member->member_lname = $member_['member_lname'];
                }
                if (!$member->save()) return Json::encode($member->errors);
                $publication_order = new PublicationOrder();
                $publication_order->publication_pub_id = $publication->pub_id;
                $publication_order->publications_type_pub_type_id = $post['type'][$key];
                $publication_order->project_member_pro_member_id = $member->member_id;
                $publication_order->author_level_auth_level_id = $post['role'][$key];
                $publication_order->contributor_contributor_id1 = $post['status'][$key];
                $publication_order->person_id = $member->person_id = $member_['person_id'];
                if (!$publication_order->save()) return Json::encode($publication_order->errors);
            }

            // return


//            $modelProject->sponsor_sponsor_id=1235;
//            $modelProject->participation_participation_project_code=123456;

            //  $model = new Project();
            //$model->project_id
            //  $model->project_name_thai = $modelProject->project_name_thai;
            // $model->project_name_eng = $modelProject->project_name_eng;
            //$model->project_start = $modelProject->project_start;
            // $model->project_end = $modelProject->project_end;
            //  $model->project_duration = $modelProject->project_duration;
            // $model->project_budget = $modelProject->project_budget;
            //  $model->repayment = $modelProject->repayment;
            // $model->project_url = $modelProject->project_url;
            //  $model->advisor_id = $modelProject->advisor_id;
            //  $model->person_id = $modelProject->person_id;
            // $model->std_id = $modelProject->std_id;
            //$model->sponsor_sponsor_id=1234;
            //$model->participation_participation_project_code=123456;
//            $model->save();
//return Json::encode($model);
//exit;

            // $modelsProjectMember = ModelProjectMember::createMultiple(ProjectOrder::classname(), $modelsProjectMember);
            // ModelProjectMember::loadMultiple($modelsProjectMember, Yii::$app->request->post());

//return Json::encode($modelsProjectMember);
            // foreach ($modelsProjectMember as $row) {

            //   if ($row->member_name) {
            //   $model = new ProjectMember;
            //        $model->pro_member_id = $modelProject->project_id;
            //       $model->projectProject->project_name_eng = $row->project_name_eng;
            //         $model->projectProject->project_name_thai = $row->asset_univ_type;
            //      $model->projectProject->sponsor_sponsor_id = $row->asset_dept_code_start;
            //       $model->projectProject->project_start = $row->asset_dept_type;
            //       $model->projectProject->project_end = $row->asset_detail_name;
            //     $model->projectProject->project_duration = $row->asset_detail_brand;
            ///       $model->projectProject->project_budget = $row->asset_detail_amount;
            //  $model->projectProject->repayment = $row->asset_detail_age;
            //      $model->projectProject->project_url = $row->asset_detail_price;
            //  $model->projectProject->participation_project_participation_project_id = $row->asset_detail_price_wreck;
            //     $model->projectProject->advisors_advisors_id = $row->asset_detail_insurance;
            //     $model->projectProject->institution_ag_award_id = $row->asset_detail_building;
            //     $model->member_name = $row->member_name;
            //     $model->member_lname = $row->member_lname;
            //   $model->projectRole->project_role_name = $row->project_role_name;
            //  $model->person_person_id = $row->person_person_ide;

            //  $num = $row->member_name;
            //echo $num;
            //  $model->save();

            // for ($num1 = 1; $num1 < $num; $num1++) {
            //     $model = new ProjectMember;
            //      $model->pro_member_id = $modelProject->project_id;
            //   $model->projectProject->project_name_eng = $row->project_name_eng;
            //   $model->projectProject->project_name_thai = $row->project_name_thai;
            //   $model->projectProject->sponsor_sponsor_id = $row->sponsor_sponsor_id;
            //   $model->projectProject->project_start = $row->project_start;
            //   $model->projectProject->project_end = $row->project_end;
            //    $model->projectProject->project_budget = $row->project_budget;
            //   $model->projectProject->repayment = $row->repayment;
            //   $model->projectProject->project_url = $row->project_url;
            //    $model->projectProject->participation_project_participation_project_id = $row->participation_project_participation_project_id;
            //   $model->projectProject->institution_ag_award_id = $row->institution_ag_award_id;
            //   $model->project_project_id = $row->project_project_id;
            //   $model->member_name = $row->member_name;
            //   $model->member_lname = $row->member_lname;
            //    $model->projectRole->project_role_name = $row->project_role_name;
            //    $model->person_person_id = $row->person_person_ide;
            //  $num = $row->project_project_id;

            //   $model->save();
            //echo $num1;

            //  }


            // }
            // exit;

            //}


        }


        /*/    while (($modelsAssetDetail->asset_detail_amount)-1 ){
                foreach ($modelsAssetDetail as $row) {

                    if ($row->asset_detail_amount) {
                        $model = new AssetDetail;
                        $model->asset_asset_id = $modelAsset->asset_id;
                        $model->asset_univ_code_start = $row->asset_univ_code_start;
                        $model->asset_univ_type = $row->asset_univ_type;
                        $model->asset_dept_code_start = $row->asset_dept_code_start;
                        $model->asset_dept_type = $row->asset_dept_type;
                        $model->asset_detail_name = $row->asset_detail_name;
                        $model->asset_detail_brand = $row->asset_detail_brand;
                        $model->asset_detail_amount = $row->asset_detail_amount;
                        $model->asset_detail_age = $row->asset_detail_age;
                        $model->asset_detail_price = $row->asset_detail_price;
                        $model->asset_detail_price_wreck = $row->asset_detail_price_wreck;
                        $model->asset_detail_insurance = $row->asset_detail_insurance;
                        $model->asset_detail_building = $row->asset_detail_building;
                        $model->asset_detail_room = $row->asset_detail_room;


                        $model->save();
                    }
                }

            } */

        // return pri($modelsProjectMember);

//        return Json::encode($modelsProjectMember);


        return $this->render('create2', [
            'modelPublication' => $modelPublication,
            'persons' => $persons,
            'cetagory' => $cetagory,
            'modelsProjectMember' => (empty($modelsProjectMember)) ? [new Member()] : $modelsProjectMember,

        ]);
    }

    public function actionCreate3()
    {


        $this->layout = "main";

        $modelPublication = new Publication();
        $modelsProjectMember = [new Member()];
        $publicationOrder = [new PublicationOrder()];


        $persons = [];
        $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user ')->queryAll();
        foreach ($persons_main as $person_main) {
            $person['id'] = $person_main['id'];
            $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_fname_th'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
            array_push($persons, $person);
        }


        //return Json::encode($person);
        // exit;

        if ($modelPublication->load(Yii::$app->request->post())) {
            // return Json::encode(Yii::$app->request->post());


            $post = Yii::$app->request->post();
//            return Json::encode(substr($post['Publication']['date'], 0, 10));

            $publication = new Publication();
            $publication->pub_name_thai = $post['Publication']['pub_name_thai'];
            $publication->pub_name_eng = $post['Publication']['pub_name_eng'];
            $publication->book_name_thai = $post['Publication']['book_name_thai'];
            $publication->book_name_eng = $post['Publication']['book_name_eng'];
            $publication->date = substr($post['Publication']['date'], 0, 10);
            $publication->acticle_detail = $post['Publication']['acticle_detail'];
            $publication->number = $post['Publication']['number'];
            $publication->issuance = $post['Publication']['issuance'];
            $publication->abstract = $post['Publication']['abstract'];
            $publication->press = $post['Publication']['press'];
            $publication->publisher = $post['Publication']['publisher'];
            $publication->editor = $post['Publication']['editor'];
            $publication->ISBN = $post['Publication']['ISBN'];
            $publication->issn = $post['Publication']['issn'];
            $publication->doi = $post['Publication']['doi'];
            $publication->impact_factor = $post['Publication']['impact_factor'];
            $publication->db_db_id = $post['Publication']['db_db_id'];
            $publication->countries_id = $post['Publication']['countries_id'];
            $publication->states_id = $post['Publication']['states_id'];
            $publication->cities_id = $post['Publication']['cities_id'];


            if (!$publication->save()) return Json::encode($publication->errors);


            foreach ($post['Member'] as $key => $member_) {
                $member = new Member();
                if ($post['cond'][$key] == "inside") {
                    $member->person_id = $member_['person_id'];
                    $publication->person_id = $member->person_id;
                } else if ($post['cond'][$key] == "outside") {
                    $member->member_name = $member_['member_name'];
                    $member->member_lname = $member_['member_lname'];
                }
                if (!$member->save()) return Json::encode($member->errors);
                $publication_order = new PublicationOrder();
                $publication_order->publication_pub_id = $publication->pub_id;
                $publication_order->publications_type_pub_type_id = 1;
                $publication_order->project_member_pro_member_id = $member->member_id;
                $publication_order->author_level_auth_level_id = $post['role'][$key];
                $publication_order->contributor_contributor_id1 = array_key_exists("status", $post) ? $post['status'][0] : null;
                $publication_order->person_id = $member->person_id = $member_['person_id'];
                $publication_order->date = $publication->date;
                if (!$publication_order->save()) return Json::encode($publication_order->errors);
            }

           return $this->redirect(['/portfolio/publication-order/show-me']);

            // return


//            $modelProject->sponsor_sponsor_id=1235;
//            $modelProject->participation_participation_project_code=123456;

            //  $model = new Project();
            //$model->project_id
            //  $model->project_name_thai = $modelProject->project_name_thai;
            // $model->project_name_eng = $modelProject->project_name_eng;
            //$model->project_start = $modelProject->project_start;
            // $model->project_end = $modelProject->project_end;
            //  $model->project_duration = $modelProject->project_duration;
            // $model->project_budget = $modelProject->project_budget;
            //  $model->repayment = $modelProject->repayment;
            // $model->project_url = $modelProject->project_url;
            //  $model->advisor_id = $modelProject->advisor_id;
            //  $model->person_id = $modelProject->person_id;
            // $model->std_id = $modelProject->std_id;
            //$model->sponsor_sponsor_id=1234;
            //$model->participation_participation_project_code=123456;
//            $model->save();
//return Json::encode($model);
//exit;

            // $modelsProjectMember = ModelProjectMember::createMultiple(ProjectOrder::classname(), $modelsProjectMember);
            // ModelProjectMember::loadMultiple($modelsProjectMember, Yii::$app->request->post());

//return Json::encode($modelsProjectMember);
            // foreach ($modelsProjectMember as $row) {

            //   if ($row->member_name) {
            //   $model = new ProjectMember;
            //        $model->pro_member_id = $modelProject->project_id;
            //       $model->projectProject->project_name_eng = $row->project_name_eng;
            //         $model->projectProject->project_name_thai = $row->asset_univ_type;
            //      $model->projectProject->sponsor_sponsor_id = $row->asset_dept_code_start;
            //       $model->projectProject->project_start = $row->asset_dept_type;
            //       $model->projectProject->project_end = $row->asset_detail_name;
            //     $model->projectProject->project_duration = $row->asset_detail_brand;
            ///       $model->projectProject->project_budget = $row->asset_detail_amount;
            //  $model->projectProject->repayment = $row->asset_detail_age;
            //      $model->projectProject->project_url = $row->asset_detail_price;
            //  $model->projectProject->participation_project_participation_project_id = $row->asset_detail_price_wreck;
            //     $model->projectProject->advisors_advisors_id = $row->asset_detail_insurance;
            //     $model->projectProject->institution_ag_award_id = $row->asset_detail_building;
            //     $model->member_name = $row->member_name;
            //     $model->member_lname = $row->member_lname;
            //   $model->projectRole->project_role_name = $row->project_role_name;
            //  $model->person_person_id = $row->person_person_ide;

            //  $num = $row->member_name;
            //echo $num;
            //  $model->save();

            // for ($num1 = 1; $num1 < $num; $num1++) {
            //     $model = new ProjectMember;
            //      $model->pro_member_id = $modelProject->project_id;
            //   $model->projectProject->project_name_eng = $row->project_name_eng;
            //   $model->projectProject->project_name_thai = $row->project_name_thai;
            //   $model->projectProject->sponsor_sponsor_id = $row->sponsor_sponsor_id;
            //   $model->projectProject->project_start = $row->project_start;
            //   $model->projectProject->project_end = $row->project_end;
            //    $model->projectProject->project_budget = $row->project_budget;
            //   $model->projectProject->repayment = $row->repayment;
            //   $model->projectProject->project_url = $row->project_url;
            //    $model->projectProject->participation_project_participation_project_id = $row->participation_project_participation_project_id;
            //   $model->projectProject->institution_ag_award_id = $row->institution_ag_award_id;
            //   $model->project_project_id = $row->project_project_id;
            //   $model->member_name = $row->member_name;
            //   $model->member_lname = $row->member_lname;
            //    $model->projectRole->project_role_name = $row->project_role_name;
            //    $model->person_person_id = $row->person_person_ide;
            //  $num = $row->project_project_id;

            //   $model->save();
            //echo $num1;

            //  }


            // }
            // exit;

            //}


        }


        /*/    while (($modelsAssetDetail->asset_detail_amount)-1 ){
                foreach ($modelsAssetDetail as $row) {

                    if ($row->asset_detail_amount) {
                        $model = new AssetDetail;
                        $model->asset_asset_id = $modelAsset->asset_id;
                        $model->asset_univ_code_start = $row->asset_univ_code_start;
                        $model->asset_univ_type = $row->asset_univ_type;
                        $model->asset_dept_code_start = $row->asset_dept_code_start;
                        $model->asset_dept_type = $row->asset_dept_type;
                        $model->asset_detail_name = $row->asset_detail_name;
                        $model->asset_detail_brand = $row->asset_detail_brand;
                        $model->asset_detail_amount = $row->asset_detail_amount;
                        $model->asset_detail_age = $row->asset_detail_age;
                        $model->asset_detail_price = $row->asset_detail_price;
                        $model->asset_detail_price_wreck = $row->asset_detail_price_wreck;
                        $model->asset_detail_insurance = $row->asset_detail_insurance;
                        $model->asset_detail_building = $row->asset_detail_building;
                        $model->asset_detail_room = $row->asset_detail_room;


                        $model->save();
                    }
                }

            } */

        // return pri($modelsProjectMember);

     //return Json::encode($modelsProjectMember);


        return $this->render('create3', [
            'modelPublication' => $modelPublication,
            'persons' => $persons,

            'modelsProjectMember' => (empty($modelsProjectMember)) ? [new Member()] : $modelsProjectMember,

        ]);
    }

    public function actionCreate4()
    {

        $this->layout = "main";

        $modelPublication = new Publication();
        $modelsProjectMember = [new Member()];
        $publicationOrder = [new PublicationOrder()];


        $persons = [];
        $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
        foreach ($persons_main as $person_main) {
            $person['id'] = $person_main['id'];
            $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_fname_th'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
            array_push($persons, $person);
        }


        //   return Json::encode( $modelsProjectMember);
        // exit;

        if ($modelPublication->load(Yii::$app->request->post())) {
//            return Json::encode(Yii::$app->request->post());


            $post = Yii::$app->request->post();
          //  return Json::encode($post);

            $publication = new Publication();

            $publication->meeting_name_thai = $post['Publication']['meeting_name_thai'];
            $publication->meeting_name_eng = $post['Publication']['meeting_name_eng'];
            $publication->pub_name_thai = $post['Publication']['pub_name_thai'];
            $publication->pub_name_eng = $post['Publication']['pub_name_eng'];
            $publication->date = $post['Publication']['date'];
            $publication->institution_ag_award_id = $post['Publication']['institution_ag_award_id'];
            $publication->present_present_id = $post['Publication']['present_present_id'];
            $publication->cities_id = $post['Publication']['cities_id'];
            $publication->states_id = $post['Publication']['states_id'];
            $publication->countries_id = $post['Publication']['countries_id'];

            if (!$publication->save()) return Json::encode($publication->errors);




            foreach ($post['Member'] as $key => $member_) {
                $member = new Member();
                if ($post['cond'][$key] == "inside") {
                    $member->person_id = $member_['person_id'];
                } else if ($post['cond'][$key] == "outside") {
                    $member->member_name = $member_['member_name'];
                    $member->member_lname = $member_['member_lname'];
                }
                if (!$member->save()) return Json::encode($member->errors);
                $publication_order = new PublicationOrder();
                $publication_order->publication_pub_id = $publication->pub_id;
                $publication_order->publications_type_pub_type_id = 2;
                $publication_order->project_member_pro_member_id = $member->member_id;
               // $publication_order->author_level_auth_level_id = $post['role'][$key];
                //$publication_order->contributor_contributor_id1 = $post['status'][$key];
                $publication_order->person_id = $member->person_id = $member_['person_id'];
                $publication_order->date = $publication->date;
                if (!$publication_order->save()) return Json::encode($publication_order->errors);
            }


//            $modelProject->sponsor_sponsor_id=1235;
//            $modelProject->participation_participation_project_code=123456;

            //  $model = new Project();
            //$model->project_id
            //  $model->project_name_thai = $modelProject->project_name_thai;
            // $model->project_name_eng = $modelProject->project_name_eng;
            //$model->project_start = $modelProject->project_start;
            // $model->project_end = $modelProject->project_end;
            //  $model->project_duration = $modelProject->project_duration;
            // $model->project_budget = $modelProject->project_budget;
            //  $model->repayment = $modelProject->repayment;
            // $model->project_url = $modelProject->project_url;
            //  $model->advisor_id = $modelProject->advisor_id;
            //  $model->person_id = $modelProject->person_id;
            // $model->std_id = $modelProject->std_id;
            //$model->sponsor_sponsor_id=1234;
            //$model->participation_participation_project_code=123456;
//            $model->save();
//return Json::encode($model);
//exit;

            // $modelsProjectMember = ModelProjectMember::createMultiple(ProjectOrder::classname(), $modelsProjectMember);
            // ModelProjectMember::loadMultiple($modelsProjectMember, Yii::$app->request->post());

//return Json::encode($modelsProjectMember);
            // foreach ($modelsProjectMember as $row) {

            //   if ($row->member_name) {
            //   $model = new ProjectMember;
            //        $model->pro_member_id = $modelProject->project_id;
            //       $model->projectProject->project_name_eng = $row->project_name_eng;
            //         $model->projectProject->project_name_thai = $row->asset_univ_type;
            //      $model->projectProject->sponsor_sponsor_id = $row->asset_dept_code_start;
            //       $model->projectProject->project_start = $row->asset_dept_type;
            //       $model->projectProject->project_end = $row->asset_detail_name;
            //     $model->projectProject->project_duration = $row->asset_detail_brand;
            ///       $model->projectProject->project_budget = $row->asset_detail_amount;
            //  $model->projectProject->repayment = $row->asset_detail_age;
            //      $model->projectProject->project_url = $row->asset_detail_price;
            //  $model->projectProject->participation_project_participation_project_id = $row->asset_detail_price_wreck;
            //     $model->projectProject->advisors_advisors_id = $row->asset_detail_insurance;
            //     $model->projectProject->institution_ag_award_id = $row->asset_detail_building;
            //     $model->member_name = $row->member_name;
            //     $model->member_lname = $row->member_lname;
            //   $model->projectRole->project_role_name = $row->project_role_name;
            //  $model->person_person_id = $row->person_person_ide;

            //  $num = $row->member_name;
            //echo $num;
            //  $model->save();

            // for ($num1 = 1; $num1 < $num; $num1++) {
            //     $model = new ProjectMember;
            //      $model->pro_member_id = $modelProject->project_id;
            //   $model->projectProject->project_name_eng = $row->project_name_eng;
            //   $model->projectProject->project_name_thai = $row->project_name_thai;
            //   $model->projectProject->sponsor_sponsor_id = $row->sponsor_sponsor_id;
            //   $model->projectProject->project_start = $row->project_start;
            //   $model->projectProject->project_end = $row->project_end;
            //    $model->projectProject->project_budget = $row->project_budget;
            //   $model->projectProject->repayment = $row->repayment;
            //   $model->projectProject->project_url = $row->project_url;
            //    $model->projectProject->participation_project_participation_project_id = $row->participation_project_participation_project_id;
            //   $model->projectProject->institution_ag_award_id = $row->institution_ag_award_id;
            //   $model->project_project_id = $row->project_project_id;
            //   $model->member_name = $row->member_name;
            //   $model->member_lname = $row->member_lname;
            //    $model->projectRole->project_role_name = $row->project_role_name;
            //    $model->person_person_id = $row->person_person_ide;
            //  $num = $row->project_project_id;

            //   $model->save();
            //echo $num1;

            //  }


            // }
            // exit;

            //}


        }


        /*/    while (($modelsAssetDetail->asset_detail_amount)-1 ){
                foreach ($modelsAssetDetail as $row) {

                    if ($row->asset_detail_amount) {
                        $model = new AssetDetail;
                        $model->asset_asset_id = $modelAsset->asset_id;
                        $model->asset_univ_code_start = $row->asset_univ_code_start;
                        $model->asset_univ_type = $row->asset_univ_type;
                        $model->asset_dept_code_start = $row->asset_dept_code_start;
                        $model->asset_dept_type = $row->asset_dept_type;
                        $model->asset_detail_name = $row->asset_detail_name;
                        $model->asset_detail_brand = $row->asset_detail_brand;
                        $model->asset_detail_amount = $row->asset_detail_amount;
                        $model->asset_detail_age = $row->asset_detail_age;
                        $model->asset_detail_price = $row->asset_detail_price;
                        $model->asset_detail_price_wreck = $row->asset_detail_price_wreck;
                        $model->asset_detail_insurance = $row->asset_detail_insurance;
                        $model->asset_detail_building = $row->asset_detail_building;
                        $model->asset_detail_room = $row->asset_detail_room;


                        $model->save();
                    }
                }

            } */

        // return pri($modelsProjectMember);

//        return Json::encode($modelsProjectMember);


        return $this->render('create4', [
            'modelPublication' => $modelPublication,
            'persons' => $persons,
            'modelsProjectMember' => (empty($modelsProjectMember)) ? [new Member()] : $modelsProjectMember,

        ]);
    }

    /**
     * Updates an existing AssetDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionUpdate($id)
     {
         $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['view', 'id' => $model->asset_detail_id]);
         }

         return $this->render('update', [
             'model' => $model,
         ]);
     } */

    public function actionUpdate($id)
    {
        $modelProject = Project::find()->where(['project_id' => $id])->one();
        $modelsProjectMember = ProjectMember::find()->where(['project_project_id' => $id])->all();
        if ($modelsProjectMember == null) {
            $modelsProjectMember = [new ProjectMember];
        }

        if ($modelProject->load(Yii::$app->request->post())) {
            $modelProject->save();
            $modelsProjectMember = ModelProjectMember::createMultiple(ProjectMember::classname(), $modelsProjectMember);
            ModelProjectMember::loadMultiple($modelsProjectMember, Yii::$app->request->post());
            ProjectMember::deleteAll(['project_project_id' => $modelProject]);
            foreach ($modelsProjectMember as $row) {
                if ($row->projectProjectp->project_name_eng) {
                    $model = new ProjectMember;
                    $model->pro_member_id = $modelProject->project_id;
                    $model->projectProject->project_name_eng = $row->project_name_eng;
                    $model->projectProject->project_name_thai = $row->project_name_thai;
                    $model->projectProject->sponsor_sponsor_id = $row->sponsor_sponsor_id;
                    $model->projectProject->project_start = $row->project_start;
                    $model->projectProject->project_end = $row->project_end;
                    $model->projectProject->project_duration = $row->project_duration;
                    $model->projectProject->project_budget = $row->project_budget;
                    $model->projectProject->repayment = $row->repayment;
                    $model->projectProject->project_url = $row->project_url;
                    $model->projectProject->participation_project_participation_project_id = $row->participation_project_participation_project_id;
                    $model->projectProject->advisors_advisors_id = $row->advisors_advisors_id;
                    $model->projectProject->institution_ag_award_id = $row->institution_ag_award_id;
                    $model->project_project_id = $row->project_project_id;
                    $model->member_name = $row->member_name;
                    $model->member_lname = $row->member_lname;
                    $model->projectRole->project_role_name = $row->project_role_name;
                    $model->person_person_id = $row->person_person_ide;
                    $model->save();

                }

            }
            exit;
        }

        return $this->render('update', [
            'modelProject' => $modelProject,
            'modelsProjectMember' => (empty($modelsProjectMember)) ? [new ProjectMember] : $modelsProjectMember
        ]);
    }


    /**
     * Deletes an existing AssetDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteOne($id)
    {
        // echo $id;
        //exit;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /* public function actionDelete($id)
     {
         $model = $this->findModel($id);
         $asset_detail_name = $model->asset_detail_name;

         if ($model->delete()) {
             Yii::$app->session->setFlash('success', 'Record  <strong>"' . $asset_detail_name . '"</strong> deleted successfully.');
         }

         return $this->redirect(['index']);
     } */

    /**
     * Finds the AssetDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*  protected function findModel($id)
      {
          if (($model = AssetDetail::findOne($id)) !== null) {
              return $model;
          }

          throw new NotFoundHttpException('The requested page does not exist.');
      } */

    protected function findModel($id)
    {
        if (($model = ProjectMember::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function Model($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
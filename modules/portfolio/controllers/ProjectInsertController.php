<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 9/3/2561
 * Time: 3:51
 */

namespace app\modules\portfolio\controllers;

use app\models\ProjectMember;
use app\modules\portfolio\models\Cities;
use app\modules\portfolio\models\States;
use app\modules\portfolio\models\Countries;
use app\modules\portfolio\models\ProjectOrder;
use app\modules\portfolio\models\Projects;
use Mpdf\Tag\S;
use yii\base\Model;

use app\modules\portfolio\models\ProjectSearch;
use Yii;
use app\modules\portfolio\models\Member;
use app\modules\portfolio\models\MemberSearch;
use app\modules\portfolio\models\Project;
use app\modules\portfolio\models\ModelProjectMember;
use app\modules\portfolio\models\ProjectQuery;
use yii\helpers\Json;
use yii\web\Controller;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;


class ProjectInsertController extends Controller
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

        $modelProject = new Project();
        $modelsProjectMember = [new Member()];
        $projectOrder = [new ProjectOrder()];


        $persons = [];
        $persons_main = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user')->queryAll();
        foreach ($persons_main as $person_main) {
            $person['id'] = $person_main['id'];
            $person['name'] = $person_main['user_type_id'] !== '0' ? $person_main['person_fname_th'] . ' ' . $person_main['person_lname_th'] : $person_main['student_fname_th'] . ' ' . $person_main['student_lname_th'];
            array_push($persons, $person);
        }


        //   return Json::encode( $modelsProjectMember);
        // exit;

        if ($modelProject->load(Yii::$app->request->post())) {
//            return Json::encode(Yii::$app->request->post());


            $post = Yii::$app->request->post();
//            return Json::encode( $post);
//            exit;





            $project = new Project();
            $project->project_name_thai = $post['Project']['project_name_thai'];
            $project->project_name_eng = $post['Project']['project_name_eng'];
            $project->project_start = substr($post['Project']['project_start'],0, 10);
            $project->project_end = substr($post['Project']['project_end'],0, 10);

            $project->project_budget = $post['Project']['project_budget'];
            $project->repayment= $post['Project']['repayment'];
            $project->project_url = $post['Project']['project_url'];
            //$project->countries_id = $post['Project']['countries_id'];
           // $project->states_id = $post['Project']['states_id'];
            $project->cities_id = $post['Project']['cities_id'];

            if (!$project->save()) return Json::encode($project->errors);











            //$diff = strtotime("project_star") - strtotime("project_end");

            //$days = $diff / 60 / 60 / 24;
            //$project->project_duration = $days ;




            foreach ($post['Member'] as $key => $member_) {
                $member = new Member();
                if ($post['cond'][$key] == "inside") {
                    $member->person_id = $member_['person_id'];
                } else if ($post['cond'][$key] == "outside") {
                    $member->member_name = $member_['member_name'];
                    $member->member_lname = $member_['member_lname'];
                }
                if (!$member->save()) return Json::encode($member->errors);
                $project_order = new ProjectOrder();
                $project_order->project_project_id = $project->project_id;
                $project_order->project_member_pro_member_id = $member->member_id;
                $project_order->project_role_project_role_id = $post['role'][$key];
                $project_order->sponsor_sponsor_id = $post['sponsor'][$key];
                $project_order->contributor_contributor_id =$post['status'][0];
                $project_order->date = $project->project_end;
                $project_order->person_id = $member->person_id;

                if (!$project_order->save()) return Json::encode($project_order->errors);
            }

//            return $this->render('index3');


//            $modelProject->sponsor_sponsor_id=1235;
//            $modelProject->participation_participation_project_code=123456;

            $model = new Project();
            //$model->project_id
            $model->project_name_thai = $modelProject->project_name_thai;
            $model->project_name_eng = $modelProject->project_name_eng;
            $model->project_start = $modelProject->project_start;
            $model->project_end = $modelProject->project_end;
            $model->project_duration = $modelProject->project_duration;
            $model->project_budget = $modelProject->project_budget;
            $model->repayment = $modelProject->repayment;
            $model->project_url = $modelProject->project_url;
            //$model->advisor_id = $modelProject->advisor_id;
            $model->person_id = $modelProject->person_id;
            $model->std_id = $modelProject->std_id;
            //$model->sponsor_sponsor_id=1234;
            //$model->participation_participation_project_code=123456;
//            $model->save();
//return Json::encode($model);
//exit;

            $modelsProjectMember = ModelProjectMember::createMultiple(ProjectOrder::classname(), $modelsProjectMember);
            ModelProjectMember::loadMultiple($modelsProjectMember, Yii::$app->request->post());

//return Json::encode($modelsProjectMember);
            foreach ($modelsProjectMember as $row) {

                if ($row->member_name) {
                    $model = new ProjectMember;
                    $model->pro_member_id = $modelProject->project_id;
                    $model->projectProject->project_name_eng = $row->project_name_eng;
                    $model->projectProject->project_name_thai = $row->asset_univ_type;
                    $model->projectProject->sponsor_sponsor_id = $row->asset_dept_code_start;
                    $model->projectProject->project_start = $row->asset_dept_type;
                    $model->projectProject->project_end = $row->asset_detail_name;
                    $model->projectProject->project_duration = $row->asset_detail_brand;
                    $model->projectProject->project_budget = $row->asset_detail_amount;
                    $model->projectProject->repayment = $row->asset_detail_age;
                    $model->projectProject->project_url = $row->asset_detail_price;
                    $model->projectProject->participation_project_participation_project_id = $row->asset_detail_price_wreck;
                    $model->projectProject->advisors_advisors_id = $row->asset_detail_insurance;
                    $model->projectProject->institution_ag_award_id = $row->asset_detail_building;
                    $model->project_project_id = $row->project_project_id;
                    $model->member_name = $row->member_name;
                    $model->member_lname = $row->member_lname;
                    $model->projectRole->project_role_name = $row->project_role_name;
                    $model->person_person_id = $row->person_person_ide;

                    $num = $row->member_name;
                    //echo $num;
                    $model->save();

                    for ($num1 = 1; $num1 < $num; $num1++) {
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
                        $num = $row->project_project_id;

                        $model->save();
                        //echo $num1;

                    }


                }
                exit;

            }


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

      // return Json::encode($modelProject);


        return $this->render('create', [

            'modelProject' => $modelProject,
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
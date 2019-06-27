<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 2/2/2561
 * Time: 1:23
 */

namespace app\modules\portfolio\controllers;

use app\modules\portfolio\models\Member;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use app\modules\portfolio\models\Project;

use app\modules\portfolio\models\Publication;
use app\modules\portfolio\models\PublicationSearch;





class PortfolioController extends Controller
{
     public function behaviors()
        {
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
            ];
        }


    /**
     * Lists all Person models.
     * @return mixed
     *
     */


    public function actionIndex()
    {
        $$this->view->params['status'] = 'Show2';
        $this->layout = "main_modules";


        //$ed1->update(array());
        //return Json::encode($ed);



        return $this->render("Show2");
    }

    /**
     * Displays a single Person model.
     * @param string $id
     * @return mixed
     */


    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
  /*  public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->P]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
   /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }





         public function actionSearch()
         {
             print_r($_POST["search"]);
             $sql = owner::findOne($_POST["search"]);
             //print_r($sql);


         }


    public function actionFet()
         {
             print_r($_POST["id"]);
             $sql = owner::findOne($_POST["id"]);
             //print_r($sql);


         }

    public function actionAddpro()
         {
             // $this->view->params['status'] = 'add_project';
             $this->layout = "main";
             return $this->render("add_project");


         }

    public function actionsEdit()
         {

             $this->view->params['status'] = 'admin_edit_staff';
             $this->layout = "main_modules";
             $sql = Project::find()
                 ->all();
             $data = [];
             $data["sql2"] = $sql;
             return $this->render("admin_edit_staff", $data);
         }

    public function actionMember()
         {
             $this->view->params['status'] = 'member';
             $this->layout = "main_modules";
             $sql = Project::find()
                 ->all();
             $data = [];
             $data["sql2"] = $sql;
             return $this->render("member", $data);
         }

    public function actionIndex3()
         {
             $this->view->params['status'] = 'index';
             $this->layout = "main_modules";
             return $this->render('index');
         }

    public function actionReward()
         {
             $this->view->params['status'] = 'Reward';
             $this->layout = "main_modules";
             return $this->render('//reward/Reward');

         }

    public function actionShowpro()
         {
             $this->view->params['status'] = 'Show2';
             $this->layout = "main_modules";

             //$sql = models\Project::find()->all();//::find()->all();
             //      return Json::encode($sql);
             //$sql = academic_conference::find()->joinwith('cost')->joinWith('member')->all();
             $sql = Project::find()
                 ->innerJoinWith('Person',fals)
                 ->innerJoinWith('models\publishcation',fals)
                 ->innerJoinWith('models\reward',fals)
                 ->all();

             $data = [];
             $data["sql2"] = $sql;
             return $this->render("Show2", $data);
//        return Json::encode($sql);
         }

    public function actionShow()
         {
             $this->view->params['status'] = 'Show1';
             $this->layout = "main";


             $projects = Project::find()->all();

             $data["projects"] = $projects;



             return $this->render("Show1", $data);

         }

    public function actionSave()
    {


        $Y = date("Y");
        $j = date("j");//วัน
        $n = date("n");//เดือน
        $Y = date("Y");//ปี

        $Y = $Y + 543;
        $j = $j + 1;//วัน


        $date = date("$j/$n/$Y");


        if (isset($_POST)) {

            $newsid = $_POST['owner_id'];
            $newsow = $_POST['owner_name'];
            $news_pro_thai = $_POST['project_name_thai'];
            $news_pro_eng = $_POST['project_name_eng'];
            $news_led_fn = $_POST['project_led_fname'];
            $news_led_ln = $_POST['project_led_lname'];
            $news_stat_y = $_POST['project_start'];
            $news_end_y = $_POST['project_end'];
            $news_du = $_POST['project_duration'];
            $news_bu = $_POST['project_budget'];
            $news_re = $_POST['repayment'];
            $news_url = $_POST['project_url'];

            //$newsname = $_POST['pub_name'];
            //$newspic = $_POST['reward_title_thai'];


            $owner = new owner();
            $owner->owner_id = $newsid;
            $owner->owner_name = $newsow;
            if (!$owner->save()) return print_r($owner->errors);


            $pro = new Project();
            $pro->project_id = $owner->owner_id;
            $pro->project_name_thai = $news_pro_thai;
            $pro->project_name_eng = $news_pro_eng;
            $pro->project_led_fname = $news_led_fn;
            $pro->project_led_lname = $news_led_ln;
            $pro->project_start = $news_stat_y;
            $pro->project_end = $news_end_y;
            $pro->project_duration = $news_du;
            $pro->project_budget = $news_bu;
            $pro->repayment = $news_re;
            $pro->project_url = $news_url;
            if (!$pro->save()) return print_r($pro->errors);
            $owop = new ProjectHasOwner();
            $owop->project_project_id = $pro->project_id;
            $owop->owner_owner_id = $newsid;
            if (!$owop->save()) return print_r($owop->errors);

            //   $pub = new models\publishcation();
            //   $pub->pub_id = $owop->project_project_id;
            //   $pub->publishcation_genid_pub_gen_id  = $pro->project_id;
            //   $pub->publishcation_type_pub_type_id = $pro->project_id;
            //   $pub->pub_id = $pro->project_id;
            //   $pub->pub_name = $newsname;


            //        $pub->save();

            //          if(!$pub->save()){
            //          return Json::encode($pub->errors);
            //         }


            //$re = new models\reward;
            //$re->reward_title_thai = $newspic;
            //$re->save();
            return $this->redirect("/portfolio/web/portfolio_system/test/show");


            /* $sql = "INSERT INTO record(RecordID,RecordName,Weightvalue,Database) VALUES
    ('" . $newsid . "','" . $newsname . "','" . $newsdetail . "','" . $newspic . "')";
             $query_sql = mysqli_query($conn, $sql);


             header("location: index.php");
         */
//}

            /*$targetDir = "uploads/";
            $fileName = $_FILES['file']['name'];
            $targetFile = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                //insert file information into db table

            }


            return "string";
            }

            public function actionSql()
            {
                $this->view->params['status'] = 'add_project';
                $this->layout = "main_modules";
                $sql = models\owner::find()->one();
                //      return Json::encode($sql);
                $sql2 = models\publishcation::find()->one();

                $sql3 = models\Project::find()->one();
                $sql4 = models\reward::find()->one();


                $data = [];
                $data["sql2"] = $sql;
                $data["sql3"] = $sql2;
                $data["sql4"] = $sql3;
                $data["sql5"] = $sql4;
                return $this->render("add_project", $data);
            }

            public function actionDelete($det)
            {
                $det1 = models\Project::findOne($det);
            //        return Json::encode($det1->projectHasOwners);
                foreach ($det1->projectHasOwners as $projectHasOwner) {
                    $projectHasOwner->delete();
                    $projectHasOwner->ownerOwner->delete();
                }
                $det1->delete();
                return $this->redirect("/portfolio/web/portfolio/portfolio/show");
            }

            public function actionEdit($pro1)
            {
                $this->view->params['status'] = 'Show1';
                $this->layout = "main_modules";
                $ed = models\Project::findOne($pro1);

                //$ed1->update(array());
                //return Json::encode($ed);


                $dataedit = [];
                $dataedit["row"] = $ed;
                return $this->render("edit_project", $dataedit);

            }


            public function actionEdited()
            {
                if (isset($_POST)) {

                    $newsid = $_POST['owner_id'];
                    $newsow = $_POST['owner_name'];
                    $news_pro_thai = $_POST['project_name_thai'];
                    $news_pro_eng = $_POST['project_name_eng'];
                    $news_led_fn = $_POST['project_led_fname'];
                    $news_led_ln = $_POST['project_led_lname'];
                    $news_stat_y = $_POST['project_start'];
                    $news_end_y = $_POST['project_end'];
                    $news_du = $_POST['project_duration'];
                    $news_bu = $_POST['project_budget'];
                    $news_re = $_POST['repayment'];
                    $news_url = $_POST['project_url'];

                    //$newsname = $_POST['pub_name'];
                    //$newspic = $_POST['reward_title_thai'];


                    $pro = models\Project::findOne($newsid);
                    $pro->project_name_thai = $news_pro_thai;
                    $pro->project_name_eng = $news_pro_eng;
                    $pro->project_led_fname = $news_led_fn;
                    $pro->project_led_lname = $news_led_ln;
                    $pro->project_start = $news_stat_y;
                    $pro->project_end = $news_end_y;
                    $pro->project_duration = $news_du;
                    $pro->project_budget = $news_bu;
                    $pro->repayment = $news_re;
                    $pro->project_url = $news_url;
                    if (!$pro->save()) return print_r($pro->errors);


                    return $this->redirect("/portfolio/web/portfolio/portfolio/show");


                }


            }

            }


            $content = $this->renderPartial('excelreport',[
                              'model' => $dataProvider,
                              'count' => $count
                      ]);
                      $fileName = 'PersonReport'.time().'.xls';
                      $options = ['mimeType' => 'application/vnd.ms-excel'];

                      Yii::$app->response->sendContentAsFile($content, $fileName,$options);
                      Yii::$app->end();
                 }*/


        }
    }
}
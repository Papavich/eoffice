<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;
use app\modules\scholar_b\models\ScbStudentHasProject;
use app\modules\scholar_b\models\ScbTeacher;
use app\modules\scholar_b\models\ScbTeacherHasProject;
use app\modules\scholar_b\models\ScbYearHasSemester;
use Yii;
use app\modules\scholar_b\models\ScbProject;
use app\modules\scholar_b\models\ScbProjectSearch;
use app\modules\scholar_b\models\ScbProjectType;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\uploadedFile;

Yii::setAlias('@root', realpath(dirname(__FILE__) . '/../../../web/'));

/**
 * ProjectController implements the CRUD actions for ScbProject model.
 */
class ProjectController extends Controller
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
     * Lists all ScbProject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model_project = new ScbProject();
        $proj_type = ScbProjectType::find()->all();
        $adviser_central = EofficeCentralViewPisPerson::find()->where(['person_type' => '1'])->all();
        $student_project = new ScbStudentHasProject();
        $semes_year = ScbYearHasSemester::find()->all();

        $find_std_project = ScbStudentHasProject::find()->where(['student_id' => Yii::$app->user->identity->username])->all();

        // return Json::encode($find_std_project);
        // exit;


        return $this->render('index', [
            'model_project' => $model_project,
            'proj_type' => $proj_type,
            'adviser_central' => $adviser_central,
            'student_project' => $student_project,
            'semes_year' => $semes_year,
            'find_std_project' => $find_std_project,


        ]);

    }

    /**
     * Displays a single ScbProject model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($project_code)
    {
        $project = ScbProject::findOne($project_code);
        $adviser_main = ScbTeacherHasProject::find()->where(['project_code' => $project_code,'adviser_status'=>1])->one();
        $adviser_co = ScbTeacherHasProject::find()->where(['project_code' => $project_code,'adviser_status'=>2])->one();


        return $this->render('view', [
            'project' => $project,
            'adviser_main' => $adviser_main,
            'adviser_co' => $adviser_co,
        ]);
    }

    /**
     * Creates a new ScbProject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model_project = new ScbProject();
        $proj_type = ScbProjectType::find()->all();
        $adviser_central = EofficeCentralViewPisPerson::find()->where(['person_type' => '1'])->all();
        $student_project = new ScbStudentHasProject();
        $semes_year = ScbYearHasSemester::find()->all();

        $find_std_project = ScbStudentHasProject::find()->where(['student_id' => Yii::$app->user->identity->username]);


        if ($model_project->load(Yii::$app->request->post())) {

            try {
                $model_project->project_file = UploadedFile::getInstance($model_project, 'project_file');
                $model_project->project_file = $model_project->uploadFile();
                $model_project->project_image = UploadedFile::getInstance($model_project, 'project_image');
                $model_project->project_image = $model_project->uploadImage();
            } catch (Exception $e) {
            }
            $model_project->pro_status = 0;
            $model_project->save();

            $last_project = ScbProject::find()->orderBy(['project_code' => SORT_DESC])->one();

            $student_project->load(Yii::$app->request->post());
            $student_project->project_code = $last_project->project_code;

            $student_project->save();
            $adviser_main = Yii::$app->request->post('adviser_main');
            $adviser_co = Yii::$app->request->post('adviser_co');


            //---------- adviser_main
            $models_main = new ScbTeacher();
            $models_main->id_card = $adviser_main;
            $data_main = ScbTeacher::findOne($adviser_main);
            if ($data_main == null) {
                $models_main->save();
            }
            $model_main = new ScbTeacherHasProject();
            $model_main->teacher_id_card = $adviser_main;
            $model_main->project_code = $last_project->project_code;
            $model_main->adviser_status = 1;
            if($adviser_main != null && $adviser_main != ""){
                $model_main->save();
            }

            //---------- adviser_main


            //---------- adviser_co
            $models_co = new ScbTeacher();
            $models_co->id_card = $adviser_co;
            $data_co = ScbTeacher::findOne($adviser_co);
            if ($data_co == null) {
                $models_co->save();
            }

            $model_co = new ScbTeacherHasProject();
            $model_co->teacher_id_card = $adviser_co;
            $model_co->project_code = $last_project->project_code;
            $model_co->adviser_status = 2;
            if($adviser_co != null && $adviser_co != ""){
                $model_co->save();
            }
            //------------ adviser_co

            return $this->actionIndex();

        } else {
            return $this->actionIndex();
        }
    }

    /**
     * Updates an existing ScbProject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($student_id, $year, $semester, $project_code)
    {


        $model_project = ScbProject::find()->where(['project_code' => $project_code])->one();
        $proj_type = ScbProjectType::find()->all();
        $student_project = ScbStudentHasProject::find()->where(['student_id' => $student_id, 'year' => $year, 'semester' => $semester, 'project_code' => $project_code])->one();
        $semes_year = ScbYearHasSemester::find()->all();
        $adviser_central = EofficeCentralViewPisPerson::find()->where(['person_type' => '1'])->all();
        $adviser_main = ScbTeacherHasProject::find()->where(['project_code' => $project_code,'adviser_status'=>1])->one()->teacher_id_card;
        $adviser_co = ScbTeacherHasProject::find()->where(['project_code' => $project_code,'adviser_status'=>2])->one()->teacher_id_card;

        if (Yii::$app->request->post()) {
            $model_project->load(Yii::$app->request->post());
            try {
                $model_project->project_file = UploadedFile::getInstance($model_project, 'project_file');
                $model_project->project_file = $model_project->uploadFile();
                $model_project->project_image = UploadedFile::getInstance($model_project, 'project_image');
                $model_project->project_image = $model_project->uploadImage();
            } catch (Exception $e) {
            }
            $model_project->pro_status = 0;
            $model_project->save();

            $student_project->load(Yii::$app->request->post());
            $student_project->save();

            $adviser_main = Yii::$app->request->post('adviser_main');
            $adviser_co = Yii::$app->request->post('adviser_co');

            //---------- adviser_main
            if($adviser_main){
                $models_main = new ScbTeacher();
                $models_main->id_card = $adviser_main;
                $data_main = ScbTeacher::findOne($adviser_main);
                if ($data_main == null) {
                    $models_main->save();
                }
                $data = ScbTeacherHasProject::find()->where(['project_code'=>$project_code,'adviser_status'=>1])->one();
                if($data){
                    $data->teacher_id_card = $adviser_main;
                    $data->save(false);
                }
                else{
                    $model_main = new ScbTeacherHasProject();
                    $model_main->teacher_id_card = $adviser_main;
                    $model_main->project_code = $project_code;
                    $model_main->adviser_status = 1;
                    if($adviser_main != null && $adviser_main != ""){
                        $model_main->save(false);
                    }
                }
            }
            //---------- adviser_main


            //---------- adviser_co
            if($adviser_co){
                $model_co = new ScbTeacher();
                $model_co->id_card = $adviser_co;
                $data_co = ScbTeacher::findOne($adviser_co);
                if ($data_co == null) {
                    $model_co->save();
                }
                $data = ScbTeacherHasProject::find()->where(['project_code'=>$project_code,'adviser_status'=>2])->one();
                if($data){
                    $data->teacher_id_card = $adviser_co;
                    $data->save(false);
                }else{
                    $model_co = new ScbTeacherHasProject();
                    $model_co->teacher_id_card = $adviser_co;
                    $model_co->project_code = $project_code;
                    $model_co->adviser_status = 2;
                    if($adviser_co != null && $adviser_co != ""){
                        $model_co->save(false);
                    }
                }
            }
            //------------ adviser_co

            return $this->actionIndex();

        }

        $this->layout = "main_module";
        return $this->render('update', [
            'model_project' => $model_project,
            'student_project' => $student_project,
            'proj_type' => $proj_type,
            'semes_year' => $semes_year,
            'adviser_central' => $adviser_central,
            'adviser_main' => $adviser_main,
            'adviser_co' => $adviser_co,
        ]);
    }

    /**
     * Deletes an existing ScbProject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteone($project_code)
    {
        $model = ScbProject::find()->where(['project_code' => $project_code])->one();
        try {
            if ($model->project_image != null && $model->project_file != null) {
                unlink(Yii::getAlias('@root') . $model->uploadImageFolder . '/' . $model->project_image);
                unlink(Yii::getAlias('@root') . $model->uploadFilesFolder . '/' . $model->project_file);
            } else if ($model->project_image == null && $model->project_file != null) {
                unlink(Yii::getAlias('@root') . $model->uploadFilesFolder . '/' . $model->project_file);
            } else if ($model->project_image != null && $model->project_file == null) {
                unlink(Yii::getAlias('@root') . $model->uploadImageFolder . '/' . $model->project_image);
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'ลบข้อมูลเรียบร้อยแล้ว');
            return $this->redirect(['index']);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('success', 'มีข้อผิดพลาด');
            return $this->redirect(['index']);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the ScbProject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ScbProject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScbProject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

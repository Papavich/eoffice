<?php

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\File;
use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\ScbCondition;
use app\modules\scholar_b\models\ScbConditionHasStudent;
use app\modules\scholar_b\models\ScbEnrollScholarship;
use app\modules\scholar_b\models\ScbScholarshipType;
use app\modules\scholar_b\models\ScbScholarshipTypeHasYear;
use app\modules\scholar_b\models\ScbScore;
use app\modules\scholar_b\models\ScbSelectBranch;
use app\modules\scholar_b\models\ScbSelectMajor;
use app\modules\scholar_b\models\ScbStudent;
use Yii;
use app\modules\scholar_b\models\ScbAddressCandidate;
use app\modules\scholar_b\models\ScbAddressParent;
use app\modules\scholar_b\models\ScbCandidateHasParents;
use app\modules\scholar_b\models\ScbCandidate;
use app\modules\scholar_b\models\ScbParents;
use app\modules\scholar_b\models\ScoreDAO;
use app\modules\scholar_b\models\ScbCandidateSearch;
use yii\base\DynamicModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * CandidateController implements the CRUD actions for ScbCandidate model.
 */
class CandidateController extends Controller
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
     * Lists all ScbCandidate models.
     * @return mixed
     */

    public function actionListCandidate()
    {
        $this->layout = "main_module";
        $candidate = ScbCandidate::find()->all();

        return $this->render('list-candidate', [
            'candidate' => $candidate,

        ]);

    }

    public function actionDetailcandidate($id)
    {
        $this->layout = "main_module";
        $model_candidate = ScbCandidate::findOne($id);

        $model_address = ScbAddressCandidate::find()
            ->where(['scb_candidate_id_card' => $id])->all();

        return $this->render('detailcandidate', [
            'model_candidate' => $model_candidate,
            'model_address' => $model_address

        ]);
    }

    // function เพิ่มคะแนนในทุนช้างเผือก
    public function actionCreatescore()
    {
        $sci = Yii::$app->request->get('sci');
        $math = Yii::$app->request->get('math');
        $com = Yii::$app->request->get('com');
        $id = Yii::$app->request->get('id');
        $data = " ";
        /*echo $sci . $math .$com . $id.'ขึ้นแต่id';*/
        $model_score = new ScoreDAO();
        if (!empty($sci) && !empty($math) && !empty($com) && !empty($id)) {
            $model_score->scoreCandidate($sci, $math, $com, $id);
        }
        /* echo $data;*/
        return $this->redirect(['../scholar_b/candidate/detailcandidate?id=' . $id]);
    }

    // function update คะแนนในทุนช้างเผือก
//    public function actionUpdatescore()
//    {
//        $sci = Yii::$app->request->get('sci');
//        $math = Yii::$app->request->get('math');
//        $com = Yii::$app->request->get('com');
//        $id = Yii::$app->request->get('id');
//        $data = " ";
//        /*echo $sci . $math .$com . $id.'ขึ้นแต่id';*/
//        $model_score = new ScoreDAO();
//        if (!empty($sci) && !empty($math) && !empty($com) && !empty($id)) {
//            $model_score->scoreCandidate($sci, $math, $com, $id);
//        }
//        /* echo $data;*/
//        return $this->redirect(['../scholar_b/candidate/detailcandidate?id=' . $id]);
//    }

    /**
     * Displays a single ScbCandidate model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = "main_guest";
        $model = ScbCandidate::findOne($id);
        $address_candidate = ScbAddressCandidate::find()
            ->where(['scb_candidate_id_card' => $id])->all();

        return $this->render('view', [
            'model' => $model,
            'address_candidate' => $address_candidate,
        ]);
    }

    /**
     * Creates a new ScbCandidate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_guest";

        $models = [
            'model1' => new ScbParents(),
            'model2' => new ScbParents(),
        ];

        $model_candidate = new ScbCandidate();
        $model_address = new ScbAddressCandidate();

        $model_address_parent = new ScbAddressParent();

        $model_candidate->status = "รอ";
        $model_candidate->crby = 1;
        $model_candidate->udby = 1;

        $model_address->crby = 1;
        $model_address->udby = 1;

        $request = Yii::$app->getRequest();
        if ($request->isPost && $request->post('ajax') !== null) {
            $model_candidate->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            $result = ActiveForm::validate($model_candidate);
            return $result;
        }

        if ($model_candidate->load(Yii::$app->request->post())) {

            $model_candidate->save();

            $model_address->load(Yii::$app->request->post());
            $model_address->scb_candidate_id_card = $model_candidate->id_card;
            $model_address->save();

            if (Yii::$app->request->isAjax && Model::loadMultiple($models, Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                $validate = [];
                $validate = array_merge(ActiveForm::validateMultiple($models), $validate);
                // If you need to validate another models, put below.
                // $validate = array_merge(ActiveForm::validate($anotherModel), $validate);

                return $validate;
            }

            if (Model::loadMultiple($models, Yii::$app->request->post())) {
                foreach ($models as $key => $model) {
                    $model->save();
                    $model_parents_candidate = new ScbCandidateHasParents;
                    $model_parents_candidate->scb_parents_id_card_parent = $model->id_card_parent;
                    $model_parents_candidate->scb_candidate_id_card = $model_candidate->id_card;
                    $model_parents_candidate->save();

                }
            }

            return $this->redirect(['view', 'id' => $model_candidate->id_card,
                $model_address->address_type,
                $model_parents_candidate->scb_candidate_id_card,
                $model_address_parent->scb_parents_id_card_parent

            ]);
        } else {
            return $this->render('create', [
                'model_candidate' => $model_candidate,
                'model_address' => $model_address,
                'model_address_parent' => $model_address_parent,
                'models' => $models
            ]);
        }
    }

    /**
     * Updates an existing ScbCandidate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $user = ScbCandidate::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("The user was not found.");
        }

        $model_address = ScbAddressCandidate::findOne($user->id_card);
        if (!$model_address) {
            throw new NotFoundHttpException("The user has no address.");
        }
        $user->scenario = 'update';
        $model_address->scenario = 'update';

        if ($user->load(Yii::$app->request->post()) && $model_address->load(Yii::$app->request->post())) {
            $isValid = $user->validate();
            $isValid = $model_address->validate() && $isValid;
            if ($isValid) {
                $user->save(false);
                $model_address->save(false);
                return $this->redirect(['user/view', 'id' => $id]);
            }
        }

        return $this->render('update', [
            'user' => $user,
            'address' => $model_address,
        ]);


//        if ($user->load(Yii::$app->request->post()) &&
//            $model_address->load(Yii::$app->request->post()) &&
//            Model::validateMultiple([$user, $model_address])
//        ) {
//            if ($model_address->save()) {
//                $user->save();
//            }
//            return $this->redirect(['view', 'id' => $user->id]);
//        } else {
//            return $this->render('update', [
//                'user' => $user,
//                'model_address' => $model_address
//            ]);
//        }
    }

    public function actionForgotPassword()
    {
        $this->layout = "main_guest";
        return $this->render('forgot-password');
    }

    public function actionAccountScb()
    {
        $this->layout = "main_user";
        return $this->render('account-scb');
    }


    /**
     * Deletes an existing ScbCandidate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)
            ->where(['scb_candidate_id_card' => $id])
            ->delete();

        return $this->redirect(['index']);
    }

    public function actionList()
    {
        $this->layout = "main_module";
        $candidate = ScbCandidate::find()->all();
        $sc_year = ScbScholarshipTypeHasYear::find()->orderBy(['date_end' => SORT_DESC])->all();

        return $this->render('list', [
            'candidate' => $candidate,
            'sc_year' => $sc_year
        ]);

    }


    /**
     * Finds the ScbCandidate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ScbCandidate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScbCandidate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelAddress($id)
    {
        if (($model = ScbAddressCandidate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionListBySc()
    {
        $id = Yii::$app->request->get('id');
        $year = Yii::$app->request->get('year');
        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post('id');
            $year = Yii::$app->request->post('year');
        }
        $enroll = ScbEnrollScholarship::find()->where(['scholarship_id' => $id, 'scholarship_year' => $year])->all();
        //$data = \app\modules\scholar_b\models\ScbCandidate::find()->where(['id_card' => $item->candidate_id_card])->one();
        $sc_name = ScbScholarshipTypeHasYear::find()->where(['scholarship_id' => $id, 'scholarship_year' => $year])->all();
        //return Json::encode($model);
//===================================Start Import================================================
        $modelFile = new File();



        if ($modelFile->load(\Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($modelFile, 'file');
            $filename = 'Data.' . $file->extension;
            $upload = $file->saveAs('web_scb/uploads/import' . $filename);

            if ($upload) {
                define('XLSX', 'web_scb/uploads/import');
                $csv_file = XLSX . $filename;
                $filecsv = file($csv_file);
                try {
                    $inputFileType = \PHPExcel_IOFactory::identify($csv_file);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($csv_file);

                } catch (Exception $e) {
                    die('Error');
                }
                $sheet = $objPHPExcel->getSheet(0);
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $headingsArray = $objWorksheet->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
                $headingsArray = $headingsArray[1];
                $r = -1;
                $namedDataArray = array();
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $key = true;
                    $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        $candidate = new ScbCandidate();


                        $model = $candidate->getAttributes(); //Get เเอา attribute name in db
                        foreach (array_keys($model) as $keyModel => $item) {
                            foreach ($headingsArray as $columnKey => $columnHeading) {
                                $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                                if ($columnHeading == $item) {
                                    $candidate->$item = (string)$namedDataArray[$r][$columnHeading]; //ถ้าตรงกันให้ใส่ข้อมูลลง
                                }
                            }
                        }

                        if ($candidate->save()) {
                            $enroll = new ScbEnrollScholarship();
                            // var_dump($branch->errors);
                            $enroll->candidate_id_card = $namedDataArray[$r]["id_card"];
                            $enroll->scholarship_id = $id;
                            $enroll->scholarship_year = $year;
                            $enroll->save();

                            $major = new ScbSelectMajor();
                            $major->candidate_id_card = $namedDataArray[$r]["id_card"];
                            $major->scholarship_id = $id;
                            $major->scholarship_year = $year;
                            $major->major_code = $namedDataArray[$r]["major"];
                            $major->save();

                        }
                    }
                }

                unlink('web_scb/uploads/import' . $filename);

            }

            return $this->redirect(['list-by-sc', 'id' => $id, 'year' => $year
            ]);
        } else {
            return $this->render('list-by-sc', [
                'enroll' => $enroll,
                'sc_name' => $sc_name,
                'modelFile' => $modelFile,
                'id' => $id,
                'year' => $year,
            ]);
        }

//===================================End Import=================================================

    }


    public function actionStatus()
    {

        $check = Yii::$app->request->post('check');
        $status = Yii::$app->request->post('status');
        $id = Yii::$app->request->post('id');
        $year = Yii::$app->request->post('year');
        if ($check) {
            if ($status == 1) {
                foreach ($check as $key => $row) {
                    $model = ScbCandidate::findOne($row);
                    $model->status = "ไม่ผ่านเกณฑ์";
                    $model->save(false);
                }

            } else if ($status == 2) {
                foreach ($check as $key => $row) {
                    $model = ScbCandidate::findOne($row);
                    $model->status = "มีสิทธิ์สอบสัมภาษณ์";
                    $model->save(false);
                }
            } else if ($status == 3) {
                foreach ($check as $key => $row) {
                    $model = ScbCandidate::findOne($row);
                    $model->status = "มีสิทธิ์เข้าศึกษา";
                    $model->save(false);
                }
            } else if ($status == 4) {
                foreach ($check as $key => $row) {
                    $model = ScbCandidate::findOne($row);
                    $model->status = "รายงานตัว";
                    $model->save(false);
                    //s;lgnmerpongierokgrhngjerofd

                    $std_full = EofficeCentralViewStudentFull::find()->where(['CITIZENID' => $row])->one();

                    $model_std = new ScbStudent();
                    $model_std->student_id = $std_full->STUDENTCODE;
                    $model_std->scholarship_year = $year;
                    $model_std->scholarship_id = $id;
                    $model_std->status_edu = '1';
                    $model_std->out_of_scb_status = '0';
                    $model_std->save(false);
                    $model_con = ScbCondition::find()->where(['scholarship_id' => $id, 'scholarship_year' => $year])->all();
                    foreach ($model_con as $item) {
                        $model_con_has_std = new ScbConditionHasStudent();
                        $model_con_has_std->condi_id = $item->condi_id;
                        $model_con_has_std->scholarship_id = $item->scholarship_id;
                        $model_con_has_std->scholarship_year = $item->scholarship_year;
                        $model_con_has_std->student_id = $std_full->STUDENTCODE;
                        $model_con_has_std->save(false);

                    }


                }

            }
            return $this->redirect(['list-by-sc', 'id' => $id, 'year' => $year
            ]);
        } else {
            return $this->redirect(['list-by-sc', 'id' => $id, 'year' => $year
            ]);
        }

    }

}


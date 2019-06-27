<?php

namespace app\modules\eoffice_form\controllers;

use app\modules\eoffice_form\models\ApproveGroup;
use app\modules\eoffice_form\models\ApprovePosition;
use app\modules\eoffice_form\models\PositionAssign;
use app\modules\eoffice_form\models\ReqApproveGroup;
use app\modules\eoffice_form\models\ReqApproval;
use app\modules\eoffice_form\models\ReqStatus;
use app\modules\eoffice_form\models\PositionActing;
use app\modules\eoffice_form\models\ReqTemplate;
use app\modules\eoffice_form\models\ReqTracking;
use app\modules\eoffice_form\models\ViewPisBoardOfDirectors;
use app\modules\eoffice_form\models\ViewPisPerson;
use app\modules\eoffice_form\models\ViewStudentFull;
use app\modules\eoffice_form\models\ViewStudentJoinUser;
use Yii;
use app\modules\eoffice_form\models\UserRequest;
use app\modules\eoffice_form\models\UserRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\eoffice_form\models\AttributeData;
use app\modules\eoffice_form\models\DesignAttribute;
use app\modules\eoffice_form\models\DesignSection;


/**
 * UserRequestController implements the CRUD actions for UserRequest model.
 */
class UserRequestController extends Controller
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
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "main_modules";
        $searchModel = new UserRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRequest model.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year),
        ]);
    }

    /**
     * Creates a new UserRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = "main_modules";
        $model = new UserRequest();

        if ($model->load(Yii::$app->request->post())) {
            $session = Yii::$app->session;
            $session['user_id'] = $_POST['UserRequest']['user_id'];
            $session['template_id'] = $_POST['UserRequest']['template_id'];
            $session['cr_date'] = $_POST['UserRequest']['cr_date'];
            $session['cr_term'] = $_POST['UserRequest']['cr_term'];
            $session['cr_year'] = $_POST['UserRequest']['cr_year'];


            $checkREQ = UserRequest::find()
                ->where([
                    'user_id' => $_POST['UserRequest']['user_id'],
                    'template_id' => $_POST['UserRequest']['template_id'],
                    'cr_date' => $_POST['UserRequest']['cr_date'],
                    'cr_term' => $_POST['UserRequest']['cr_term'],
                    'cr_year' => $_POST['UserRequest']['cr_year'],
                ])
                ->all();
            if (count($checkREQ) == 0) {
                return $this->render('req_form', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('reject', [
                    'template_id' => $_POST['UserRequest']['template_id'],
                    'cr_date' => $_POST['UserRequest']['cr_date'],
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year]);
        }*/


    }

    public function actionGetInput()
    {
        $model = new UserRequest();
        $session = Yii::$app->session;
        $this->layout = "main_modules";
        $field_value = [];
        $field_name = [];
        $field_type = [];
        $field_ref = [];
        $count = 0;

        $getDesignSection = DesignSection::find()->where(['template_id' => $session['template_id']])->orderBy('design_section_order')->all();
        foreach ($getDesignSection as $item) {
            //$DesignSection[] = $item->design_section_id;
            $getDesignAttribute = DesignAttribute::find()->where(['design_section_id' => $item->design_section_id])->orderBy('attribute_order')->all();
            foreach ($getDesignAttribute as $attribute) {
                switch ($attribute->attributeType->attribute_type_name) {
                    case "Textbox":
                        array_push($field_ref, $attribute->attribute_ref);
                        array_push($field_name, $attribute->attribute_name);
                        array_push($field_type, $attribute->attributeType->attribute_type_name);
                        $count++;
                        break;
                    case "Areabox":
                        array_push($field_ref, $attribute->attribute_ref);
                        array_push($field_name, $attribute->attribute_name);
                        array_push($field_type, $attribute->attributeType->attribute_type_name);
                        $count++;
                        break;
                    case "Checkbox":
                        $getAttributeList = AttributeData::find()->where(['attribute_ref' => $attribute->attribute_ref])->orderBy('attribute_order')->all();
                        count($getAttributeList);
                        array_push($field_ref, $attribute->attribute_ref);
                        array_push($field_name, $attribute->attribute_name);
                        array_push($field_type, $attribute->attributeType->attribute_type_name);
                        $count++;
                        break;
                    case "Radiobox":
                        array_push($field_ref, $attribute->attribute_ref);
                        array_push($field_name, $attribute->attribute_name);
                        array_push($field_type, $attribute->attributeType->attribute_type_name);
                        $count++;
                        break;
                    case "Selectbox":
                        array_push($field_ref, $attribute->attribute_ref);
                        array_push($field_name, $attribute->attribute_name);
                        array_push($field_type, $attribute->attributeType->attribute_type_name);
                        $count++;
                        break;
                    case "Datepicker":
                        array_push($field_ref, $attribute->attribute_ref);
                        array_push($field_name, $attribute->attribute_name);
                        array_push($field_type, $attribute->attributeType->attribute_type_name);
                        $count++;
                        break;
                    case "Paragraph":
                        break;
                    case "File Upload":
                        array_push($field_ref, $attribute->attribute_ref);
                        array_push($field_name, $attribute->attribute_name);
                        array_push($field_type, $attribute->attributeType->attribute_type_name);
                        $count++;
                        break;
                    case "Picture":
                        break;
                }
            }
        }

        $field = [];
        $AllField = [];

        $sum = 0;
        for ($i = 0; $i < $count; $i++) {
            $field['field_ref'] = $field_ref[$i];
            $field['field_name'] = $field_name[$i];
            $field['field_type'] = $field_type[$i];
            $field['field_value'] = $_POST[$field_name[$i]];
            //$sum = $sum + count($_POST[$field_name[$i]]);
            array_push($AllField, $field);
        }
        $session['AllField'] = $AllField;

        return $this->render('preview', [
            'AllField' => $AllField,
            'model' => $model,
            //'count' => $sum,
        ]);
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $this->layout = "main_modules";

        $model = new UserRequest();
        if (isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $UserRequest = new UserRequest();
            $UserRequest->user_id = $session['user_id'];
            $UserRequest->cr_date = date('Y-m-d');
            $UserRequest->cr_term = $session['cr_term'];
            $UserRequest->cr_year = $session['cr_year'];
            $UserRequest->template_id = $session['template_id'];
            $UserRequest->req_json = (json_encode($session['AllField'], JSON_UNESCAPED_UNICODE));
            $UserRequest->save();
        }

        $model = new ReqTracking();
        if (isset($_POST)) {
            $model->load(Yii::$app->request->post());
            $ReqStatus = new ReqTracking();
            $ReqStatus->user_id = $session['user_id'];
            $ReqStatus->cr_date = date('Y-m-d');
            $ReqStatus->cr_term = $session['cr_term'];
            $ReqStatus->cr_year = $session['cr_year'];
            $ReqStatus->template_id = $session['template_id'];
            $ReqStatus->req_status = 'กำลังดำเนินการ';
            $ReqStatus->save();
        }

        $model = new ReqApproveGroup();
        if (isset($_POST)) {
            $temp = ApproveGroup::find()->where(['template_id' => $session['template_id']])->orderBy(['group_order' => SORT_ASC])->all();
            $group_queue = 1;
            foreach ($temp as $app_group) {
                $model->load(Yii::$app->request->post());
                $ReqApproveGroup = new ReqApproveGroup();
                $ReqApproveGroup->user_id = $session['user_id'];
                $ReqApproveGroup->cr_date = date('Y-m-d');
                $ReqApproveGroup->cr_term = $session['cr_term'];
                $ReqApproveGroup->cr_year = $session['cr_year'];
                $ReqApproveGroup->template_id = $session['template_id'];
                $ReqApproveGroup->approve_group_name = $app_group->group_name;
                $ReqApproveGroup->approve_group_queue = $group_queue;
                $ReqApproveGroup->approve_group_status = 'กำลังดำเนินการ';
                if ($group_queue == 1) {
                    $ReqApproveGroup->approve_group_visible = 'Visible';
                } else {
                    $ReqApproveGroup->approve_group_visible = 'Invisible';
                }
                $ReqApproveGroup->save();
                $approve = ApprovePosition::find()->where(['approve_group_id' => $app_group->group_id])->orderBy(['position_order' => SORT_ASC])->all();
                $position_queue = 1;
                foreach ($approve as $app_position) {
                    $model->load(Yii::$app->request->post());
                    $ApprovePosition = new ReqApproval();
                    $ApprovePosition->user_id = $session['user_id'];
                    $ApprovePosition->template_id = $session['template_id'];
                    $ApprovePosition->cr_date = date('Y-m-d');
                    $ApprovePosition->cr_term = $session['cr_term'];
                    $ApprovePosition->cr_year = $session['cr_year'];
                    $ApprovePosition->approve_group_queue = $group_queue;
                    if ($app_position->position_id == 9999) {
                        $getStdCode = ViewStudentJoinUser::find()->where(['id' => Yii::$app->user->identity->id])->one();
                        $getOfficer = ViewStudentFull::find()->where(['STUDENTID' => $getStdCode['STUDENTID']])->one();
                        $getPersonCard = ViewPisPerson::find()->where(['person_name' => $getOfficer['OFFICERNAME'], 'person_surname' => $getOfficer['OFFICERSURNAME']])->one();
                        $ApprovePosition->approve_id = $getPersonCard['person_card_id'];
                        $ApprovePosition->approve_name = $getPersonCard['PREFIXABB'] . ' ' . $getPersonCard['person_name'] . ' ' . $getPersonCard['person_surname'];
                    } else {
                        $checkActing = PositionActing::find()
                            ->where(['position_id' => $app_position->position_id])
                            ->orderBy('acting_startDate DESC')
                            ->one();
                        $acting = false;
                        if(isset($checkActing)){
                            $ActingDate = [];
                            $date = $checkActing['acting_startDate'];
                            array_push($ActingDate, $date);
                            do {
                                $repeat = strtotime("+1 day", strtotime($date));
                                $date = date('Y-m-d', $repeat);
                                array_push($ActingDate, $date);

                            } while ($checkActing['acting_endDate'] != $date);

                            for ($i = 0; $i < count($ActingDate); $i++) {
                                if ($ActingDate[$i] == date('Y-m-d')) {
                                    $acting = true;
                                }
                            }
                        }



                        if ($acting == true) {
                            $getActing = PositionActing::find()
                                ->where(['position_id' => $app_position->position_id])
                                ->one();
                            if (isset($getActing)) {
                                $getPersonCard = ViewPisPerson::find()->where(['person_card_id' => $getActing['user_id']])->one();
                                $ApprovePosition->approve_id = $getActing['user_id'];
                                $ApprovePosition->approve_name = $getPersonCard['academic_positions_abb_thai'] . ' ' . $getPersonCard['person_name'] . '  ' . $getPersonCard['person_surname'];
                            }
                        } else {
                            $getAssign = PositionAssign::find()
                                ->where(['position_id' => $app_position->position_id])
                                ->one();
                            if (isset($getAssign)) {
                                $getPersonCard = ViewPisPerson::find()->where(['person_card_id' => $getAssign['user_id']])->one();
                                $ApprovePosition->approve_id = $getAssign['user_id'];
                                $ApprovePosition->approve_name = $getPersonCard['academic_positions_abb_thai'] . ' ' . $getPersonCard['person_name'] . '  ' . $getPersonCard['person_surname'];
                            }
                        }
                    }
                    $ApprovePosition->approve_status = 'กำลังดำเนินการ';
                    $ApprovePosition->approve_queue = $position_queue;
                    if ($group_queue == 1 && $position_queue == 1) {
                        $ApprovePosition->approve_visible = 'Visible';
                    } else {
                        $ApprovePosition->approve_visible = 'Invisible';
                    }
                    $ApprovePosition->save();
                    $position_queue++;
                }
                $group_queue++;
            }
        }

        return $this->render('completed', [
        ]);

    }






    /**
     * Updates an existing UserRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $this->layout = "main_modules";
        $model = $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'template_id' => $model->template_id, 'cr_date' => $model->cr_date, 'cr_term' => $model->cr_term, 'cr_year' => $model->cr_year]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        $this->layout = "main_modules";
        $this->findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $template_id
     * @param string $cr_date
     * @param integer $cr_term
     * @param integer $cr_year
     * @return UserRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $template_id, $cr_date, $cr_term, $cr_year)
    {
        if (($model = UserRequest::findOne(['user_id' => $user_id, 'template_id' => $template_id, 'cr_date' => $cr_date, 'cr_term' => $cr_term, 'cr_year' => $cr_year])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

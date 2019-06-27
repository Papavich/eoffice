<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 6/27/2017
 * Time: 2:40 PM
 */

namespace app\modules\correspondence\controllers;


use app\modules\correspondence\models\CmsAddress;
use app\modules\correspondence\models\CmsDocCheck;
use app\modules\correspondence\models\CmsDocDept;
use app\modules\correspondence\models\CmsDocFile;
use app\modules\correspondence\models\CmsDocRollReceive;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\CmsDocSpeed;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\CmsFile;
use app\modules\correspondence\models\CmsInbox;
use app\modules\correspondence\models\DocRollDAO;
use app\modules\correspondence\models\DocumentDAO;
use app\modules\correspondence\models\DocumentGridView;
use app\modules\correspondence\models\ElasticCmsDocument;
use app\modules\correspondence\models\File;
use app\modules\correspondence\models\FileDAO;
use app\modules\correspondence\models\MailDAO;
use app\modules\correspondence\models\gridview\RollGridView;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson;
use app\modules\correspondence\models\User;
use app\modules\correspondence\models\UserDAO;
use Yii;
use yii\data\Pagination;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\LinkPager;

class StaffReceiveController extends Controller
{

    public function actionReceiveRoll()
    {
        $this->layout = "main_module.php";
        $searchModel = new RollGridView();
        $gridColumns = $searchModel->gridColumnsReceiveWithFolder();
        $dataProvider = $searchModel->searchRoll(Yii::$app->request->queryParams);
        //echo Json::encode(Yii::$app->request->queryParams);
        $searchData = $this->setSearchData();
        return $this->render('receive_roll', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $searchData
        ]);
    }

    public function actionReceiveRollInAllFolder()
    {
        $this->layout = "main_module";
        $searchData = $this->setSearchData();
        $searchModel = new DocumentGridView();
        $roll = new RollGridView();
        $gridColumns = $roll->gridColumnsReceiveInFolder();
        $dataProvider = $searchModel->searchReceiveInFolder(Yii::$app->request->queryParams, null);
        //echo Json::encode($gridColumns);
        //echo Json::encode($dataProvider);
        return $this->render('receive_roll_folder-gridView', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $searchData
        ]);
        /*        $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive', 'cms_address'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = cms_address.address_id');
                $countQuery = clone $model_doc;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $models = $model_doc->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
                return $this->render('receive_roll_folder', ['model_doc' => $models
                    , 'pages' => $pages, 'searchData'=>  $searchData]);*/
    }

    public function actionReceiveRollInFolder($id)
    {
        $this->layout = "main_module.php";
        $searchData = $this->setSearchData();
        $searchModel = new DocumentGridView();
        $roll = new RollGridView();
        $gridColumns = $roll->gridColumnsReceiveInFolder();
        $dataProvider = $searchModel->searchReceiveInFolder(Yii::$app->request->queryParams, null);
        //echo Json::encode($gridColumns);
        //echo Json::encode($dataProvider);
        return $this->render('receive_roll_folder-gridView', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $searchData
        ]);
        /*        $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive', 'cms_address'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id');
                $countQuery = clone $model_doc;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $models = $model_doc->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
                return $this->render('receive_roll_folder', ['model_doc' => $models
                    , 'pages' => $pages, 'searchData'=>  $searchData]);*/
    }

    public function actionDetail_book($id)
    {
        $this->layout = "main_module";
        $inbox_reply = CmsInbox::find()->where('doc_id = "' . $_GET['id'] . '"')
            ->all();
        $receiver = new MailDAO();
        $receiver = $receiver->findReceiver($_GET['id']);
        $file = new FileDAO();
        $fileResult = $file->findFileByDocId($_GET['id']);
        $query = $file->findFileByDocIdForPreview($_GET['id']);
        $model_doc = CmsDocument::findOne($id);
        $saver = EofficeCentralViewPisPerson::findOne($model_doc->user->personcode);
        return $this->render('detail_book', ['model_doc' => $model_doc,
            'inbox_reply' => $inbox_reply, 'receiver' => $receiver, 'file' => $fileResult,
            'file_preview' => $query, 'saver' => $saver]);
    }

    /* ****************************************** Insert Receive ***************************************** */
    public function actionCreatereceive()
    {
        $this->layout = "main_module";
        $model_doc = new CmsDocument();

        if ($model_doc->load(Yii::$app->request->post())) {
            if ($model_doc->validate() && $model_doc->save()) {
                $id = substr($_SESSION['doc_roll_receive_id'], -4) + 1;
                while (strlen($id) < 4) {
                    $id = "0" . $id;
                }
                $model_roll = new DocRollDAO();
                $model_elastic = new ElasticCmsDocument();
                $model_ref = new DocumentDAO();
                //check doc_roll_receive_id is not have in DB
                if (!CmsDocRollReceive::findOne($_SESSION['doc_roll_receive_id'])) {
                    $model_roll->createCmsDocRollReceive($_SESSION['doc_roll_receive_id']
                        , $_POST['CmsDocRollReceive']['doc_roll_receive_doing'], $model_doc->doc_id);
                } else {
                    $model_roll->createCmsDocRollReceive(date("Y") . $id
                        , $_POST['CmsDocRollReceive']['doc_roll_receive_doing'], $model_doc->doc_id);
                    $_SESSION['doc_roll_receive_id'] = date("Y") . $id;
                }
                if (!empty($_POST['docIdRef'])) {
                    $model_ref->insertDocRef($model_doc->doc_id, $_POST['docIdRef']);
                }
                $model_elastic->insertElasticCmsDocument($model_doc);
                echo "success";
            } else {
                //print_r($model_doc->getErrors());
                $errors = $model_doc->getErrors();
                echo $errors['doc_date'][0];
            }

        } else {
            $model_doc = new CmsDocument();
            $model_file = new File();
            $model_roll = new CmsDocRollReceive();
            $model_inbox = new CmsInbox();
            $model_secret = new CmsDocSecret();
            $model_speed = new CmsDocSpeed();
            $model_from_dept = new CmsDocDept();
            $model_user = User::find()->all();
            $model_address = new CmsAddress();
            $id = $this->findDocRollId();
            /*
             * ดึงแบบแยกเป็นสมัย
             * $userFromView = $this->getCurrentOfTeacher();
            //get current of board director
            //$boardDirector = $this->getCurrentOfBoardDirector();
            $boardDirector = $this->getCurrentOfBoardDirector();
            //echo Json::encode($boardDirector);
            return $this->render('receive', [
                'model_doc' => $model_doc, 'model_file' => $model_file
                , 'model_roll' => $model_roll, 'model_inbox' => $model_inbox, 'id' => $id,
                'model_secret' => $model_secret, 'model_speed' => $model_speed, 'model_from_dept' => $model_from_dept,
                'model_user' => $model_user, 'model_address' => $model_address,
                'receiver' => $userFromView, 'boardDirector' => $boardDirector
            ]);*/


            $userFromView = EofficeCentralViewPisPerson::find()->all(); //ดึงมาทั้งหมด
            return $this->render('receive', [
                'model_doc' => $model_doc, 'model_file' => $model_file
                , 'model_roll' => $model_roll, 'model_inbox' => $model_inbox, 'id' => $id,
                'model_secret' => $model_secret, 'model_speed' => $model_speed, 'model_from_dept' => $model_from_dept,
                'model_user' => $model_user, 'model_address' => $model_address,
                'receiver' => $userFromView
            ]);

        }
    }

    public function getCurrentOfBoardDirector()
    {
        $boardDirector = EofficeCentralViewPisBoardOfDirectors::find()
            ->orderBy(['period_describe' => SORT_DESC])->all();
        $personcode = [];
        foreach ($boardDirector as $i) {
            array_push($personcode, $i->period_describe . "," . $i->person_id);
        }
        //$personcode = ["สมัยที่ 5 (2553-2556), 25"];
        date_default_timezone_set('Asia/Bangkok');
        foreach ($personcode as $y => $i) {
            //ดึงตัแหน่งของวงเล็บเพื่อที่จะเอาปี
            $first = strpos($personcode[$y], "(");
            $last = strpos($personcode[$y], ")");
            if (substr($personcode[$y], $first, $last)) {
                $currentPeriod = substr($personcode[$y], $first + 6, $last);
                $currentPeriod = substr($currentPeriod, 0, strpos($currentPeriod, ")"));
                //เช็ดปีที่ระยะเวลาบวกลบไม่เกิน 3 ปี
                $year = date('Y') + 543;
                //ตรวจสอบว่าสมัยที่ดำรงยังเกินไม่ครบกำหนดเช่น สมัยที่ 1 (2560-2561) 6เดือน
                if ((int)$currentPeriod - (int)$year > -1) {
//                    echo substr($personcode[$y], strpos($personcode[$y], ",") + 1)
//                        . " " . $currentPeriod . " " . $year
//                        . "<br>";
                    $personcode[$y] = substr($personcode[$y], strpos($personcode[$y], ",") + 1);
                }
            }

        }
        $boardDirector = EofficeCentralViewPisBoardOfDirectors::find()
            ->where(['in', 'eoffice_central.view_pis_board_of_directors.person_id', $personcode])
           ->groupBy(['eoffice_central.view_pis_board_of_directors.person_id'])
            ->all();
        return $boardDirector;

    }
    public function getCurrentOfTeacher()
    {
        $currentOfTeacher = EofficeCentralViewPisBoardOfDirectors::find()
            ->orderBy(['period_describe' => SORT_DESC])->all();
        $personcode = [];
        foreach ($currentOfTeacher as $i) {
            array_push($personcode, $i->period_describe . "," . $i->person_id);
        }
        date_default_timezone_set('Asia/Bangkok');
        foreach ($personcode as $y => $i) {
            //ดึงตัแหน่งของวงเล็บเพื่อที่จะเอาปี
            $first = strpos($personcode[$y], "(");
            $last = strpos($personcode[$y], ")");
            if (substr($personcode[$y], $first, $last)) {
                $currentPeriod = substr($personcode[$y], $first + 6, $last);
                $currentPeriod = substr($currentPeriod, 0, strpos($currentPeriod, ")"));
                //เช็ดปีที่ระยะเวลาบวกลบไม่เกิน 3 ปี
                $year = date('Y') + 543;
                //ตรวจสอบว่าสมัยที่ดำรงยังเกินไม่ครบกำหนดเช่น สมัยที่ 1 (2560-2561) 6เดือน
                if ((int)$currentPeriod - (int)$year > -1) {
//                    echo substr($personcode[$y], strpos($personcode[$y], ",") + 1)
//                        . " " . $currentPeriod . " " . $year
//                        . "<br>";
                    $personcode[$y] = substr($personcode[$y], strpos($personcode[$y], ",") + 1);
                }
            }

        }
        $currentOfTeacher = EofficeCentralViewPisPerson::find()
            ->where(['not in', 'eoffice_central.view_pis_person.person_id', $personcode])
            ->groupBy(['eoffice_central.view_pis_person.person_id'])
            ->all();
        return $currentOfTeacher;

    }

    public function actionTestmail()
    {
        $this->layout = "main_module";
        $model_user = UserDAO::findUser();
        $array = 'สมัยที่ 1 (2560-2561)';
        print_r(explode("(", $array));
        $array = explode("(", $array);
        echo "<br>" . substr($array[1], 0, -1);
        $period = explode("-", substr($array[1], 0, -1));
        date_default_timezone_set('Asia/Bangkok');
        if ($period[1] == date('Y') + 543) {
            $currentPeriod = $period[1];
        }
        //   return $this->render('test3', ['model_user' => $model_user]);

    }

    public function actionTimeline()
    {
        $this->layout = "main_module";
        return $this->render('timeline');
    }

    /* ****************************************** Update Receive ***************************************** */
    public function actionEditReceiveForm($id)
    {
        //session_start();
        $this->layout = "main_module";
        $_SESSION["count"] = 0;
        $receiver = new MailDAO();
        $model_doc = CmsDocument::findOne($id);
        $model_roll = CmsDocRollReceive::find()->where(['doc_id' => $id])->one();
        $model_file = new File();
        $receiverr = $receiver->findReceiver($id);
        $notReceiver = $receiver->findNotReceiver($id);
        // $personDataAPI = Yii::$app->runAction('api/get-person');
        //print_r($notReceiver);
        return $this->render('receive_edit_form', [
            'model_doc' => $model_doc
            , 'model_roll' => $model_roll, 'id' => $id,
            'model_file' => $model_file, 'receiver' => $receiverr,
            'boardDirector'=>$notReceiver[1],
            'notReceiver' => $notReceiver[0],

        ]);
    }

    public function actionUpdateDocdept()
    {
        $model = CmsDocDept::findOne($_POST['id']);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo "";
        }
    }

    public function actionUpdateDocRollReceive($doc_roll_id, $doc_roll_doing)
    {
        $model = new DocRollDAO();
        $model->updateCmsDocRollReceive($doc_roll_id, $doc_roll_doing);
    }

    public function actionUpdateReceiveInCreateReceiveBook($id)
    {
        $model = $this->findModelDocument($id);
        $model_ref = new DocumentDAO();
        $updateElastic = new ElasticCmsDocument();
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->validate()) {
            if (!empty($_POST['docIdRef'])) {
                $model_ref->deleteDocRefInUpdateReceiveInCreateReceiveBook($model->doc_id);
                $model_ref->insertDocRef($model->doc_id, $_POST['docIdRef']);
            } else {
                $model_ref->deleteDocRefInUpdateReceiveInCreateReceiveBook($model->doc_id);
            }
            $updateElastic->updateElastic($id);
            echo "success";
        } else {
            //print_r($model_doc->getErrors());
            $errors = $model->getErrors();
            echo $errors['doc_date'][0];
        }

    }

    public function actionUpdateReceive($id)
    {
        $model = CmsDocument::findOne($id);
        $updateElastic = new ElasticCmsDocument();
        $modelDocRef = new DocumentDAO();
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->validate()) {
            $model_roll = new DocRollDAO();
            $model_roll->updateCmsDocRollReceive($_POST['CmsDocRollReceive']['doc_roll_receive_id'],
                $_POST['CmsDocRollReceive']['doc_roll_receive_doing']);
            if (!empty($_POST['docIdRef'])) {
                $modelDocRef->insertDocRef($model->doc_id, $_POST['docIdRef']);
            }
            $updateElastic->updateElastic($id);
            echo "success";
            //return $this->redirect(['detail_book?id=' . $id]);
        } else {
            $errors = $model->getErrors();
            $error = array();
            $error[0] = array('doc_date' => isset($errors['doc_date'][0]) ? $errors['doc_date'][0] : '');
            $error[1] = array('receive_date' => isset($errors['receive_date'][0]) ? $errors['receive_date'][0] : '');
            $qryResult['data'] = $error;
            echo Json::encode($qryResult);
        }
    }

    public function actionCancelReceive()
    {
        $id = $_POST['id'];
        $model = $this->findModelDocument($id);
        $model->check_id = 2;
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function actionGetIdOfDocId()
    {

        $_SESSION['IdOfDoc'] = $_POST['id'];
        //echo $_SESSION['IdOfDoc'];
    }

    /* ****************************************** Delete Receive ***************************************** */
    public function actionDeleteReceive()
    {
        $model_doc = new DocumentDAO();
        $model_elas = new ElasticCmsDocument();
        $model_doc->deleteDocumentReceive($_POST['id']);
        $model_elas->deleteElastic($_POST['id']);
//        $id = $_POST['id'];
//        $model_doc = CmsDocument::findOne($id);
//        $model_doc->check_id = 2;
//        $model_doc->save();
    }

    public function actionDeleteDocRef()
    {
        $model_doc = new DocumentDAO();
        $model_doc->deleteDocRef($_POST['idref']);
    }

    public function actionDeleteFile($name)
    {
        $model_file = new FileDAO();
        $idFile = CmsFile::find()->where(['file_name' => $name])->one();
        foreach ($idFile->cmsDocFiles as $id) {
            $idDoc = $id->doc_id;
        }
        $directory = \Yii::getAlias('../web/web_cms/uploads/' . $idFile->file_path) . DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }
        //function DeleteFileUpload is in model CmsFile class
        if ($_SESSION["fileOperation"] == "insert") {
            $model_file->DeleteFileUpload($idDoc, $name, $idFile->file_id);
        } else {
            $model_file->DeleteFileUpload($idDoc, $name, $idFile->file_id);
        }
        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = 'uploads' . \Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /*   ********************************** Search **********************************************    */
    public function actionSearchReceive()
    {
        //echo $searchBy.$keyword.$rangeDate.$type;
        $this->layout = "main_module";
        $model_doc = ElasticCmsDocumentController::Search(
            Yii::$app->controller->id);
        $searchModel = new DocumentGridView();
        $roll = new RollGridView();
        $gridColumns = $roll->gridColumnsReceiveInFolder();
        $dataProvider = $searchModel->searchReceiveInFolder(Yii::$app->request->queryParams, $model_doc[0]);
        //echo Json::encode($gridColumns);
        return $this->render('receive_roll_folder-gridView', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $model_doc[1]
        ]);

    }

    public function setSearchData()
    {
        $request = Yii::$app->request;
        $searchBy = $request->get('search_by');
        $keyword = $request->get('keyword');
        $rangeDate = $request->get('range-date');
        $type = $request->get('type');
        //ข้อมูลเอาไปใช้แสดง Input search ที่่เคยกรอก
        $searchData = [
            'keyword' => $keyword,
            'search_by' => $searchBy,
            'range-date' => $rangeDate,
            'type' => $type,
        ];
        return $searchData;
    }

    /*   ********************************** AJAX **********************************************    */
    public function actionSearch()
    {
        $model_from_dept = CmsDocDept::find()
            ->andFilterWhere(['like', 'doc_dept_name', $_GET['keyword']])
            ->limit(10)
            ->all();
        if ($model_from_dept) {
            foreach ($model_from_dept as $row) {
                echo "<option data-customvalue='" . $row["doc_dept_id"] . "'>" . $row["doc_dept_name"] . "</option>";
            }
        }
    }

    public function actionSearchAddress()
    {
        $model_address = CmsAddress::find()
            ->andFilterWhere(['like', 'address_name', $_GET['keyword']])
            ->limit(10)
            ->all();
        if ($model_address) {
            foreach ($model_address as $row) {
                echo "<option value='" . $row["address_name"] . "'>";
            }
        }
    }

    public function actionSearchDocRef()
    {
        $model_doc = CmsDocument::find()
            ->andFilterWhere(['like', 'doc_subject', $_GET['keyword']])
            ->orWhere('doc_id_regist LIKE "%' . $_GET['keyword'] . '%"')
            ->limit(10)
            ->all();
        $i = 0;
        if ($model_doc) {
            foreach ($model_doc as $row) {
                $i++;
                echo "<tr>";
                echo "<td> <input type='checkbox' name='docIdRef[]' value='" . $row["doc_id"] . "'
                       id='" . $row["doc_id"] . "' class='docIdRefe'></td>";
                echo "<td>" . $row["doc_id_regist"] . "</td>";
                echo "<td align='center'>" . $row["doc_subject"] . "</td>";
                echo "<td class='col-sm-2'>" . $row["doc_date"] . "</td>";
                echo "</tr>";
                if ($i == 6) break;
            }
        } else {
            echo "ขออภัย ไม่พบหนังสือที่ท่านค้นหา";
        }
    }

    public function actionSearchUser()
    {
        $model_from_dept = User::find()->andFilterWhere(['like', 'username', $_GET['keyword']])->all();
        if ($model_from_dept) {
            foreach ($model_from_dept as $row) {
                echo "<option data-customvalue='" . $row["id"] . "'>" . $row["username"] . "</option>";
            }
        }
    }

    public function actionSearchTel()
    {
        $model = CmsDocument::find()
            ->andFilterWhere(['like', 'doc_tel', $_GET['keyword']])
            ->limit(10)
            ->groupBy('doc_tel')
            ->all();
        if ($model) {
            foreach ($model as $row) {
                echo "<option data-customvalue='" . $row["doc_tel"] . "'>" . $row["doc_tel"] . "</option>";
            }
        }
    }

    /* ********************************** Find Model **********************************************    */

    private function findDocRollId()
    {
        $model_roll = CmsDocRollReceive::find()->orderBy(['doc_roll_receive_id' => SORT_DESC])->limit(1)->one();
        if ($model_roll != null && substr($model_roll->doc_roll_receive_id, 0, 4) == date("Y")) {
            return substr($model_roll->doc_roll_receive_id, -4);

        } else {
            return "0000";
        }
    }

    protected function findModel($id)
    {
        if (($model = CmsDocRollReceive::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelDocument($id)
    {
        if (($model = CmsDocument::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelDocFile($file_id, $doc_id)
    {
        if (($model = CmsDocFile::findOne(['file_id' => $file_id, 'doc_id' => $doc_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

?>
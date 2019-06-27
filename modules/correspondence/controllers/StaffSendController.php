<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 6/27/2017
 * Time: 2:40 PM
 */

namespace app\modules\correspondence\controllers;


use app\modules\correspondence\models\CmsAddress;
use app\modules\correspondence\models\CmsDocDept;
use app\modules\correspondence\models\CmsDocFile;
use app\modules\correspondence\models\CmsDocFromDept;
use app\modules\correspondence\models\CmsDocRollSend;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\CmsDocSpeed;
use app\modules\correspondence\models\CmsDocToDept;
use app\modules\correspondence\models\CmsDocType;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\CmsFile;
use app\modules\correspondence\models\CmsInbox;
use app\modules\correspondence\models\DeptDAO;
use app\modules\correspondence\models\DocRollDAO;
use app\modules\correspondence\models\DocumentDAO;
use app\modules\correspondence\models\DocumentGridView;
use app\modules\correspondence\models\ElasticCmsDocument;
use app\modules\correspondence\models\File;
use app\modules\correspondence\models\FileDAO;
use app\modules\correspondence\models\gridview\RollGridView;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson;
use app\modules\correspondence\models\User;
use Yii;
use yii\data\Pagination;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\correspondence\controllers;


class StaffSendController extends Controller
{
    public function actionDetail_book()
    {
        $this->layout = "main_module.php";
        $model_doc = CmsDocument::findOne('' . $_GET['id'] . '');
        $file = new FileDAO();
        $file = $file->findFileByDocId($_GET['id']);
        $saver = EofficeCentralViewPisPerson::findOne($model_doc->user->personcode);
        return $this->render('detail_book', ['model_doc' => $model_doc
            , 'file' => $file,'saver'=>$saver]);
    }

    public function actionSendRoll()
    {
        $this->layout = "main_module.php";
        $searchModel = new RollGridView();
        $gridColumns = $searchModel->gridColumnsSendWithFolder(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->searchRoll(Yii::$app->request->queryParams);
        $searchData = $this->setSeacrData();
        //echo Json::encode(Yii::$app->request->queryParams);
        return $this->render('send_roll', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $searchData
        ]);
    }

    public function actionSendRollInFolder($id)
    {
        $this->layout = "main_module.php";
        $searchData = $this->setSeacrData();
        // echo  Yii::$app->request->queryParams['id'];
        $searchModel = new DocumentGridView();
        $roll = new RollGridView();
        $gridColumns = $roll->gridColumnsSendInFolder();
        $dataProvider = $searchModel->searchSendInFolder(Yii::$app->request->queryParams,null);
        //echo Json::encode($gridColumns);
        //echo Json::encode($dataProvider);
        return $this->render('send_roll_folder-gridView', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $searchData
        ]);
        /*        $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send', 'cms_address'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id');
                $countQuery = clone $model_doc;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $models = $model_doc->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
                return $this->render('send_roll_folder', ['model_doc' => $models, 'pages' => $pages,
                    'searchData' => $searchData]);*/
    }

    public function actionSendRollInAllFolder()
    {
        $this->layout = "main_module";
        $searchData = $this->setSeacrData();
        $searchModel = new DocumentGridView();
        $roll = new RollGridView();
        $gridColumns = $roll->gridColumnsSendInFolder();
        $dataProvider = $searchModel->searchSend(Yii::$app->request->queryParams);
        return $this->render('send_roll_folder-gridView', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $searchData
        ]);
        /*        $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send', 'cms_address'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = cms_address.address_id');
                $countQuery = clone $model_doc;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $models = $model_doc->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
                return $this->render('send_roll_folder', ['model_doc' => $models, 'pages' => $pages,
                    'searchData' => $searchData]);*/
    }

    /* *************************** Insert ************************************* */
    public function actionCreateSendRoll()
    {
        $this->layout = "main_module";
        $model_roll = new DocRollDAO();
        $model_doc = new CmsDocument();
        $model_ref = new DocumentDAO();
        $model_elastic = new ElasticCmsDocument();
        if ($model_doc->load(Yii::$app->request->post())) {
            if ($model_doc->validate() && $model_doc->save()) {
                $id = substr($_SESSION['doc_roll_send_id'], -4) + 1;
                while (strlen($id) < 4) {
                    $id = "0" . $id;
                }
                //call function createCmsDocRoll in class CmsDocRoll for insert new record
                if (!CmsDocRollSend::findOne($_SESSION['doc_roll_send_id'])) {
                    $model_roll->createCmsDocRollSend($_SESSION['doc_roll_send_id'], $_POST['CmsDocRollSend']['doc_roll_send_doing']
                        , $model_doc->doc_id);

                } else {
                    $model_roll->createCmsDocRollSend(date("Y") . $id
                        , $_POST['CmsDocRollSend']['doc_roll_send_doing'], $model_doc->doc_id);
                    $_SESSION['doc_roll_send_id'] = date("Y") . $id;
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
            $_SESSION['findDept'] = true;
            $model_doc = new CmsDocument();
            $model_file = new File();
            $model_roll = new CmsDocRollSend();
            $model_inbox = new CmsInbox();
            $model_secret = new CmsDocSecret();
            $model_speed = new CmsDocSpeed();
            $model_to_dept = new CmsDocDept();
            $model_address = new CmsAddress();
            $model_user = User::find()->all();
            $id = $this->findDocRollId();

            return $this->render('send_form', [
                'model_doc' => $model_doc, 'model_file' => $model_file
                , 'model_roll' => $model_roll, 'model_inbox' => $model_inbox, 'id' => $id,
                'model_secret' => $model_secret, 'model_speed' => $model_speed, 'model_to_dept' => $model_to_dept,
                'model_user' => $model_user, 'model_address' => $model_address
            ]);
        }
    }

    /* ****************************************** Update Send ***************************************** */
    public function actionEditSendForm($id)
    {
        //session_start();
        $_SESSION["count"] = 0;
        $model_doc = CmsDocument::findOne($id);
        $model_roll = CmsDocRollSend::find()->where(['doc_id' => $id])->one();

        $model_file = new File();
        $this->layout = "main_module.php";
        return $this->render('send_edit_form', [
            'model_doc' => $model_doc
            , 'model_roll' => $model_roll, 'id' => $id,
            'model_file' => $model_file
        ]);
    }

    public function actionUpdateDocdept()
    {
        $model = CmsDocDept::findOne($_POST['id']);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        }
    }

    public function actionUpdateSendInCreateSendBook($id)
    {
        //when user click back in /staff-send/create-send-book
        $model = $this->findModelDocument($id);
        $updateElastic = new ElasticCmsDocument();
        $model_ref = new DocumentDAO();
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

    public function actionUpdateDocRollSend($doc_roll_id, $doc_roll_doing)
    {
        $model = new DocRollDAO();
        $model->updateCmsDocRollSend($doc_roll_id, $doc_roll_doing);
    }

    public function actionUpdateSend($id)
    {
        $model = $this->findModelDocument($id);
        $modelDocRef = new DocumentDAO();
        $updateElastic = new ElasticCmsDocument();
        if ($model->load(Yii::$app->request->post()) && $model->save()  && $model->validate()) {
            $modelRoll = new DocRollDAO();
            $modelRoll->updateCmsDocRollSend($_POST['CmsDocRollSend']['doc_roll_send_id'],
                $_POST['CmsDocRollSend']['doc_roll_send_doing']);
            if (!empty($_POST['docIdRef'])) {
                $modelDocRef->insertDocRef($model->doc_id, $_POST['docIdRef']);
            }
            $updateElastic->updateElastic($id);
            echo "success";
            return $this->redirect(['detail_book?id=' . $id]);
        }else{
            //print_r($model->getErrors());
            $errors = $model->getErrors();
            $error = array();
            $error[0] = array('doc_date'=>isset($errors['doc_date'][0]) ? $errors['doc_date'][0] : '');
            $error[1]= array('sent_date'=>isset($errors['sent_date'][0]) ? $errors['sent_date'][0] : '');
            $error[2]= array('receive_date'=>isset($errors['receive_date'][0]) ? $errors['receive_date'][0] : '');
            $qryResult['data'] = $error;
            echo Json::encode($qryResult);
        }
    }


    /* ****************************************** Delete Send ***************************************** */
    public function actionDeleteSend()
    {
/*        $model_doc = new DocumentDAO();
        $model_elas = new ElasticCmsDocument();
        $model_doc->deleteDocumentSend($_POST['id']);
        $model_elas->deleteElastic($_POST['id']);*/
        $id = $_POST['id'];
        $model = $this->findModelDocument($id);
        $model->check_id = 2;
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function actionDeleteDocRef()
    {
        $model_doc = new DocumentDAO();
        $model_doc->deleteDocRef($_POST['idref']);
    }


    public function actionDeleteFile($name)
    {
        //session_start();
        $model_file = new FileDAO();
        $idFile = CmsFile::find()->where(['file_name' => $name])->one();
        foreach ($idFile->cmsDocFiles as $id) {
            $idDoc = $id->doc_id;
        }
        $directory = \Yii::getAlias('../web/web_cms/uploads/document-files') . DIRECTORY_SEPARATOR;
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

    /*   ********************************** Search **********************************************    */
    public function actionSearchSend()
    {
        //echo $searchBy.$keyword.$rangeDate.$type;
        $this->layout = "main_module";
        $model_doc = ElasticCmsDocumentController::Search(
            Yii::$app->controller->id);
        $searchModel = new DocumentGridView();
        $roll = new RollGridView();
        $gridColumns = $roll->gridColumnsSendInFolder();
        $dataProvider = $searchModel->searchSendInFolder(Yii::$app->request->queryParams,$model_doc[0]);
        //echo Json::encode($gridColumns);
        //echo Json::encode($dataProvider);
        return $this->render('send_roll_folder-gridView', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns' => $gridColumns,
            'searchData' => $model_doc[1]
        ]);
    }

    public function setSeacrData()
    {
        $request = Yii::$app->request;
        $searchBy = $request->get('search_by');
        $keyword = $request->get('keyword');
        $rangeDate = $request->get('range-date');
        $type = $request->get('type');
        //ข้อมูลเอาไปใช้แสดง Input search ที่่เคยกรอก
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
        $model_to_dept = CmsDocDept::find()
            ->andFilterWhere(['like', 'doc_dept_name', $_GET['keyword']])
            ->limit(10)
            ->all();
        if ($model_to_dept) {
            foreach ($model_to_dept as $row) {
                echo "<option data-customvalue='" . $row["doc_dept_id"] . "'>" . $row["doc_dept_name"] . "</option>";
            }
            $_SESSION['findDept'] = true;
        } else {
            $_SESSION['findDept'] = false;
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
    protected function findModelDocument($id)
    {
        if (($model = CmsDocument::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function findDocRollId()
    {
        $model_roll = CmsDocRollSend::find()->orderBy(['doc_roll_send_id' => SORT_DESC])->limit(1)->one();
        if ($model_roll != null && substr($model_roll->doc_roll_send_id, 0, 4) == date("Y")) {
            return substr($model_roll->doc_roll_send_id, -4);

        } else {
            return "0000";
        }
    }
}

?>
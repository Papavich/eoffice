<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 9/11/2017
 * Time: 10:34 PM
 */

namespace app\modules\correspondence\controllers;


use app\modules\correspondence\models\CmsDocFile;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\CmsFile;
use app\modules\correspondence\models\File;
use app\modules\correspondence\models\FileDAO;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;

class FileController extends Controller
{
    /* ********************************** File ********************************************** */
    /**
     * @param $type
     * @return string
     */
    public function actionUploadFile($type,$id)
    {
        //session_start();
        $model_file = new FileDAO();
        $model = new File();
        $imageFile = UploadedFile::getInstance($model, 'file');
        $docId = "";
        if($type == "receive"){
            $docId = CmsDocument::findOne($id);
        }else{
            $docId = CmsDocument::findOne($id);
        }
        $directory = \Yii::getAlias('../web/web_cms/uploads/document-files') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        if ($imageFile) {
            //rename file
            $fileName = date("dmYHis") . '-' . $imageFile;
            $filePath = $directory . $fileName;

            if ($imageFile->saveAs($filePath)) {
                //function createDocFile is in FileDAO class
                if ($model_file->createDocFile($docId->doc_id, $fileName,'document-files')) {
                    $path = 'uploads' . \Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
                    return Json::encode([
                        'files' => [
                            [
                                'name' => $fileName,
                                'size' => $imageFile->size,
                                'thumbnailUrl' => $path,
                                'deleteUrl' => 'delete-file?name=' . $fileName,
                                'deleteType' => 'POST',
                            ],
                        ],
                    ]);
                }

            }
        }

        return '';
    }

    public function actionUpdateFile($docid)
    {
        //session_start();
        $_SESSION["count"] = 0;
        $model_file = new FileDAO();
        $model = new File();
        $file = UploadedFile::getInstance($model, 'file');
        $directory = \Yii::getAlias('../web/web_cms/uploads/document-files') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
            if ($file) {
                $fileName = date("dmYHis") . '-' . $file;
                $filePath = $directory . $fileName;
                if ($file->saveAs($filePath)) {
                    $model_file->createDocFile($docid, $fileName,'document-files');
                    $path = 'uploads' . \Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
                    return Json::encode([
                        'files' => [
                            [
                                'name' => $fileName,
                                'size' => $file->size,
                                'thumbnailUrl' => $path,
                                'deleteUrl' => 'delete-file?name=' . $fileName,
                                'deleteType' => 'POST',
                            ],
                        ],
                    ]);
                }

            }

        //$_SESSION["count"] += 1;
        return '';
    }

    public function actionDeleteFileInDb($iddoc, $idfile)
    {
        //delete file in edit form page
        $model_cmsdocfile = CmsDocFile::find()->where('doc_id = "' . $iddoc . '" AND file_id = ' . $idfile)->one();
        $model_docfile = CmsFile::findOne($idfile);
        $_SESSION["path"] = $model_docfile->file_path;
        $this->DeleteOldFileForButtonEdit($model_docfile->file_name);
        echo $_SESSION["path"];
        $model_cmsdocfile->delete();
        $model_docfile->delete();
    }

    public function DeleteOldFileForButtonEdit($name)
    {
        //ลบไฟล์เดิมที่อยู่ในฐานข้อมูลตอนที่กำลังเพิ่ม
        $model_file = new FileDAO();
        $directory = \Yii::getAlias('../web/web_cms/uploads/document-files') . DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }
        //function DeleteFileUpload is in model CmsFile class
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

    public function actionDeleteFile($name)
    {
        //ลบไฟล์ขณะที่กำลังเพิ่มข้อมูล
        $model_file = new FileDAO();
        $idFile = CmsFile::find()->where(['file_name'=> $name])->one();
        $directory = \Yii::getAlias('../web/web_cms/uploads/document-files') . DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }
        //function DeleteFileUpload is in model CmsFile class
        if($_SESSION["fileOperation"] == "insert"){
            $model_file->DeleteFileUpload($_SESSION["IdOfDoc"], $name,$idFile->file_id);
        }else{
            $model_file->DeleteFileUpload($_SESSION["iddoc"], $name,$idFile->file_id);
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
}
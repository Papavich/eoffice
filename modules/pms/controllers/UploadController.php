<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 2/2/2561
 * Time: 20:36
 */

namespace app\modules\pms\controllers;

use app\modules\pms\models\PmsDocument;
use yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Json;


use app\modules\pms\models\File;

class UploadController extends Controller
{
    //test
    public function actionCreate(){
        $model_file = new File;
        $model = new PmsDocument;
        $this->layout ="main_module";
        if ($model->load(Yii::$app->request->post())) {
            $model->pms_project_sub_prosub_code="44-23-43-24-32-43";
            $model->document_name="qqweqwe";
            $model->document_name_location="qwewqewq";
            $model->save();
            echo "yes";
            exit;
        }
        return $this->render('create',['model'=>$model,'model_file'=>$model_file]);
    }


    public function actionUpdateFile($id)
    {
        $model = new File();
        $file = UploadedFile::getInstance($model, 'file');
        $directory = \Yii::getAlias('../web/web_pms/uploads/') . DIRECTORY_SEPARATOR;

        if ($file) {
            $fileName = date("dmYHis") . '-' . $file;
            $filePath = $directory . $fileName;
            if ($file->saveAs($filePath)) {
                $path = 'uploads' . \Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
                $models = new PmsDocument;
                $models->pms_project_sub_prosub_code=$id;
                $models->document_name_location="../web/web_pms/uploads/";
                $models->document_name=$fileName;
                $models->save();

                //insert in DB

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
        $directory = \Yii::getAlias('../web/web_pms/uploads/') . DIRECTORY_SEPARATOR;
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
        $directory = \Yii::getAlias('../web/web_pms/uploads/' ). DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $modeldoc = PmsDocument::find()->where(['document_name'=>$name])->one();
        $modeldoc->delete();
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
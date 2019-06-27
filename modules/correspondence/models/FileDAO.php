<?php

namespace app\modules\correspondence\models;


use yii\helpers\FileHelper;

class FileDAO
{
    public function createDocFile($id, $fileName, $directory)
    {
        date_default_timezone_set("Asia/Bangkok");
        //$id = PK of CmsDocument and $fileName = file from user uploaded
        $idfile = CmsFile::find()->all();
        $result = 0;
        foreach ($idfile as $rows) {
            $result = $rows['file_id'];
        }
        $iddoc = CmsDocument::findOne("$id");
        $model_file = new CmsFile();
        $model_file->file_id = $result + 1;
        $model_file->file_name = $fileName;
        $model_file->file_path = $directory;
        $model_file->file_annotation = null;
        $model_file->file_date = date("Y-m-d H:i:s");
        $model_file->save();
        $cms_doc_file = new CmsDocFile();
        $cms_doc_file->file_id = $model_file->file_id;
        $cms_doc_file->doc_id = $iddoc->doc_id;
        $cms_doc_file->save();

        return true;

    }

    public function DeleteFileUpload($docId, $name,$fileId)
    {
        //get id file from iddoc
        $model_cmsdocfile = CmsDocFile::find()->where('doc_id = "' . $docId . '" AND file_id = ' . $fileId)->one();
        $model_docfile = CmsFile::findOne($fileId);
        $model_cmsdocfile->delete();
        $model_docfile->delete();

        return true;
    }

    public function findFileByDocId($id){
        $file = \app\modules\correspondence\models\CmsFile::find()
            ->from(['cms_doc_file', 'cms_file', 'cms_document'])
            ->where("cms_doc_file.doc_id = '" . $id . "'")
            ->andWhere("cms_doc_file.file_id = cms_file.file_id")
            ->groupBy(['cms_file.file_name'])
            ->all();
        return $file;
    }

    public function findFileByDocIdForPreview($id){
        $query = \app\modules\correspondence\models\CmsFile::find()
            ->from(['cms_doc_file', 'cms_file', 'cms_document'])
            ->where("cms_doc_file.doc_id = '" . $_GET["id"] . "'")
            ->andWhere("cms_doc_file.file_id = cms_file.file_id")
            ->groupBy(['cms_file.file_name'])
            ->one();
        return $query;
    }
}
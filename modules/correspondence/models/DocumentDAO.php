<?php

namespace app\modules\correspondence\models;


use yii\helpers\FileHelper;
use Yii;

class DocumentDAO
{
    public function findDocumentReceive($name, $type_id, $search, $id, $date)
    {
        /*
         * $name = keyword for search
         * $type_id = doc_type id
         * $search = search type -> byName,byType,by เลขหนังสือ
         * $id = address_id
         */
        if (isset($date) == "") {
            $dateStart = substr($date, 0, 10);
            $dateEnd = substr($date, 12);
            if ($search == "searchByType") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive'
                    , 'cms_address', 'cms_doc_type'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere(['cms_document.type_id' => $type_id])
                    ->andWhere('cms_document.type_id = cms_doc_type.type_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->andWhere('cms_document.doc_date BETWEEN ' . $dateStart . ' AND ' . $dateEnd)
                    ->all();
            } elseif ($search == "searchBySubject") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive', 'cms_address'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->andWhere('cms_document.doc_date BETWEEN "' . $dateStart . '" AND "' . $dateEnd . '"')
                    ->all();
            } else {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive', 'cms_address'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_id_regist LIKE "%' . $name . '%"')
                    ->andWhere('cms_document.doc_date BETWEEN ' . $dateStart . ' AND ' . $dateEnd)
                    ->all();
            }
        } else { //no have range date
            if ($search == "searchByType") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive'
                    , 'cms_address', 'cms_doc_type'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere(['cms_document.type_id' => $type_id])
                    ->andWhere('cms_document.type_id = cms_doc_type.type_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->all();
            } elseif ($search == "searchBySubject") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive', 'cms_address'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->all();
            } else {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive', 'cms_address'])
                    ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                    ->andWhere(['cms_document.address_id' => $id])
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_id_regist LIKE "%' . $name . '%"')
                    ->all();
            }
        }


        return $model_doc;
    }

    public function findDocumentSend($name, $type_id, $search, $id, $date)
    {
        /*
         * $name = keyword for search
         * $type_id = doc_type id
         * $search = search type -> byName,byType,by เลขหนังสือ
         * $id = address_id
         */
        if (isset($date) == "") {
            $dateStart = substr($date, 0, 10);
            $dateEnd = substr($date, 12);
            if ($search == "searchByType") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send'
                    , 'cms_address', 'cms_doc_type'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = "' . $id . '"')
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.type_id = ' . $type_id . '')
                    ->andWhere('cms_document.type_id = cms_doc_type.type_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->andWhere('cms_document.doc_date BETWEEN ' . $dateStart . ' AND ' . $dateEnd)
                    ->all();
            } elseif ($search == "searchBySubject") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send', 'cms_address'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = "' . $id . '"')
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->andWhere('cms_document.doc_date BETWEEN "' . $dateStart . '" AND "' . $dateEnd . '"')
                    ->all();
            } else {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send', 'cms_address'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = "' . $id . '"')
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_id_regist LIKE "%' . $name . '%"')
                    ->andWhere('cms_document.doc_date BETWEEN ' . $dateStart . ' AND ' . $dateEnd)
                    ->all();
            }
        } else { //no have range date
            if ($search == "searchByType") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send'
                    , 'cms_address', 'cms_doc_type'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = "' . $id . '"')
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.type_id = ' . $type_id . '')
                    ->andWhere('cms_document.type_id = cms_doc_type.type_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->all();
            } elseif ($search == "searchBySubject") {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send', 'cms_address'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = "' . $id . '"')
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_subject LIKE "%' . $name . '%"')
                    ->all();
            } else {
                $model_doc = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send', 'cms_address'])
                    ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                    ->andWhere('cms_document.address_id = "' . $id . '"')
                    ->andWhere('cms_document.address_id = cms_address.address_id')
                    ->andWhere('cms_document.doc_id_regist LIKE "%' . $name . '%"')
                    ->all();
            }
        }


        return $model_doc;
    }

    public function deleteDocumentReceive($id)
    {
        $model_inbox = CmsInbox::find()->where(
            ['doc_id' => $id]
        )->all();
        $model_outbox = CmsOutbox::find()->where(
            ['doc_id' => $id]
        )->all();
        $model_doc_roll_receive = CmsDocRollReceive::find()->where(
            ['doc_id' => $id]
        )->one();

        $model_doc_file = CmsDocFile::find()->where(
            ['doc_id' => $id]
        )->all();
        foreach ($model_doc_file as $item) {
            $this->deleteFileByName($item['file_id']);
            $doc_file = CmsDocFile::find()->where(
                ['file_id' => $item['file_id']]
            )->one();
            $doc_file->delete();
            $model_file = CmsFile::findOne($item['file_id']);
            $model_file->delete();
        }
        foreach ($model_inbox as $inbox) {
            $inbox->delete();
        }

        foreach ($model_outbox as $outbox) {
            $queue = CmsQueue::find()->where(['outbox_id' => $outbox->outbox_id])->one();
            $queue->delete();
            $outbox->delete();
        }

        $doc_ref = CmsDocRef::find()->where(['doc_id' => $id])->all();
        foreach ($doc_ref as $ref) {
            $ref->delete();
        }
        $model_doc = CmsDocument::findOne($id);
        $model_doc_roll_receive->delete();
        $model_doc->delete();
    }

    public function deleteDocumentSend($id)
    {
        $model_doc_roll_send = CmsDocRollSend::find()->where(
            ['doc_id' => $id]
        )->one();

        $model_doc_file = CmsDocFile::find()->where(
            ['doc_id' => $id]
        )->all();
        foreach ($model_doc_file as $item) {
            $this->deleteFileByName($item['file_id']);
            $doc_file = CmsDocFile::find()->where(
                ['file_id' => $item['file_id']]
            )->one();
            $doc_file->delete();
            $model_file = CmsFile::findOne($item['file_id']);
            $model_file->delete();
        }
        $model_doc = CmsDocument::findOne($id);
        $model_doc_roll_send->delete();
        $model_doc->delete();
    }

    public function deleteFileByName($id)
    {
        //ลบไฟล์จากหน้าทะเบียนหนังสือ
        $model_file = CmsFile::findOne($id);
        $directory = \Yii::getAlias('../web/web_cms/uploads/' . $model_file->file_path) . DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $model_file->file_name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $model_file->file_name);
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
    }

    public function insertDocAddress($address)
    {
        $model_address = new CmsAddress();
        $model_address->address_id = "";
        $model_address->address_name = $address;
        $model_address->save();
        return $model_address->address_id;
    }

    public function findUserReplyMail()
    {
        $user = User::find()->where(['person_type' => 4])->all();
        $userId = [];
        foreach ($user as $i => $row) {
            array_push($userId, $row->id);
        }
        /*print_r($userId);
        exit;*/
        $model_doc = CmsInbox::find()->from(['cms_inbox', 'user'])
            ->where(['cms_inbox.user_id' => $userId])
            ->andWhere('cms_inbox.user_id = user.id')
            ->andWhere('cms_inbox.inbox_status IS NULL')
            // ->andWhere('cms_outbox.outbox_id = cms_inbox.outbox_id')
            ->limit(10)
            ->orderBy(['cms_inbox.inbox_time' => SORT_DESC])
            ->all();
        return $model_doc;
    }

    public function insertDocRef($docId, Array $docRef)
    {
        foreach ($docRef as $item) {
            //เช็ดว่า doc_ref ของ doc_id นี้มี doc_ref ค่านี้หรือไม่
            if (!CmsDocRef::find()->where(['doc_id' => $docId])->andWhere(['doc_ref' => $item])->one()) {
                $model = new CmsDocRef();
                $model->doc_ref_id = "REFID" . date('Ydm') . gettimeofday()["usec"];
                $model->doc_id = $docId;
                $model->doc_ref = $item;
                $model->save();
            }
        }
    }

    public function deleteDocRef($id)
    {
        $model = CmsDocRef::findOne($id);
        $model->delete();
    }

    public function deleteDocRefInUpdateReceiveInCreateReceiveBook($id)
    {
        $model = CmsDocRef::find()->where(['doc_id' => $id])->all();
        foreach ($model as $ref) {
            $ref->delete();
        }
    }

}
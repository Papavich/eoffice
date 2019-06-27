<?php

namespace app\modules\correspondence\models;


use yii\data\Pagination;
use yii\helpers\FileHelper;

class DocRollDAO
{


    public function createCmsDocRollSend($doc_roll_id, $doc_roll_send_doing, $doc_id)
    {
        $model_roll = new CmsDocRollSend();
        $model_roll->doc_roll_send_id = $doc_roll_id;
        $model_roll->doc_id = $doc_id;
        $model_roll->doc_roll_send_doing = $doc_roll_send_doing;
        $model_roll->doc_roll_note = null;
        $model_roll->save();
    }

    public function updateCmsDocRollSend($doc_roll_id, $doc_roll_send_doing)
    {
        $model_roll = CmsDocRollSend::findOne($doc_roll_id);
        $model_roll->doc_roll_send_doing = $doc_roll_send_doing;
        $model_roll->save();
    }

    public function createCmsDocRollReceive($doc_roll_id, $doc_roll_receive_doing,$doc_id)
    {
        $model_roll = new CmsDocRollReceive();
        $model_roll->doc_roll_receive_id = $doc_roll_id;
        $model_roll->doc_id = $doc_id;
        $model_roll->doc_roll_receive_doing = $doc_roll_receive_doing;
        $model_roll->doc_roll_note = null;
        $model_roll->save();
    }
    public function updateCmsDocRollReceive($doc_roll_id, $doc_roll_receive_doing)
    {
        $model_roll = CmsDocRollReceive::findOne($doc_roll_id);
        $model_roll->doc_roll_receive_doing = $doc_roll_receive_doing;
        $model_roll->save();
        return true;
    }
    public function findBySendRoll()
    {

        $model_doc = CmsAddress::find()->orderBy(['sub_type_id' => SORT_DESC]);
        $countQuery = clone $model_doc;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $model_doc->offset($pages->offset)
            ->limit(6)
            ->all();
        return array($models,$pages);
    }
    public function findByReceiveRoll()
    {
        $model_doc = CmsAddress::find()->orderBy(['sub_type_id' => SORT_DESC]);
        $countQuery = clone $model_doc;
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 5] );
        $models = $model_doc->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();
        return array($models,$pages);
    }
}
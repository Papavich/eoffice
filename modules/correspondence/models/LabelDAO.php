<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 1/28/2018
 * Time: 7:17 PM
 */

namespace app\modules\correspondence\models;


class LabelDAO
{
    public function createNewLabel($labelId, Array $inboxId)
    {
        $lable = CmsInboxLabel::findOne($labelId);
        //print_r($inboxId);
        foreach ($inboxId as $id) {
                $inbox = CmsInbox::findOne($id);
                $model = new InboxLabel();
                $model->label_id = $lable->inbox_label_id;
                $model->inbox_id = $inbox->inbox_id;
                $model->save();
                //echo $id;
        }
        return true;
    }

    public function findInboxFromLabel($label_id)
    {
        $model_inbox = CmsInboxLabel::findOne($label_id);
        return $model_inbox->inboxes;
    }

    public function findInboxFavMailFromLabel($label_id)
    {
        $model_inbox = CmsInbox::find()->from(['cms_inbox_label', 'cms_inbox', 'inbox_label'])
            ->where(['cms_inbox_label.inbox_label_id' => $label_id])
            ->andWhere('cms_inbox.inbox_fav = 1')
            ->andWhere('cms_inbox.user_id = ' . \Yii::$app->user->identity->id)
            ->andWhere('inbox_label.label_id = cms_inbox_label.inbox_label_id')
            ->andWhere('inbox_label.inbox_id = cms_inbox.inbox_id')
            ->all();
        return $model_inbox;
    }
    public function findInboxJunkMailFromLabel($label_id)
    {
        $model_inbox = CmsInbox::find()->from(['cms_inbox_label', 'cms_inbox', 'inbox_label'])
            ->where(['cms_inbox_label.inbox_label_id' => $label_id])
            ->andWhere('cms_inbox.user_id = ' . \Yii::$app->user->identity->id)
            ->andWhere('cms_inbox.inbox_trash = 1')
            ->andWhere('inbox_label.label_id = cms_inbox_label.inbox_label_id')
            ->andWhere('inbox_label.inbox_id = cms_inbox.inbox_id')
            ->all();
        return $model_inbox;
    }
}
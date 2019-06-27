<?php

namespace app\modules\correspondence\models\gridview;

use app\modules\correspondence\controllers;
use app\modules\correspondence\models\UserDAO;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\correspondence\models\CmsInbox;
use app\modules\correspondence\models\User;
use app\modules\correspondence\models\CmsOutbox;
use yii\data\Pagination;
use yii\db\Expression;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\widgets\LinkPager;

/**
 * MailSearch represents the model behind the search form of `app\modules\correspondence\models\CmsInbox`.
 */
class MailGridView extends CmsInbox
{

    /*
     * SET GRIDVIEW columns
     *
     * */
    public function getCurentUser()
    {
        if(\Yii::$app->authManager->isAdmin() || \Yii::$app->authManager->isStaffGeneral())
        {
            $user = User::findOne(1);
        }else
        {
            $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        }
        return $user;
    }
    public function gridViewColumsForUser($params)
    {
        $gridColumns = [
            [
                'header' => false,
                'name' => 'listmails[]',
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions' => ['style' => 'width:20px'],
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->inbox_id];
                }
                // you may configure additional properties here
            ],
            [
                'label' => false,
                'attribute' => 'inbox_fav',
                'contentOptions' => ['class' => 'mailbox-star', 'style' => 'width:100px'],
                'value' => function ($model, $key, $index, $column) {
                    if ($model->inbox_fav == 0) {
                        $star = '<i class="fa fa-star-o text-yellow" style="margin-right: 3px"></i>';
                    } else {
                        $star = '<i class="fa fa-star text-yellow" style="margin-right: 3px"></i>';
                    }
                    return "<div  style='float:right;'>
                                   " . $this->setIconSecret($model) . "</div><a href=\"#\" onclick=\"redirectDeleteRoll('" . $model->inbox_id . "')\"
                                   class=\"favMail\">" . $star . "</a>";
                },
                'format' => 'raw'

            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-name','style'=>'width:270px;font-size:16px'],
                'attribute' => 'outbox_id',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a("<b>".controllers::t('menu','From')." </b>" .
                        $model->outbox->user->prefix_th.$model->outbox->user->fname." ".$model->outbox->user->lname
                        . ""
                        , ['mail/read-mail?id=' . $model->inbox_id]
                        , ['style' => 'color:black;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-regist','style'=>'width:210px'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    $labelName = "";
                    $model_label = \app\modules\correspondence\models\CmsInboxLabel::find()->where(['user_id' => $model->user_id])
                        ->all();
                    foreach ($model_label as $label) {
                        foreach ($label->inboxLabels as $i) {
                            if ($i['inbox_id'] == $model->inbox_id) {
                                $labelName = $i->label->label_name;
                            }
                        }
                    }
                    return
                        Html::a("<span style='font-size: 16px'><b>" . $model->doc->doc_id_regist . "</b></span>"
                            ."<span  class='badge' style='font-family:Tahoma;font-weight:lighter;background-color: #5c5c5c; font-size: 10px' title='"
                            .controllers::t('menu','Label')."'>"
                            . $labelName . "</span>  "
                            , ['mail/read-mail?id=' . $model['inbox_id']]
                            , ['style' => 'color:black;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-subject'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    $labelName = "";
                    $model_label = \app\modules\correspondence\models\CmsInboxLabel::find()->where(['user_id' => $model->user_id])
                        ->all();
                    foreach ($model_label as $label) {
                        foreach ($label->inboxLabels as $i) {
                            if ($i['inbox_id'] == $model->inbox_id) {
                                $labelName = $i->label->label_name;
                            }
                        }
                    }
                    return
                        Html::a(
                            "<span style='font-size: 16px'>".iconv_substr( $model->doc->doc_subject
                                , 0, 500, 'UTF-8') . ''."</span>"
                            , ['mail/read-mail?id=' . $model['inbox_id']]
                            , ['style' => 'color:black;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-type','style'=>'width:100px'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    $labelName = "";
                    $model_label = \app\modules\correspondence\models\CmsInboxLabel::find()->where(['user_id' => $model->user_id])
                        ->all();
                    foreach ($model_label as $label) {
                        foreach ($label->inboxLabels as $i) {
                            if ($i['inbox_id'] == $model->inbox_id) {
                                $labelName = $i->label->label_name;
                            }
                        }
                    }
                    return
                        Html::a("<span style='font-size: 14px'>".$model->doc->type->type_name . "</span>"
                            , ['mail/read-mail?id=' . $model['inbox_id']]
                            , ['style' => 'color:black;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-date', 'style' => 'color: black;font-size:14px;width:100px;padding-top:12px'],
                'attribute' => 'inbox_time',
                'value' => function ($model, $key, $index, $column) {
                    return '<b>' .

                        TimeAgo::widget(['timestamp' => $model->inbox_time, 'language' => Yii::$app->language])
                        . '</b>';
                },
                'format' => 'raw',
                'filter' => true
            ],


        ];
        return $gridColumns;
    }

    public function gridViewColumsForAdmin($params)
    {
        $gridColumns = [
            [
                'header' => false,
                'name' => 'listmails[]',
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions' => ['style' => 'width:20px'],
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->inbox_id];
                }
                // you may configure additional properties here
            ],
            [
                'label' => false,
                'attribute' => 'inbox_fav',
                'contentOptions' => ['class' => 'mailbox-star', 'style' => 'width:120px'],
                'value' => function ($model, $key, $index, $column) {
                    if ($model->inbox_fav == 0) {
                        $star = '<i class="fa fa-star-o text-yellow"></i>';
                    } else {
                        $star = '<i class="fa fa-star text-yellow"></i>';
                    }
                    return "<div  style='float:right;'>
                                   " . $this->setIconSecret($model) . "</div><a href=\"#\" onclick=\"redirectDeleteRoll('" . $model->inbox_id . "')\"
                                   class=\"favMail\">" . $star . "</a>";
                },
                'format' => 'raw'

            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-name', 'style' => 'width:270px;font-size:16px'],
                'attribute' => 'outbox_id',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a("<b>".controllers::t('menu','From')." </b>" .
                        $model->outbox->user->prefix_th.$model->outbox->user->fname." ".$model->outbox->user->lname
                        . ""
                        , ['mail/read-reply-mail?id=' . $model->outbox->outbox_id], ['style' => 'color:black;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-regist','style'=>'width:210px'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    $labelName = "";
                    $model_label = \app\modules\correspondence\models\CmsInboxLabel::find()->where(['user_id' => $model->user_id])
                        ->all();
                    foreach ($model_label as $label) {
                        foreach ($label->inboxLabels as $i) {
                            if ($i['inbox_id'] == $model->inbox_id) {
                                $labelName = $i->label->label_name;
                            }
                        }
                    }
                    return
                        Html::a("<span style='font-size: 16px'><b>" . $model->doc->doc_id_regist . "</b></span>"
                            ."<span  class='badge' style='font-family:Tahoma;font-weight:lighter;background-color: #5c5c5c; font-size: 10px' title='"
                            .controllers::t('menu','Label')."'>"
                            . $labelName . "</span>  "
                            , ['mail/read-reply-mail?id=' . $model->outbox->outbox_id]
                            , ['style' => 'color:black;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-subject','style'=>'width:600px'],
                'attribute' => 'message_reply',
                'value' => function ($model, $key, $index, $column) {
                    return
                        Html::a("<span style='font-size: 16px'>".iconv_substr( $model->doc->doc_subject
                                , 0, 500, 'UTF-8') . ''."</span>"
                            , ['mail/read-reply-mail?id=' . $model->outbox->outbox_id]
                            , ['style' => 'color:black;']);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-type', 'style' => 'width:100px'],
                'attribute' => 'inbox_content',
                'value' => function ($model, $key, $index, $column) {

                    return
                        Html::a("<span style='font-size: 14px; color: black;'> 
                                " . $model->doc->type->type_name . "</span>");
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-date', 'style' => 'color: black;font-size:14px;width:100px;padding-top:12px'],
                'attribute' => 'inbox_time',
                'value' => function ($model, $key, $index, $column) {
                    return '<b>' .
                        TimeAgo::widget(['timestamp' => $model->inbox_time, 'language' => Yii::$app->language])
                        . '</b>';
                },
                'format' => 'raw',
                'filter' => true
            ],
        ];
        return $gridColumns;
    }

    public function gridViewColumsOutbox($params)
    {
        $gridColumns = [
            [
                'header' => false,
                'name' => 'listmails[]',
                'contentOptions' => ['style' => 'width:20px'],
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->outbox_id];
                }
                // you may configure additional properties here
            ],
            [
                'label' => false,
                'attribute' => 'outbox_fav',
                'contentOptions' => ['class' => 'mailbox-star', 'style' => 'width:70px'],
                'value' => function ($model, $key, $index, $column) {
                    return $this->setIconSecret($model);
                },
                'format' => 'raw'

            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-name','style'=>'width:270px;font-size:16px'],
                'attribute' => 'outbox_id',
                'value' => function ($model, $key, $index, $column) {
                    $user = UserDAO::getCurentUser();
                    $countMail = CmsOutbox::find()
                        ->select('cms_inbox.outbox_id')
                        ->from(['cms_outbox', 'cms_inbox'])
                        ->where(['cms_outbox.user_id' => $user->id])
                        ->andWhere(['cms_outbox.outbox_subject' => $model['outbox_subject']])
                        ->andWhere('cms_outbox.outbox_trash = 0')
                        ->andWhere(['cms_outbox.outbox_id' => $model['outbox_id']])
                        ->andWhere('cms_outbox.outbox_id = cms_inbox.outbox_id')
                        ->count();
                    //$countMail = จำนวนของข้อความที่ถูกส่งออกไปในกรณีที่เป็นเรื่องเดียวกันจะแสดงแค่แถวเดียว
                    //แล้วแสดงจำนวนต่อท้ายชื่อผู้รับ
                    foreach ($model->cmsInboxes as $index => $item) {
                        $a = $item->user->id;
                        $result = "";
                        //มีคนรับหลายคน
                        if (($countMail > 1)) {
                            $result = " <b>".controllers::t('menu','To').
                                "</b> " .
                                $item->user->prefix_th.$item->user->fname." ".$item->user->lname
                                . "  " .controllers::t('menu','and others').
                                (($countMail > 1) ? "(" . $countMail . ")" : '');
                        } else {
                            $result = " <b>".controllers::t('menu','To').
                                "</b> " .
                                $item->user->prefix_th.$item->user->fname." ".$item->user->lname
                                . (($countMail > 1) ? "(" . $countMail . ")" : '');
                        }
                    }
                    return $result;
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-regist','style'=>'width:180px'],
                'attribute' => 'outbox_status',
                'value' => function ($model, $key, $index, $column) {
                    return
                        Html::a("<span style='font-size: 18px'><b> " . $model->doc->doc_id_regist . "</b></span> "
                            , ['mail/read-send-mail?id=' . $model['outbox_id']]);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-subject','style'=>'width:600px'],
                'attribute' => 'outbox_status',
                'value' => function ($model, $key, $index, $column) {
                    return
                        Html::a(iconv_substr("<span style='font-size: 16px'>". $model['outbox_subject']."</span>"
                                , 0, 500, 'UTF-8') . '', ['mail/read-send-mail?id=' . $model['outbox_id']]);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-type','style'=>'width:100px'],
                'attribute' => 'outbox_status',
                'value' => function ($model, $key, $index, $column) {
                    return
                        Html::a("<span style='font-size: 14px; color: black;'> " .
                            $model->doc->type->type_name . "</span>" , ['mail/read-send-mail?id=' . $model['outbox_id']]);
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-date', 'style' => 'color: black;font-size:14px;width:100px;padding-top:12px'],
                'attribute' => 'outbox_time',
                'value' => function ($model, $key, $index, $column) {
                    return '<b>' .
                        TimeAgo::widget(['timestamp' => $model['outbox_time'], 'language' => Yii::$app->language])
                        . '</b>';
                },
                'format' => 'raw'
            ],
        ];
        return $gridColumns;
    }

    public function gridViewCategory($params)
    {
        $gridColumns = [
            [
                'label' => controllers::t('menu', 'Category'),
                'attribute' => 'subType',
                'value' => function ($model, $key, $index, $column) {
                    return $model->doc->subType->sub_type_name;
                },
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Folder'),
                'attribute' => 'address_name',
                'headerOptions' => ['class' => 'text-center'],
                'value' => function ($model, $key, $index, $column) {
                    $count = CmsInbox::find()->from(['cms_document', 'cms_address', 'cms_inbox'])
                        ->where('cms_inbox.doc_id = cms_document.doc_id')
                        ->andWhere(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                        ->andWhere(['=', 'cms_inbox.inbox_trash', 0])
                        ->andWhere(['cms_document.address_id' => $model->doc->address->address_id])
                        ->andWhere('cms_document.address_id = cms_address.address_id')
                        ->count();
                    return
                        $model->doc->address->address_name . " <span class='badge'><b>" . $count . "</b></span>";
                },
                'format' => 'raw',
                'filter' => true,
            ],
            [
                'label' => controllers::t('menu', 'Annual'),
                'attribute' => 'address_year',
                'filter' => true,
                'value' => function ($model, $key, $index, $column) {
                    return $model->doc->address->address_year;
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],

            ],
            [
                'content' => function ($model) {
                    return Html::a("<i class=\"fa fa-eye\"></i><span>" . controllers::t('menu', 'See the Mails') . "</span>",
                        ['mail/category?address_id=' . $model->doc->address->address_id],
                        ['class' => 'btn btn-3d btn-sm btn-reveal btn-teal', 'style' => 'width:100%']);
                }
            ]
        ];
        return $gridColumns;

    }

    public function gridViewJunkMailUser()
    {
        $gridColumns = [
            [
                'header' => false,
                'name' => 'listmails[]',
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions' => ['style' => 'width:20px'],
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    $user = UserDAO::getCurentUser()->id;
                    if ($model->outbox_trash == 1 && $model->user_id == $user->id) {
                        foreach ($model->cmsInboxes as $index => $item) {
                            return ['value' => $item->outbox->outbox_id];
                        }
                    } else {
                        foreach ($model->cmsInboxes as $id) {
                            if ($id->user_id == $user->id && $id->inbox_trash == 1) {
                                return ['value' => $id->inbox_id];
                            }

                        }

                    }
                },
                // you may configure additional properties here
            ],
            [
                'label' => false,
                'attribute' => 'outbox_fav',
                'contentOptions' => ['class' => 'mailbox-star', 'style' => 'width:70px'],
                'value' => function ($model, $key, $index, $column) {
                    return $this->setIconSecret($model);
                },
                'format' => 'raw'

            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-name','style'=>'width:250px;font-size:16px'],
                'attribute' => 'outbox_id',
                'value' => function ($model, $key, $index, $column) {
                    $user = UserDAO::getCurentUser()->id;
                    if ($model->outbox_trash == 1 && $model->user_id == $user->id) {
                        $countMail = CmsOutbox::find()
                            ->from(['cms_outbox', 'user'])
                            ->where(['cms_outbox.user_id' => $user->id])
                            ->andWhere(['cms_outbox.outbox_subject' => $model['outbox_subject']])
                            ->andWhere('cms_outbox.user_id = user.id')
                            ->andWhere('cms_outbox.outbox_trash = 1')
                            ->count();
                        $countMail = ($countMail > 1) ? "(" . $countMail . ")" : '';
                        foreach ($model->cmsInboxes as $index => $item) {
                            if (count($model->cmsInboxes) >= 2 && $index > 0) {
                                return controllers::t('menu','To')
                                    . $item->user->prefix_th.$item->user->fname." ".$item->user->lname . " "
                                    .controllers::t('menu','and others'). $countMail;
                            } else if (count($model->cmsInboxes) == 1 && $index == 0) {
                                return controllers::t('menu','To').
                                    $item->user->prefix_th.$item->user->fname." ".$item->user->lname;
                            }
                        }
                    } else {
                        foreach ($model->cmsInboxes as $id) {
                            if ($id->user_id == $user->id && $id->inbox_trash == 1) {
                                return Html::a(controllers::t('menu','From').
                                     $id->outbox->user->prefix_th.$id->outbox->user->fname." ".$id->outbox->user->lname. ""
                                    , ['mail/read-mail?id=' . $id->inbox_id]);
                            }
                        }

                    }
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-regist','style'=>'width:210px'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    $user = UserDAO::getCurentUser()->id;
                    if ($model->outbox_trash == 1 && $model->user_id == $user->id) {
                        return
                            Html::a("<span style='font-size: 16px'><b>" . $model->doc->doc_id_regist . "</b></span>", ['mail/read-send-mail?id=' . $model['outbox_id']]);
                    } else {
                        foreach ($model->cmsInboxes as $rows) {
                            if ($rows->user_id == $user->id && $rows->inbox_trash == 1) {
                                $labelName = "";
                                $model_label = \app\modules\correspondence\models\CmsInboxLabel::find()->where(['user_id' => $rows->user_id])
                                    ->all();
                                foreach ($model_label as $label) {
                                    foreach ($label->inboxLabels as $i) {
                                        if ($i['inbox_id'] == $rows->inbox_id) {
                                            $labelName = $i->label->label_name;
                                        }
                                    }
                                }
                                return
                                    Html::a("<span style='font-size: 16px'><b>" . $model->doc->doc_id_regist . "</b></span>"
                                        ."<span  class='badge' style='font-family:Tahoma;font-weight:lighter;background-color: #5c5c5c; font-size: 10px' title='"
                                        .controllers::t('menu','Label')."'>"
                                        . $labelName . "</span>  "
                                        , ['mail/read-mail?id=' . $rows['inbox_id']]);
                            }

                        }
                    }

                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-subject','style'=>'width:600px'],
                'attribute' => 'inbox_content',
                'value' => function ($model, $key, $index, $column) {
                    $user = UserDAO::getCurentUser()->id;
                    if ($model->outbox_trash == 1 && $model->user_id == $user->id) {
                        return
                            Html::a(iconv_substr( "<span style='font-size: 16px'>".$model['outbox_subject'] ."</span>"
                                    , 0, 500, 'UTF-8') . '', ['mail/read-send-mail?id=' . $model['outbox_id']]);
                    } else {
                        foreach ($model->cmsInboxes as $rows) {
                            if ($rows->user_id == $user->id && $rows->inbox_trash == 1) {
                                return
                                    Html::a("<span style='font-size: 16px'>".iconv_substr($model->doc->doc_subject
                                            , 0, 500, 'UTF-8') . ''."</span>"
                                        , ['mail/read-mail?id=' . $rows['inbox_id']]
                                        , ['style' => 'color:black;']);
                            }

                        }
                    }

                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-type','style'=>'width:100px'],
                'attribute' => 'outbox_subject',
                'value' => function ($model, $key, $index, $column) {
                    $user = UserDAO::getCurentUser()->id;
                    if ($model->outbox_trash == 1 && $model->user_id == $user->id) {
                        return
                            Html::a("<span style='font-size: 14px; color: black;'> " . $model->doc->type->type_name . " </span>", ['mail/read-send-mail?id=' . $model['outbox_id']]);
                    } else {
                        foreach ($model->cmsInboxes as $rows) {
                            if ($rows->user_id == $user->id && $rows->inbox_trash == 1) {
                                return
                                    Html::a(
                                        "<span style='font-size: 14px; color: black;'> " . $rows->doc->type->type_name . " </span>"
                                        , ['mail/read-mail?id=' . $rows['inbox_id']]
                                        , ['style' => 'color:black;']);
                            }

                        }
                    }

                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-date', 'style' => 'color: black;font-size:14px;width:100px;padding-top:12px'],
                'attribute' => 'inbox_time',
                'value' => function ($model, $key, $index, $column) {
                    $user = UserDAO::getCurentUser()->id;
                    if ($model->outbox_trash == 1 && $model->user_id == $user->id) {
                        return '<b>' . TimeAgo::widget(['timestamp' => $model->outbox_time
                                , 'language'=>Yii::$app->language]) . '</b>';
                    } else {
                        foreach ($model->cmsInboxes as $id) {
                            if ($id->user_id == $user->id && $id->inbox_trash == 1) {
                                return '<b>' . TimeAgo::widget(['timestamp' => $id->outbox->outbox_time,
                                        'language' => Yii::$app->language]) . '</b>';
                            }
                        }

                    }
                },
                'format' => 'raw',
                'filter' => true
            ],

        ];
        return $gridColumns;

    }

    public function gridViewJunkMailAdmin()
    {
        $gridColumns = [
            [
                'header' => false,
                'name' => 'listmails[]',
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions' => ['style' => 'width:20px'],
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
                    if ($model->outbox_trash == 1 && $model->user_id == $this->getCurentUser()->id) {
                        return ['value' => $model->outbox_id];
                    } else {
                        foreach ($model->cmsInboxes as $id) {
                            if ($id->user_id == $this->getCurentUser()->id && $id->inbox_trash == 1) {
                                return ['value' => $id->inbox_id];
                            }
                        }
                    }
                }
                // you may configure additional properties here
            ],
            [
                'label' => false,
                'attribute' => 'outbox_fav',
                'contentOptions' => ['class' => 'mailbox-star', 'style' => 'width:70px'],
                'value' => function ($model, $key, $index, $column) {
                    return $this->setIconSecret($model);
                },
                'format' => 'raw'

            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-name','style'=>'width:250px;font-size:16px'],
                'attribute' => 'outbox_id',
                'value' => function ($model, $key, $index, $column) {
                    //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
                    if ($model->outbox_trash == 1 && $model->user_id == $this->getCurentUser()->id) {
                        $countMail = \app\modules\correspondence\models\CmsOutbox::find()
                            ->from(['cms_outbox', 'user'])
                            ->where(['cms_outbox.user_id' => $this->getCurentUser()->id])
                            ->andWhere(['cms_outbox.outbox_subject' => $model['outbox_subject']])
                            ->andWhere('cms_outbox.user_id = user.id')
                            ->andWhere('cms_outbox.outbox_trash = 1')
                            ->count();
                        $countMail = ($countMail > 1) ? "(" . $countMail . ")" : '';
                        foreach ($model->cmsInboxes as $index => $item) {
                            if (count($model->cmsInboxes) >= 2 && $index > 0) {
                                return "<b>".controllers::t('menu','To')
                                    . $item->user->prefix_th.$item->user->fname." ".$item->user->lname. " " .
                                    controllers::t('menu','and others').$countMail;
                            } else if (count($model->cmsInboxes) == 1 && $index == 0) {
                                return "<b>".controllers::t('menu','To')."</b> " .
                                    $item->user->prefix_th.$item->user->fname." ".$item->user->lname
                                    . "";
                            }
                        }
                    } else {
                        foreach ($model->cmsInboxes as $id) {
                            if ($id->user_id == $this->getCurentUser()->id && $id->inbox_trash == 1) {
                                return Html::a("<b>  ".controllers::t('menu','From')."</b>" .
                                    $id->outbox->user->prefix_th.$id->outbox->user->fname." ".$id->outbox->user->lname . ""
                                    , ['mail/read-reply-mail?id=' . $id->outbox->outbox_id]);
                            }
                        }

                    }
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-regist','style'=>'width:210px'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
                    if ($model->outbox_trash == 1 && $model->user_id == $this->getCurentUser()->id) {

                        return
                            Html::a("<span style='background-color: #EEEDED; margin-right: 5px;font-size: 16px' 
title='".controllers::t('menu','Label')."'>
                                </span>  "
                                . "<span style='font-size: 16px'><b>" . $model->doc->doc_id_regist . "</b></span>  "
                                , ['mail/read-send-mail?id=' . $model['outbox_id']]);
                    } else {
                        foreach ($model->cmsInboxes as $rows) {
                            $labelName = "";
                            $model_label = \app\modules\correspondence\models\CmsInboxLabel::find()->where(['user_id' => $rows->user_id])
                                ->all();
                            foreach ($model_label as $label) {
                                foreach ($label->inboxLabels as $i) {
                                    if ($i['inbox_id'] == $rows->inbox_id) {
                                        $labelName = $i->label->label_name;
                                    }
                                }
                            }
                            if ($rows->user_id == $this->getCurentUser()->id && $rows->inbox_trash == 1) {
                                return
                                    Html::a("<span style='font-size: 16px'><b>" . $model->doc->doc_id_regist . "</b></span>"
                                        ."<span  class='badge' style='font-family:Tahoma;font-weight:lighter;background-color: #5c5c5c; font-size: 10px' title='"
                                        .controllers::t('menu','Label')."'>"
                                        . $labelName . "</span>  "
                                        , ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]);
                            }
                        }

                    }
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-subject','style'=>'width:600px'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
                    if ($model->outbox_trash == 1 && $model->user_id == $this->getCurentUser()->id) {
                        return
                            Html::a(iconv_substr( "<span style='font-size: 16px'>".$model['outbox_subject'] ."</span>"
                                    , 0, 500, 'UTF-8') . '', ['mail/read-send-mail?id=' . $model['outbox_id']]);
                    } else {
                        foreach ($model->cmsInboxes as $rows) {
                            if ($rows->user_id == $this->getCurentUser()->id && $rows->inbox_trash == 1) {
                                return
                                    Html::a("<span style='font-size: 16px'>".iconv_substr(
                                            $rows->doc->doc_subject .
                                            "</span> ", 0, 500, 'UTF-8') . ''
                                        , ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]);
                            }
                        }

                    }
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-type','style'=>'width:100px'],
                'attribute' => 'inbox_status',
                'value' => function ($model, $key, $index, $column) {
                    //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
                    if ($model->outbox_trash == 1 && $model->user_id == $this->getCurentUser()->id) {
                        return
                            Html::a( "<span style='font-size: 14px; color: black;'>".$model->doc->type->type_name ."</span>"
                                , ['mail/read-send-mail?id=' . $model['outbox_id']]);
                    } else {
                        foreach ($model->cmsInboxes as $rows) {
                            if ($rows->user_id == $this->getCurentUser()->id && $rows->inbox_trash == 1) {
                                return
                                    Html::a("<span style='font-size: 14px; color: black;'>"
                                        . $rows->doc->type->type_name . "</span>"
                                        , ['mail/read-reply-mail?id=' . $rows->outbox->outbox_id]);
                            }
                        }

                    }
                },
                'format' => 'raw'
            ],
            [
                'label' => false,
                'contentOptions' => ['class' => 'mailbox-date', 'style' => 'color: black;font-size:14px;width:100px;padding-top:12px'],
                'attribute' => 'inbox_time',
                'value' => function ($model, $key, $index, $column) {
                    //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
                    if ($model->outbox_trash == 1 && $model->user_id == $this->getCurentUser()->id) {
                        return '<b>' . TimeAgo::widget(['timestamp' => $model->outbox_time,
                                'language' => Yii::$app->language]) . '</b>';
                    } else {
                        foreach ($model->cmsInboxes as $id) {
                            return '<b>' . TimeAgo::widget(['timestamp' => $id->outbox->outbox_time,
                                    'language' => Yii::$app->language]) . '</b>';
                        }

                    }
                },
                'format' => 'raw'
            ],

        ];
        return $gridColumns;

    }

    public function setIconSecret($model)
    {
        $iconSecret = "";
        if ($model->doc->secret->secret_name == "ปกติ") {
            /* $icon = '<i class="fa fa-unlock-alt" title="'
                 . controllers::t('menu', 'Normal secret') .
                 '"style="margin-right: 3px"></i>' . $icon;*/
            $iconSecret = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/padlock%20(3).png" title="'
                . controllers::t('menu', 'Normal secret') .
                '"  style="width:20px;">';
        } elseif ($model->doc->secret->secret_name == "ลับ") {
            /* $icon = '<i class="fa fa-lock" title="'
                 . controllers::t('menu', 'secret') .
                 '"  style="margin-right: 3px"></i>' . $icon;*/
            $iconSecret = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/padlock%20(2).png" title="'
                . controllers::t('menu', 'secret') .
                '"  style="width:20px;">';
        } elseif ($model->doc->secret->secret_name == "ลับมาก") {
            /*$icon = '<i class="fa fa-lock" title="'
                . controllers::t('menu', 'Very secret') .
                '"  style="margin-right: 3px"></i>' . $icon;*/
            $iconSecret = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/padlock%20(1).png" title="'
                . controllers::t('menu', 'Very secret') .
                '"  style="width:20px;">';
        } elseif ($model->doc->secret->secret_name == "ลับที่สุด") {
            /* $icon = '<i class="fa fa-lock" title="'
                 . controllers::t('menu', 'Most secret') .
                 '"  style="margin-right: 3px"></i>' . $icon;*/
            $iconSecret = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/padlock.png" title="'
                . controllers::t('menu', 'Most secret') .
                '"  style="width:20px;">';
        }
        $iconSpeed = $this->setIconSpeed($model);
        return $iconSpeed . " " . $iconSecret;
    }

    public function setIconSpeed($model)
    {
        $iconSpeed = "";
        if ($model->doc->speed->speed_name == "ปกติ") {
            /* $icon = '<i class="fa fa-male" title="'
                 . controllers::t('menu', 'Normal speed') .
                 '" style="margin-right: 3px"></i>' . $icon;*/
            $iconSpeed = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/high-voltage%20(4).png" title="'
                . controllers::t('menu', 'Normal speed') .
                '"  style="width:20px;">';
        } elseif ($model->doc->speed->speed_name == "ด่วน") {
            /* $icon = '<i class="fa fa-bicycle" title="'
                 . controllers::t('menu', 'express') .
                 '"  style="margin-right: 3px"></i>' . $icon;*/
            $iconSpeed = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/high-voltage%20(3).png" title="'
                . controllers::t('menu', 'express') .
                '"  style="width:20px;">';
        } elseif ($model->doc->speed->speed_name == "ด่วนมาก") {
            /* $icon = '<i class="fa fa-space-shuttle" title="'
                 . controllers::t('menu', 'Very urgent') .
                 '" style="margin-right: 3px"></i>' . $icon;*/
            $iconSpeed = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/high-voltage%20(1).png" title="'
                . controllers::t('menu', 'Very urgent') .
                '"  style="width:20px;">';
        } elseif ($model->doc->speed->speed_name == "ด่วนที่สุด") {
            /* $icon = '<i class="fa fa-flash" title="'
                 . controllers::t('menu', 'Most urgent') .
                 '" style="margin-right:3px"></i>' . $icon;*/
            $iconSpeed = '<img src="' . Yii::getAlias('@web/..') . '/modules/correspondence/style/images/high-voltage%20(2).png" title="'
                . controllers::t('menu', 'Most urgent') .
                '"  style="width:20px;">';
        }
        return $iconSpeed;
    }
}
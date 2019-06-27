<?php

namespace app\modules\correspondence\models\gridview;

use app\modules\correspondence\controllers;
use app\modules\correspondence\models\CmsAddress;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\correspondence\models\CmsDocument;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * DocumentGridView represents the model behind the search form of `app\modules\correspondence\models\CmsDocument`.
 */
class RollGridView extends CmsAddress
{
    /**
     * @inheritdoc
     */
    // add the public attributes that will be used to store the data to be search
    public $subType;
    public $count;
    public $nbProd;

    public function rules()
    {
        return [
//            [['doc_id', 'doc_subject', 'receive_date', 'sent_date', 'doc_rank', 'doc_expire', 'doc_tel', 'doc_date', 'doc_from', 'doc_id_regist', 'doc_ref', 'address_id'], 'safe'],
//            [['check_id', 'secret_id', 'speed_id', 'type_id', 'user_id', 'sub_type_id', 'doc_dept_id'], 'integer'],
//            [['money'], 'number'],
            //[['sub_type_name'],'string']
            [['address_year', 'subType'], 'string'],
            [['sub_type_id'], 'integer'],
            [['address_id'], 'string'],
            [['address_name'], 'string'],
            [['subType', 'count', 'nbProd'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function gridColumnsReceiveWithFolder()
    {
        $gridColumns = [
            [
                'label' => controllers::t('menu', 'Category'),
                'attribute' => 'subType',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->subType->sub_type_name,
                        ['staff-receive/receive-roll-in-folder?id=' . $model->address_id]
                    );
                },
                'format' => 'raw',
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'attribute' => 'address_id',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->address_id,
                        ['staff-receive/receive-roll-in-folder?id=' . $model->address_id]
                    );
                },
                'format' => 'raw',
            ],
            [
                'label' => controllers::t('menu', 'Folder'),
                'attribute' => 'address_name',
                'headerOptions' => ['class' => 'text-center'],
                'value' => function ($model, $key, $index, $column) {
                    $count = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_receive', 'cms_address'])
                        ->where('cms_doc_roll_receive.doc_id = cms_document.doc_id')
                        ->andWhere(['cms_document.address_id' => $model->address_id])
                        ->andWhere('cms_document.address_id = cms_address.address_id')
                        ->count();
                    return
                        Html::a($model->address_name . " <span class='badge'><b>" . $count . "</b></span>",
                            ['staff-receive/receive-roll-in-folder?id=' . $model->address_id]
                        );
                },
                'format' => 'raw',
                'filter' => true,
            ],
            [
                'label' => controllers::t('menu', 'Annual'),
                'attribute' => 'address_year',
                'filter' => true,
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->address_year,
                        ['staff-receive/receive-roll-in-folder?id=' . $model->address_id]
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],

            ],
            [
                'content' => function ($model) {
                    return Html::a("<i class=\"fa fa-eye\"></i><span>" . controllers::t('menu', 'See the books') . "</span>",
                        ['staff-receive/receive-roll-in-folder?id=' . $model->address_id],
                        ['class' => 'btn btn-3d btn-reveal btn-teal', 'style' => 'width:100%']);
                }
            ]
        ];
        return $gridColumns;
    }

    public function gridColumnsReceiveInFolder()
    {
        $gridColumns = [
            [
                'label' => controllers::t('menu', 'Registration number'),
                'attribute' => 'cmsDocRollReceives',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsDocRollReceives as $receive_id) {
                        return Html::a(substr($receive_id->doc_roll_receive_id, -4),
                            ['staff-receive/detail_book?id=' . $model->doc_id]
                        );
                    }
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Receive Date'),
                'headerOptions' => ['class' => 'class="col-sm-1 text-center"'],
                'attribute' => 'receive_date',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(controllers::DateThai($model->receive_date),
                        ['staff-receive/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
            ],
            [
                'label' => controllers::t('menu', 'Book number'),
                'headerOptions' => ['class' => 'class="col-sm-1 text-center"'],
                'attribute' => 'doc_id_regist',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->doc_id_regist,
                        ['staff-receive/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw'
            ],
            [
                'label' => controllers::t('menu', 'From'),
                'headerOptions' => ['class' => 'class="col-sm-2 text-center"'],
                'attribute' => 'docDept',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->docDept->doc_dept_name,
                        ['staff-receive/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
            ],
            [
                'label' => controllers::t('menu', 'To'),
                'headerOptions' => ['class' => 'class="col-sm-2 text-center"'],
                'attribute' => 'cmsInboxes',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsInboxes as $items) {
                        if (count($model->cmsInboxes) > 2 && $items->user_id != Yii::$app->user->identity->id && !is_null($items->inbox_status)) {
                            return Html::a($items->user->prefix_th . $items->user->fname . " " . $items->user->lname . " และคนอื่น ๆ",
                                ['detail_book?id=' . $model->doc_id], ['class' => 'linksWithTarget', 'target' => '_blank']);
                           // break;
                        } else if($items->user_id != Yii::$app->user->identity->id && !is_null($items->inbox_status)){
                            return Html::a($items->user->prefix_th . $items->user->fname . " " . $items->user->lname,
                                ['detail_book?id=' . $model->doc_id], ['class' => 'linksWithTarget', 'target' => '_blank']);

                        }
                    }
                },
                'format' => 'raw',
            ],
            [
                'label' => controllers::t('menu', 'Subject'),
                'headerOptions' => ['class' => 'class="col-sm-3 text-center"'],
                'attribute' => 'doc_subject',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->doc_subject,
                        ['staff-receive/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
            ],
            [
                'label' => controllers::t('menu', 'Doing'),
                'headerOptions' => ['class' => 'class="col-xs-1 text-center"'],
                'attribute' => 'cmsDocRollReceivesDoing',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsDocRollReceives as $receive_id) {
                        return Html::a($receive_id->doc_roll_receive_doing,
                            ['staff-receive/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                        );
                    }
                },
                'format' => 'raw',
                'filter' => true,
            ],
            [
                'label' => controllers::t('menu', 'Status'),
                'headerOptions' => ['class' => 'class="col-xs-2 text-center"'],
                'attribute' => 'check',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(controllers::t('menu', $model->check->check_name),
                        ['staff-receive/detail_book?id=' . $model->doc_id,], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',  // the default buttons + your custom button
                'buttons' => [
                    'update' => function ($url, $model, $key) {     // render your custom button
                        return Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>" . controllers::t('menu', 'Edit') . "</span>",
                            ['staff-receive/edit-receive-form?id=' . $model->doc_id], ['class' => 'btn btn-sm btn-3d btn-reveal btn-blue']);
                    },
                    'delete' => function ($url, $model, $key) {     // render your custom button
                        //if document don't have receiver will not show delete button
                        if ($model->check->check_id != 2) {
                            return "<a href=\"#\" onclick=\"redirectDeleteRoll('" . $model->doc_id . "')\"
                                    class=\"btn btn-sm btn-3d btn-reveal btn-red confirmCancelDocument\">
                                    <i class=\"fa fa-trash\"></i>
                                    <span>" . controllers::t('menu', 'Cancel') . "</span>
                                </a>";
                        }
/*                        return "<a href=\"#\" onclick=\"redirectDeleteRoll('" . $model->doc_id . "')\"
                                    class=\"btn btn-sm btn-3d btn-reveal btn-red confirmDeleteRoll\">
                                    <i class=\"fa fa-trash\"></i>
                                    <span>" . controllers::t('menu', 'Delete') . "</span>
                                </a>";*/
                    },
                ],


            ]

        ];
        return $gridColumns;
    }

    public function gridColumnsSendWithFolder($params)
    {
        $gridColumns = [
            [
                'label' => controllers::t('menu', 'Category'),
                'attribute' => 'subType',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->subType->sub_type_name,
                        ['staff-send/send-roll-in-folder?id=' . $model->address_id]
                    );
                },
                'format' => 'raw',
                'filter' => true,
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'attribute' => 'address_id',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->address_id,
                        ['staff-send/send-roll-in-folder?id=' . $model->address_id]
                    );
                },
                'format' => 'raw',
            ],
            [
                'label' => controllers::t('menu', 'Folder'),
                'attribute' => 'address_name',
                'headerOptions' => ['class' => 'text-center'],
                'value' => function ($model, $key, $index, $column) {
                    $count = CmsDocument::find()->from(['cms_document', 'cms_doc_roll_send', 'cms_address'])
                        ->where('cms_doc_roll_send.doc_id = cms_document.doc_id')
                        ->andWhere(['cms_document.address_id' => $model->address_id])
                        ->andWhere('cms_document.address_id = cms_address.address_id')
                        ->count();
                    return
                        Html::a($model->address_name . " <span class='badge'><b>" . $count . "</b></span>",
                            ['staff-send/send-roll-in-folder?id=' . $model->address_id]
                        );
                },
                'format' => 'raw',
                'filter' => true,
                'format' => 'html'
            ],
            [
                'label' => controllers::t('menu', 'Annual'),
                'attribute' => 'address_year',
                'filter' => true,
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->address_year,
                        ['staff-send/send-roll-in-folder?id=' . $model->address_id]
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],

            ],
            [
                'content' => function ($model) {
                    return Html::a("<i class=\"fa fa-eye\"></i><span>" . controllers::t('menu', 'See the books') . "</span>",
                        ['staff-send/send-roll-in-folder?id=' . $model->address_id],
                        ['class' => 'btn btn-3d btn-reveal btn-teal', 'style' => 'width:100%']);
                }
            ]
        ];
        return $gridColumns;


    }

    public function gridColumnsSendInFolder()
    {
        $gridColumns = [
            [
                'label' => controllers::t('menu', 'Sending number'),
                'attribute' => 'cmsDocRollSends',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsDocRollSends as $send_id) {
                        return Html::a(substr($send_id->doc_roll_send_id, -4),
                            ['staff-send/detail_book?id=' . $model->doc_id]
                        );
                    }
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Book number'),
                'attribute' => 'doc_id_regist',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->doc_id_regist,
                        ['staff-send/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Sent Date'),
                'attribute' => 'sent_date',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(controllers::DateThai($model->sent_date),
                        ['staff-send/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'From'),
                'attribute' => 'doc_from',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->doc_from,
                        ['staff-send/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'To'),
                'attribute' => 'docDept',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->docDept->doc_dept_name,
                        ['staff-send/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Subject'),
                'attribute' => 'doc_subject',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->doc_subject,
                        ['staff-send/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Doing'),
                'attribute' => 'cmsDocRollSendsDoing',
                'value' => function ($model, $key, $index, $column) {
                    foreach ($model->cmsDocRollSends as $send_id) {
                        return Html::a($send_id->doc_roll_send_doing,
                            ['staff-send/detail_book?id=' . $model->doc_id], ['target' => '_blank', 'class' => 'linksWithTarget']
                        );
                    }
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'label' => controllers::t('menu', 'Status'),
                'attribute' => 'check',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a(controllers::t('menu', $model->check->check_name),
                        ['staff-send/detail_book?id=' . $model->doc_id,], ['target' => '_blank', 'class' => 'linksWithTarget']
                    );
                },
                'format' => 'raw',
                'headerOptions' => ['class' => 'text-center']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',  // the default buttons + your custom button
                'buttons' => [
                    'update' => function ($url, $model, $key) {     // render your custom button
                        return Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>" . controllers::t('menu', 'Edit') . "</span>",
                            ['staff-send/edit-send-form?id=' . $model->doc_id], ['class' => 'btn btn-sm btn-3d btn-reveal btn-blue']);
                    },
                    'delete' => function ($url, $model, $key) {
                        if($model->check->check_id != 2){
                            return "<a href=\"#\" onclick=\"redirectDeleteRoll('" . $model->doc_id . "')\"
                                               class=\"btn btn-3d btn-sm btn-reveal btn-red confirmDeleteRoll\">
                                                <i class=\"fa fa-trash\"></i>
                                                <span>" . controllers::t('menu', 'Cancel') . "</span>
                                            </a>";
                        }

                    },
                ],


            ]

        ];
        return $gridColumns;
    }

    public function searchRoll($params)
    {

        $query = CmsAddress::find()
            ->joinWith(['subType']);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
        ]);
        $dataProvider->sort->attributes['subType'] = [
            'asc' => ['cms_doc_sub_type.sub_type_name' => SORT_ASC],
            'desc' => ['cms_doc_sub_type.sub_type_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['address_year'] = [
            'asc' => ['cms_address.address_year' => SORT_ASC],
            'desc' => ['cms_address.address_year' => SORT_DESC],
        ];
        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'address_id', $this->address_id]);
        if (null !== $this->subType) {
            $query->orFilterWhere(['like', 'subType.sub_type_name', $this->subType->sub_type_name]);
        }

        return $dataProvider;
    }

}



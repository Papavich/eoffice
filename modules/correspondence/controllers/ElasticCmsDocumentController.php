<?php

namespace app\modules\correspondence\controllers;

use app\modules\correspondence\models\CmsAddress;
use app\modules\correspondence\models\CmsDocument;
use app\modules\correspondence\models\Elastic;
use app\modules\correspondence\models\Search;
use app\modules\eproject\models\ElasticProject;
use Yii;
use app\modules\correspondence\models\ElasticCmsDocument;
use app\modules\correspondence\models\ElasticCmsDocumentSearch;
use yii\data\Pagination;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\Query;
use yii\elasticsearch\QueryBuilder;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ElasticCmsDocumentController implements the CRUD actions for ElasticCmsDocument model.
 */
class ElasticCmsDocumentController extends Controller
{
    /**
     * Lists all ElasticCmsDocument models.
     * @return mixed
     */


    public function actionIndex()
    {
        $elastic = new ElasticCmsDocument();
//        $elastic->doc_id  = '0001';
//        $elastic->doc_subject = 'a 5';
//        if ($elastic->insert()) {
//            echo "Added Successfully";
//        } else {
//            echo "Error";
//        }
        $elastic->deleteIndex();
        $elastic->updateMapping();
        $elastic->createIndex();
        $elastic->reIndex();

    }

    public function actionReindex()
    {
        $elastic = new ElasticCmsDocument();
        $elastic->reIndex();

    }

    public static function Search($roll)
    {
        //this function is check what is user input in system
        // and then this function will invoke typeOfSearch()
        // for filter what type of search user need
        $request = Yii::$app->request;
        $searchBy = $request->get('search_by');
        $keyword = $request->get('keyword');
        $rangeDate = $request->get('range-date');
        $type = $request->get('type');
        $address_id = $request->get('id');

        $filter[] = [
            'terms' => ['roll' => [$roll]]
        ];
        if ($request->get('id')) {
            $filter[] = [
                'terms' => ['address_id' => [strtolower($address_id)]]
            ];
        }
        if ($type != null) {
            foreach ($type as $item) {
                $tmp[] = (int)$item;
            }
            $filter[] = [
                'terms' => ['type_id' => $tmp]
            ];
        }
        //if user don't choose type of search
        if (!$request->get('search_by')) {
            $searchBy = "searchBySubject";
        }
        //ข้อมูลเอาไปใช้แสดง Input search ที่่เคยกรอก
        $searchData = [
            'keyword' => $keyword,
            'search_by' => $searchBy,
            'range-date' => $rangeDate,
            'type' => $type,
        ];

        if ($request->get('keyword') && $request->get('range-date')) {
            $dateStart = substr($rangeDate, 0, 10);
            $dateEnd = substr($rangeDate, 13);
            //echo Yii::$app->controller->id . "  star" . $dateStart . " end" . $dateEnd . "<br>";//current controller id
            $filter[] = [
                "range" => [
                    "doc_date" => [
                        "gte" => $dateStart,
                        "lte" => $dateEnd
                    ]
                ]
            ];
            $raw = self::typeOfSearch($searchBy, $keyword, $filter);

        } elseif ($request->get('keyword')) { //no have range date
            $raw = self::typeOfSearch($searchBy, $keyword, $filter);

        } elseif ($request->get('range-date')) { //have range date
            $dateStart = substr($rangeDate, 0, 10);
            $dateEnd = substr($rangeDate, 13);
            $filter[] = [
                "range" => [
                    "doc_date" => [
                        "gte" => $dateStart,
                        "lte" => $dateEnd
                    ]
                ]
            ];
            $raw = [
                "bool" => [
                    'filter' => [
                        'bool' => [
                            'must' => [
                                $filter
                            ],

                        ]
                    ]
                ]
            ];
        } else { //no have range date and keyword
            $raw = [
                "bool" => [
                    'filter' => [
                        'bool' => [
                            'must' => [
                                $filter
                            ],

                        ]
                    ]
                ]
            ];
        }
        //echo Json::encode($filter);
        //echo Json::encode($raw);
        $query = ElasticCmsDocument::find()->query($raw);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset(0)
            ->limit($countQuery->count())
            ->all();
        //  echo Json::encode($query);
        $docId = [];
        foreach ($models as $item) {
            $docId[] = $item->doc_id;
        }
        return array($docId, $searchData);
    }

    public static function typeOfSearch($searchBy, $keyword, $filter)
    {

        if ($searchBy == "searchBySubject" || $searchBy == "searchByType") {
            $fields = ['doc_subject^3', 'doc_id_regist', 'doc_from^3'];
            $raw = [
                "bool" => [
                    'must' => [
                        'multi_match' => [
                            'query' => $keyword,
                            'fields' => $fields
                        ]
                    ],
                    'filter' => [
                        $filter
                    ]
                ]
            ];
        }
        if ($searchBy == "searchById") {
            $raw = [
                "bool" => [
                    "must" => [
                        [
                            "match" => [
                                "doc_id_regist" => [
                                    "query" => $keyword,
                                    "operator" => "and"
                                ]
                            ]
                        ]
                    ], 'filter' => [
                        $filter
                    ]
                ]
            ];
        }
        return $raw;
    }

    public static function SearchFromMailController()
    {
        $request = Yii::$app->request;
        $searchBy = $request->get('search_by');
        $keyword = $request->get('keyword');
        $id = $request->get('id');
        $filter[] = [
            'terms' => ['roll' => ['staff-receive']]
        ];

        if (!$request->get('search_by')) {
            $searchBy = "searchBySubject";
        }
        //ข้อมูลเอาไปใช้แสดง Input search ที่่เคยกรอก
        $searchData = [
            'keyword' => $keyword,
            'search_by' => $searchBy,
            'id' => $id
        ];

        if ($request->get('keyword')) { //no have range date
            // echo "2 condition";
            $raw = self::typeOfSearch($searchBy, $keyword, $filter);
        } else { //no have range date and keyword
            $raw = [
                "bool" => [
                    'filter' => [
                        'bool' => [
                            'must' => [
                                $filter
                            ],

                        ]
                    ]
                ]
            ];
            //echo "else";
        }
        //echo Json::encode($filter);
        //echo Json::encode($raw);
        $query = ElasticCmsDocument::find()->query($raw);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset(0)
            ->limit($countQuery->count())
            ->all();
        //  echo Json::encode($query);
        $docId = [];
        foreach ($models as $item) {
            $docId[] = $item->doc_id;
        }

        // return $models;
        return array($docId, $searchData);


    }

    public function actionSearch()
    {
        $this->layout = "main_module";
        $request = Yii::$app->request;
        $searchBy = $request->get('search_by');
        $keyword = $request->get('keyword');
        $rangeDate = $request->get('range-date');
        $type = $request->get('type');
        $address_id = $request->get('id');
        //echo Yii::$app->controller->id;//current controller id
        //echo $searchBy.$keyword.$rangeDate.$type;
        $projectData = [];
        $filter[] = [
            'terms' => ['roll' => ['staff-send', 'staff-receive']]
        ];
        if ($request->get('id')) {
            $filter[] = [
                'terms' => ['address_id' => [strtolower($address_id)]]
            ];
        }
        //ข้อมูลเอาไปใช้แสดง Input search ที่่เคยกรอก
        $searchData = [
            'keyword' => $keyword,
            'search_by' => $searchBy,
            'range-date' => $rangeDate,
            'type' => $type,
        ];
        //if user don't choose type of search
        if (!$request->get('search_by')) {
            $searchBy = "searchBySubject";
        }

        if ($request->get('keyword') && $request->get('range-date')) {
            $dateStart = substr($rangeDate, 0, 10);
            $dateEnd = substr($rangeDate, 13);
            //echo Yii::$app->controller->id . "  star" . $dateStart . " end" . $dateEnd . "<br>";//current controller id
            $filter[] = [
                "range" => [
                    "doc_date" => [
                        "gte" => $dateStart,
                        "lte" => $dateEnd
                    ]
                ]
            ];
            $raw = self::typeOfSearch($searchBy, $keyword, $filter);

        } elseif ($request->get('keyword')) { //no have range date
            $raw = self::typeOfSearch($searchBy, $keyword, $filter);

        } elseif ($request->get('range-date')) { //have range date
            $dateStart = substr($rangeDate, 0, 10);
            $dateEnd = substr($rangeDate, 13);
            $filter[] = [
                "range" => [
                    "doc_date" => [
                        "gte" => $dateStart,
                        "lte" => $dateEnd
                    ]
                ]
            ];
            $raw = [
                "bool" => [
                    'filter' => [
                        $filter
                    ]
                ]
            ];
        } else { //no have range date and keyword
            $raw = [
                "bool" => [
                    'filter' => [
                        'bool' => [
                            'must' => [
                                $filter
                            ],

                        ]
                    ]
                ]
            ];
        }
        //echo Json::encode($filter);
        $query = ElasticCmsDocument::find()->query($raw);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 100]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $docId = [];
        foreach ($models as $i => $item) {
            $docId[] = $item->doc_id;
        }
        // $projectData = CmsDocument::find()->where(['doc_id' => $docId])->all();
        //echo Json::encode($models);
        //echo Json::encode($projectData);
        echo Json::encode($docId);
        foreach ($docId as $key) {
            $projectData[] = CmsDocument::find()->where(['doc_id' => $key])->all();

        }
        return $this->render('search', [
            'searchData' => $searchData,
            'dataProvider' => $projectData,
            'pages' => $pages,
            'raw' => $raw
        ]);

    }

    protected function findModel($doc_id, $sub_type_id, $address_id, $doc_dept_id)
    {
        if (($model = ElasticCmsDocument::findOne(['doc_id' => $doc_id, 'sub_type_id' => $sub_type_id, 'address_id' => $address_id, 'doc_dept_id' => $doc_dept_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

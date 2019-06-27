<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 13/11/2560
 * Time: 10:29
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\office2text\DocxConversion;
use app\modules\eproject\models\ElasticTheory;
use app\modules\eproject\models\ElasticTool;
use app\modules\eproject\models\Project;
use app\modules\eproject\models\ProjectDocument;
use app\modules\eproject\models\ProjectTheory;
use app\modules\eproject\models\ProjectXTool;
use Yii;
use yii\web\Controller;

class TaggingController extends Controller
{
    const IS_NOT_PUBLIC_DOCUMENT = 0;

    public function actionProposal()
    {
        //ถ้าหาก Error ไฟล์ใหญ่เกินไปให่ไปเซตใน Elastic indices.query.bool.max_clause_count: 50240

        if (Yii::$app->request->isPost) {
            $keyword = "";
            (Yii::$app->request->post('tool_data')!=null )? $tool = Yii::$app->request->post('tool_data') : $tool = [];
            (Yii::$app->request->post('theory_data')!=null ) ? $theory = Yii::$app->request->post('theory_data') : $theory = [];
            if ($this->getProposal()) {
                $model = $this->getProposal();
                $text = new DocxConversion( $model->getRealFilePath() );

                $keyword = $text->convertToText();
                $rawTheory = [
                    "bool" => [
                        'must' => [
                            'multi_match' => [
                                'query' => $keyword,
                                'fields' => ['title']
                            ]
                        ],
                        'filter' => [
                            'bool' => [
                                'must_not' => [
                                    'terms' => ['theory_id' => $theory]
                                ],


                            ]
                        ]
                    ]
                ];
                $rawTool = [
                    "bool" => [
                        'must' => [
                            'multi_match' => [
                                'query' => $keyword,
                                'fields' => ['title']
                            ]
                        ],
                        'filter' => [
                            'bool' => [
                                'must_not' => [
                                    'terms' => ['tool_id' => $tool]
                                ],


                            ]
                        ]
                    ]
                ];
                foreach (ElasticTheory::find()->query( $rawTheory )->minScore( 10)->limit( 5 )->all() as $item) {
                    $theory[] = $item->theory_id;
                }
                foreach (ElasticTool::find()->query( $rawTool )->minScore( 1.5 )->limit( 5 )->all() as $item) {
                    $tool[] = $item->tool_id;
                }
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'theory' => $theory,
                'tool' => $tool
            ];
        }

    }

    public function actionAbstract()
    {
        if (Yii::$app->request->isPost) {
//            $type = [];
            //Get Old Attribute
//            foreach (ProjectTheory::find()->where( ['epro_project_id' => Project::findProjectId()] )->all() as $item) {
//                $theory[] = $item->epro_theory_id;
//            }
//            foreach (ProjectXTool::find()->where( ['project_id' => Project::findProjectId()] )->all() as $item) {
//                $tool[] = $item->tool_id;
//            }

            //Search Theory
//            $keyword=Project::findOne(Project::findProjectId())->abstract;
            $keyword = $_POST['keyword'];
            (Yii::$app->request->post('tool_data')!=null )? $tool = Yii::$app->request->post('tool_data') : $tool = [];
            (Yii::$app->request->post('theory_data')!=null ) ? $theory = Yii::$app->request->post('theory_data') : $theory = [];
            $rawTheory = [
                "bool" => [
                    'must' => [
                        'multi_match' => [
                            'query' => $keyword,
                            'fields' => ['title']
                        ]
                    ],
                    'filter' => [
                        'bool' => [
                            'must_not' => [
                                'terms' => ['theory_id' => $theory]
                            ],


                        ]
                    ]
                ]
            ];
            $rawTool = [
                "bool" => [
                    'must' => [
                        'multi_match' => [
                            'query' => $keyword,
                            'fields' => ['title']
                        ]
                    ],
                    'filter' => [
                        'bool' => [
                            'must_not' => [
                                'terms' => ['tool_id' => $tool]
                            ],


                        ]
                    ]
                ]
            ];
            foreach (ElasticTheory::find()->query( $rawTheory )->minScore( 2 )->limit( 5 )->all() as $item) {
                $theory[] = $item->theory_id;
            }
            foreach (ElasticTool::find()->query( $rawTool )->minScore( 0.5 )->limit( 5 )->all() as $item) {
                $tool[] = $item->tool_id;
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'theory' => $theory,
                'tool' => $tool
            ];
        }

    }

    private function getProposal()
    {
        return ProjectDocument::find()->where( ['project_id' => Project::findProjectId()] )
            ->andWhere( ['document_type_id' => 1] )
            ->andWhere( ['file_type_id' => 2] )->one();
    }

}
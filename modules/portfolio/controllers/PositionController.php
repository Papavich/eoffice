<?php

namespace app\modules\portfolio\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\data\SqlDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Site controller.
 * It is responsible for displaying static pages, and logging users in and out.
 */
class PositionController extends BackendController {

    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
   /* public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'delete', 'grid'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        Yii::$app->db->createCommand()->prepare(true);
        $position = Yii::$app->db->createCommand("SELECT * FROM position ORDER BY position_id ASC")->queryAll();
        $count = Yii::$app->db->createCommand("SELECT COUNT([[position_id]]) FROM {{position}}")->queryScalar();

        
            return $this->render('index', [
                    'positions' => $position,
                    'count' => $count,
        ]);
    }

    public function actionDelete($id) {
        Yii::$app->db->createCommand()->delete('position', ['position_id' => $id])->execute();
        return $this->redirect(['index']);
    }

    public function actionGrid() {
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM position')->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT * FROM position',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('grid', [
                    'dataProvider' => $dataProvider,
        ]);
    }

}

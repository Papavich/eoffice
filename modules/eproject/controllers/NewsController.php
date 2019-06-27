<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 5/7/2560
 * Time: 16:48
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\controllers;
use app\modules\eproject\models\News;
use app\modules\eproject\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    const NEWS_PAGE_SIZE = 10;
    //DEFAULT CONST
    const PENDING_NEWS = 1;
    const APPROVED_NEWS = 2;
    const DISAPPROVED_NEWS = 3;
    const EDIT_PENDING_NEWS = 4;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {

        $query = News::find()->where( ['status_id' => $this::APPROVED_NEWS] )->orderBy( 'crtime DESC' );
        $countQuery = clone $query;
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => self::NEWS_PAGE_SIZE] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();
        return $this->render( 'index', [
            'data' => $models,
            'pages' => $pages,
        ] );
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionStatus($id = 0)
    {
        if ($id != 0) {
            $model = $this->findModel( $id );
            $model->status_id = $this::APPROVED_NEWS;;
            if ($model->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
            }
        }
        $dataProvider = News::find()->where( ['status_id' => $this::PENDING_NEWS] )->all();
        return $this->render( 'status', [
            'data' => $dataProvider
        ] );
    }


    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new News();
        if(User::findOne(Yii::$app->user->identity->getId())->user_type_id==User::TYPE_ADMIN){
            $model->status_id = $this::PENDING_NEWS;
        }else{
            $model->status_id = $this::APPROVED_NEWS;
        }
        if (Yii::$app->request->isPost) {
            if ($model->load( Yii::$app->request->post() ) && $model->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
                return $this->redirect( ['view', 'id' => $model->id] );
            } else {

                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
                return $this->render( 'create', [
                    'model' => $model,
                ] );
            }
        } else {
            return $this->render( 'create', [
                'model' => $model,
            ] );
        }

    }


    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel( $id );
        if ($model->load( Yii::$app->request->post() )) {
            if ($model->save()) {
                Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
            } else {
                Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
            }
            return $this->redirect( ['view', 'id' => $model->id] );
        } else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $model = $this->findModel( $id );
        $model->status_id = $this::DISAPPROVED_NEWS;
        if ($model->save()) {
            Yii::$app->session->setFlash( 'success', controllers::t( 'label', 'Data Saved Successful' ) );
        } else {
            Yii::$app->session->setFlash( 'warning', controllers::t( 'label', 'Something Went Wrong' ) );
        }
        return $this->redirect( ['index'] );
    }


    /**
     * @param $id
     * @return News
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = News::findOne( $id )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

}
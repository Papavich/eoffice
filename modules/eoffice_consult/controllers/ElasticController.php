<?php

namespace app\modules\eoffice_consult\controllers;

use Yii;
use yii\web\Controller;
use app\modules\eoffice_consult\models\Elastic;
use app\modules\eoffice_consult\models\Search;
use yii\base\Model;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\Query;
use yii\elasticsearch\QueryBuilder;

/**
 * Default controller for the `eoffice_consult` module
 */
class ElasticController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    //  public function actionIndex()
    //  {
    //      $elastic        = new elastic();
    //      $elastic->name  = 'ahmed';
    //      $elastic->email = 'ahmedkhan_847@hotmail.com';
    //      if ($elastic->insert()) {
    //          echo "Added Successfully";
    //      } else {
    //          echo "Error";
    //      }
     //
    //  }

     public function actionIndex()
    {
      $this->layout = "main_modules";
      return $this->render('index');

    }

   public function actionSearch()
    {
        $elastic = new Search();
        $result  = $elastic->Searches(Yii::$app->request->queryParams);
        $query = Yii::$app->request->queryParams;
        return $this->render('search', [
            'searchModel'  => $elastic,
            'dataProvider' => $result,
            'query'        => $query['search'],
        ]);
    }



}

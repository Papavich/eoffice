<?php

namespace app\modules\eoffice_consult\controllers;

use Yii;
use yii\web\Controller;
use app\modules\eoffice_consult\models\ConsultPost;
use app\modules\eoffice_consult\models\ConsultQa;
/**
 * Default controller for the `eoffice_consult` module
 */
class TagController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
     public function actionIndex()
    {
      $this->layout = "main_modules";
      $model = new ConsultPost();

      return $this->render('index', [
          'model'  => $model,
      ]);

    }

    public function actionSearch()
   {
     $this->layout = "main_modules";
     $model = new ConsultPost();

     if ($model->load(Yii::$app->request->post())) {

       $tag = $_POST['ConsultPost']['post_ans'];

       if( count($tag) == 0){
          $model = new ConsultPost();
         return $this->render('index', [
             'model'  => $model,
         ]);
       }else if( count($tag) == 1){
         $model = ConsultQa::find()
         ->Where(['LIKE', 'tag', $tag[0]])
         ->all();
       }else if( count($tag) == 2){
         $model = ConsultQa::find()
         ->Where(['LIKE', 'tag', $tag[0]])
         ->andWhere(['LIKE', 'tag', $tag[1]])
         ->all();
       }else if( count($tag) == 3){
         $model = ConsultQa::find()
         ->Where(['LIKE', 'tag', $tag[0]])
         ->andWhere(['LIKE', 'tag', $tag[1]])
         ->andWhere(['LIKE', 'tag', $tag[2]])
         ->all();
       }else if( count($tag) == 4){
         $model = ConsultQa::find()
         ->Where(['LIKE', 'tag', $tag[0]])
         ->andWhere(['LIKE', 'tag', $tag[1]])
         ->andWhere(['LIKE', 'tag', $tag[2]])
         ->andWhere(['LIKE', 'tag', $tag[3]])
         ->all();
       }else if( count($tag) == 5){
         $model = ConsultQa::find()
         ->Where(['LIKE', 'tag', $tag[0]])
         ->andWhere(['LIKE', 'tag', $tag[1]])
         ->andWhere(['LIKE', 'tag', $tag[2]])
         ->andWhere(['LIKE', 'tag', $tag[3]])
         ->andWhere(['LIKE', 'tag', $tag[4]])
         ->all();
       }

         return $this->render('ans', [
            'tag'  => $tag,
             'model'  => $model,
         ]);

     }

    //  return $this->render('index', [
    //      'model'  => $model,
    //  ]);
   }

}

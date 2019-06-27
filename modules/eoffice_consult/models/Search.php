<?php
namespace app\modules\eoffice_consult\models;

use app\modules\eoffice_consult\models\Elastic;
use yii\base\Model;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\Query;
use yii\elasticsearch\QueryBuilder;

class Search extends Elastic
{
   public function Searches($value)
   {
       $searchs      = $value['search'];
       $query        = new Query();
       $db           = Elastic::getDb();
       $queryBuilder = new QueryBuilder($db);
       $match   = ['match' => ['article_content' =>$searchs]];
       $query->query = $match;
       $build        = $queryBuilder->build($query);
       $re           = $query->search($db, $build);
       $dataProvider = new ActiveDataProvider([
           'query'      => $query,
           'pagination' => ['pageSize' => 10],
       ]);
       return $dataProvider;
   }
}
?>

<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\modules\eoffice_ta\controllers;

use yii\grid\GridView;

use app\modules\eoffice_ta\components\NextPage;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaDocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?php
$title = controllers::t('label','Manage Document');
$file = controllers::t('label','File');
$back = controllers::t( 'label', 'Back' );
$create = controllers::t( 'label', 'Create' );
$crtime = controllers::t('label','Create Time');
$crby = controllers::t('label','Create By');
$udby = controllers::t('label','Update By');
$udtime = controllers::t('label','Update Time');
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- page title -->

<div class="ta-news-detail">
    <!--content news -->

    <div class="panel-body">
        <!-- เรียก view _search.php -->

</div>


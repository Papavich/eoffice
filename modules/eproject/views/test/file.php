<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;

$this->title =controllers::t( 'label', 'Test' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $data; ?>



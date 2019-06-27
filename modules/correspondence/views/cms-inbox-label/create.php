<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\correspondence\models\CmsInboxLabel */

$this->title = 'Create Cms Inbox Label';
$this->params['breadcrumbs'][] = ['label' => 'Cms Inbox Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-inbox-label-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

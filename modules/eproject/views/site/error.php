<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

?>
<div class="site-error">
    <p class="lead">

        <strong>Oops!</strong> <?= nl2br(Html::encode($message)) ?><br />
        We are fixing it! Please come back in a while.
    </p>


</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrowRescript */

?>
<div>
    <!-- page title -->
    <header id="page-header">
        <h1>คำร้องรออนุมัติการยืมครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">คำร้องรออนุมัติการยืม</a></li>
            <li class="active">อนุมัติการยืม</a></li>
        </ol>
    </header>
    <!-- /page title -->


    <div id="content" class="padding-20">
        <!--content-->
        <div class="asset-detail-view">
            <?= $this->render('_form_rescript', [
                'model' => $model,
                'person' => $person,

            ]) ?>

        </div>
        <!--end content-->
    </div>
</div>



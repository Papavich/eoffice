<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrow */

$this->title = 'Create Asset Borrow';
$this->params['breadcrumbs'][] = ['label' => 'Asset Borrows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <!-- page title -->
    <header id="page-header">
        <h1>ยืมครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">ยืมครุภัณฑ์</a></li>
        </ol>
    </header>
    <!-- /page title -->


    <div id="content" class="padding-20">
        <!--content-->
        <div class="asset-detail-view">
            <?= $this->render('_form', [
                   // 'user' => $user,
                'person' => $person,
                'modelBorrow' => $modelBorrow,
                'modelsBorrowDetail' => $modelsBorrowDetail,
            ]) ?>

        </div>
        <!--end content-->
    </div>
</div>

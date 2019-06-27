<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetBorrowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Borrows';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div>
        <!-- page title -->
        <header id="page-header">
            <h1>คำร้องขอยืมครุภัณฑ์</h1>
            <ol class="breadcrumb">
                <li><a href="#">หน้าหลัก</a></li>
                <li class="active">รายการคำร้องขอยืมครุภัณฑ์</li>
            </ol>
        </header>
        <!-- /page title -->


        <div id="content" class="padding-20">

            <div id="panel-1" class="panel panel-default">
                <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการที่ยังไม่อนุมัติ</strong> <!-- panel title -->
							</span>

                    <!-- /right options -->

                </div>
                <!-- panel content -->
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
                    ]); ?>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2 col-sm-2"></div>
                            <div class="col-md-3 col-sm-3">
                                <?= $form->field($searchModel, 'borrow_user_fname') ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($searchModel, 'borrow_user_lname') ?>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;</label>
                                <div class="form-group">
                                    <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-3d btn-dirtygreen']) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php ActiveForm::end(); ?>
                    <hr />
                    <center><h2>ผลการค้นหา</h2></center>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,

                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'borrow_id',
                            'borrow_user_fname',
                            'borrow_user_lname',
                            // 'borrow_user_tel',
                            'borrow_date',
                            //'borrow_object',

                            ['class' => 'yii\grid\ActionColumn'],

                        ],
                    ]); ?>

                </div>

            </div>


        </div>



    </div>




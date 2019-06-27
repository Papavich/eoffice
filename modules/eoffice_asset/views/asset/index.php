<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\modules\eoffice_asset\models\AssetGet;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_asset\models\AssetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
    <header id="page-header">
        <h1>รายการครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href="index_admin.html">หน้าหลัก</a></li>
            <li class="active">รายการครุภัณฑ์</li>
        </ol>
    </header>
<?= Html::a('EXCEL', ['excel'], ['class' => 'btn btn-primary']) ?>
    <div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการครุภัณฑ์</strong> <!-- panel title -->
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

                <div class="col-md-3 col-sm-3">
                    <?= $form->field($searchModel, 'asset_year') ?>
                </div>
                <div class="col-md-4 col-sm-4">
                    <?= $form->field($searchModel, 'asset_year') ?>
                </div>
                <div class="col-md-3 col-sm-3">
                    <?php echo $form->field($searchModel, 'asset_get')->dropDownList(ArrayHelper::map(AssetGet::find()->all(), 'asset_get_id', 'asset_get_name'),['prompt'=>'เลือกวิธีการได้มา']) ?>
                </div>
                <div class="col-md-2 col-sm-2">
                    <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;</label>
                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>

        </div>


        <hr />
        <center><h2>ผลการค้นหา</h2></center>

<?= GridView::widget([
    'dataProvider' => $dataProvider,

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //  'asset_id',
        'asset_date',
        'asset_year',
       // 'asset_get',
        'asset_budget',
        // 'asset_company',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
    </div>
    </div>
        <?php ActiveForm::end(); ?>
    </div>


</div>

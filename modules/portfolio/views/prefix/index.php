<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PrefixSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลคำนำหน้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prefix-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                        </div>
                    </div>



                    <p>
                        <?= Html::a('สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('ส่งออก Excel', ['excel'], ['class' => 'btn btn-warning']) ?>
                        <?php //Html::a('นำเข้า Excel', ['import'], ['class' => 'btn btn-info']) ?>
                    </p>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'prefix_id',
                            [
                                'attribute' => 'prefix_id',
                                'options' => ['width' => '100'],
                            ],
                            'prefix_name',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'เครื่องมือ',
                                'headerOptions' => ['width' => '100'],
                                'template' => '{update} {delete}',
                            ],
                        ],
                    ]);
                    ?>

                </div>
            </div>

        </div>
    </div>



</div>

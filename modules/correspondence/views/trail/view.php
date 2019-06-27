<?php

use \app\modules\correspondence\controllers;
use bedezign\yii2\audit\Audit;
use yii\helpers\Html;
use yii\widgets\DetailView;
use \app\modules\correspondence\models\CmsDocument;
use \app\modules\correspondence\models\AuditTrail;
use \app\modules\correspondence\models\model_main\EofficeCentralViewPisUser;

/** @var yii\web\View $this */

/** @var bedezign\yii2\audit\models\AuditTrail $model */


$this->title = Yii::t('audit', 'Trail #{id}', ['id' => $_GET['id']]);
$head = CmsDocument::findOne($_GET['id']);
?>
<section id="middle">
    <header id="page-header">
        <h1><?= $head->doc_subject ?></h1>
        <ol class="breadcrumb">
            <li><a href="index"><?= controllers::t('menu', 'Log') ?></a></li>
            <li class="active"><?= $head->doc_subject ?></li>
        </ol>
    </header>
    <div class="wizard" style="padding: 0px 0 0px 3%;">
        <div class="padding-20">
            <?php
            echo "<h2>" . controllers::t('menu', 'Activity Log') . " " . $head->doc_subject . "</h2>";
            echo \yii\grid\GridView::widget([
                'tableOptions' => [
                    'class' => 'table table-hover table-bordered',
                    'cellspacing' => '0',
                    'style' => 'width: 100%'
                ],
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'user_id',
                        'label' => controllers::t('menu', 'Username'),
                        'class' => 'yii\grid\DataColumn',
                        'contentOptions'=>['style' => 'width: auto;'],
                        'value' => function ($data) {
                            if($data->user->PREFIXNAME){
                                return $data->user->PREFIXNAME.$data->user->person_fname_th . " " . $data->user->person_lname_th;
                            }else{
                                return "admin";
                            }
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'action',
                        'contentOptions'=>['style' => 'width:100px;'],
                    ],
                    [
                        'attribute' => 'field',
                        'contentOptions'=>['style' => 'width: auto;'],
                        'value' => function ($data) {
                            //TODO ดึงข้อมูลที่ถูกต้องจากวิว
                            //$user = \app\modules\correspondence\models\model_main\EofficeCentralViewPisUser::findOne($data->user_id);
                            //return $user->person_fname_th . " " . $user->person_lname_th;
                            return controllers::t('menu',$data->field);
                        },
                    ],
                    [
                        'attribute' => 'created',
                        'options' => ['width' => '200px'],
                    ],
                    [
                        'label' => Yii::t('audit', 'Diff'),
                        'options' => ['width' => '450px'],
                        'value' => function ($model) {
                            $diff = new AuditTrail();
                            return $diff->getDiffHtml($model);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]);
            ?>
            <!--<table class="table table-hover table-bordered table-responsive">
                <thead>
                <th class="text-center">ID</th>
                <th class="text-center">Action</th>
                <th class="text-center">Field</th>
                <th class="text-center">Created</th>
                <th class="text-center">Difference</th>
                </thead>
                <tbody>
                <?php
            /*                foreach ($model as $row) {
                                echo "<tr>";
                                echo "<td>" . $row->id . "</td>";
                                echo "<td>" . $row->action . "</td>";
                                echo "<td>" . $row->field . "</td>";
                                echo "<td>" . $row->created . "</td>";
                                echo "<td>" . $row->getDiffHtml() . "</td>";
                                echo "</tr>";
                            }
                            */ ?>
                </tbody>
            </table>-->
        </div>

    </div>
</section>
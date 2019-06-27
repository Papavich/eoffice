<?php
use kartik\widgets\Select2;
use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\modules\personsystem\controllers;
use kartik\export\ExportMenu;
?>
<?= Html::csrfMetaTags() ?>
<!-- page title -->
<div id="content" class="padding-20">
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong> <i class="fa fa-edit"></i> <?= controllers::t('label','Edit Student') ?></strong>
							</span>
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                       data-placement="bottom"><i class="fa fa-expand"></i></a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
            <?php
            $form = ActiveForm::begin( ['id' => 'search-form','action'=>'search-student-skill', 'method' => 'get'] );
            echo Select2::widget([
               // 'theme'=> Select2::THEME_KRAJEE,
                'name' => 'id_skill',
                'data' => ArrayHelper::map(\app\modules\personsystem\models\Skill::find()->select(['skill_name','id_skill'])->all(),"id_skill","skill_name"),
                'options' => ['placeholder' => 'Search Skill From Student ...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'maximumInputLength' => 10
                ],
            ]);
            ?>
                </div>
                <div class="col-md-1">
            <?= Html::submitButton(Yii::t('app', 'Search <i class="fa fa-search"></i>'), ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
                </div>
            </div>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                //'summary'=>'',
                'panel'=>['before'=>' ','type'=>'default',
                    // 'heading'=>controllers::t('label','Table Show Student')
                            ],
                'layout' => '{items}{summary}{pager}',
                'tableOptions' => [
                    'class' => 'table  table-bordered table-hover dataTable ',
                ],
                'columns' => [
                  ['class'=>'kartik\grid\SerialColumn'],
                    [
                        'filter' => $searchModel,
                        'header' => controllers::t('label', 'Student Code'),
                        'attribute' => 'STUDENTCODE',
                    ],
                    [

//                        'filterWidgetOptions'=>['theme'=>Select2::THEME_DEFAULT],
//                        'filterType'=>GridView::FILTER_SELECT2,
//                        'select2Options'=>['theme'=>\kartik\select2\Select2::THEME_DEFAULT] ,
                        'filter' => ArrayHelper::map(\app\modules\personsystem\models\ViewStudentFull::find()->select(["reg_prefix.PREFIXNAME", "reg_prefix.PREFIXID"])
                            ->leftJoin('reg_prefix', 'reg_prefix.PREFIXID = view_student_full.PREFIXID')->groupBy("reg_prefix.PREFIXID")->all(), 'PREFIXNAME', 'PREFIXNAME'),
                        'header' => controllers::t('label', 'Prefix'),

                       // 'theme'=> 'panel-warning',
                        'attribute' => 'PREFIXNAME',
                        'value' => function ($data) {
                            return $data->PREFIXNAME;
                        }
                    ],
                    [
                        'filter' => $searchModel,
                        'header' => controllers::t('label', 'Name'),
                        'attribute' => 'STUDENTNAME',
                    ],
                    [
                        'filter' => $searchModel,
                        'header' => controllers::t('label', 'Surname'),
                        'attribute' => 'STUDENTSURNAME',
                    ],
                    [

//                        'filterWidgetOptions'=>['theme'=>Select2::THEME_DEFAULT],
//                        'filterType'=>GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(\app\modules\personsystem\models\Major::find()->select('major_name')->all(), 'major_name', 'major_name'),
                        'header' => controllers::t('label', 'Major Name'),
                        'attribute' => 'major_name',
                    ],
                    [

                        'filter' => ArrayHelper::map(\app\modules\personsystem\models\RegSysbytedes::find()
                            ->select(["reg_sysbytedes.BYTEDES", "reg_sysbytedes.BYTECODE"])
                            ->innerJoin('reg_studentmaster', 'reg_studentmaster.STUDENTSTATUS = reg_sysbytedes.BYTECODE')
                            ->where(['reg_sysbytedes.TABLENAME' => "STUDENTSTATUS", 'reg_sysbytedes.COLUMNNAME' => "STUDENTSTATUS"])
                            ->groupBy("reg_studentmaster.STUDENTSTATUS")->all(), 'BYTECODE', 'BYTEDES'),
                        'header' => controllers::t('label', 'Student Status'),
                        'attribute' => 'STUDENTSTATUS',
                        'format' => 'html',
                        'value' => function ($model, $key, $index, $column) {
                            if ($model->STUDENTSTATUS == 10 && $model->STUDENTSTATUS != null) {
                                $t = "<span class=\"label label-sm label-success\"><b>นักศึกษาปกติ</b></span>";
                            } else if ($model->STUDENTSTATUS == 11 && $model->STUDENTSTATUS != null) {
                                $t = "<span class=\"label label-sm label-default\"><b>รักษาสภาพนักศึกษา</b></span>";
                            } else if ($model->STUDENTSTATUS == 40 && $model->STUDENTSTATUS != null) {
                                $t = "<span class=\"label label-sm label-info\"><b>สำเร็จการศึกษา</b></span>";
                            } else if ($model->STUDENTSTATUS != null) {
                                $t = "<span class=\"label label-primary\"><b>" . controllers\GetModelController::getFindStudentStatus($model->STUDENTSTATUS) . "</b></span>";
                            } else {
                                $t = "<span style=\"color:red;\">ไม่มีข้อมูล</span>";
                            }
                            return $t;
                        }
                    ],
                    [
                        'filter' => $searchModel,
                        'header' => controllers::t('label', 'Student Year'),
                        'attribute' => 'STUDENTYEAR',
                    ],
                    [

                        'filter' => ArrayHelper::map(\app\modules\personsystem\models\RegLevel::find()
                            ->select(["reg_level.LEVELID", "reg_level.LEVELNAME"])
                            ->innerJoin('reg_studentmaster', 'reg_studentmaster.LEVELID = reg_level.LEVELID')->groupBy("reg_level.LEVELID")->all(), 'LEVELID', 'LEVELNAME'),
                        'header' => controllers::t('label', 'Type Name'),
                        'attribute' => 'LEVELNAME',
                    ],
                    [

                        'filter' => ArrayHelper::map(\app\modules\personsystem\models\ViewStudentJoinUser::find()->select('ADMITACADYEAR')->orderBy(['ADMITACADYEAR' => SORT_DESC])->distinct()->all(), 'ADMITACADYEAR', 'ADMITACADYEAR'),
                        'header' => controllers::t('label', 'Admit Year'),
                        'attribute' => 'ADMITACADYEAR',
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'contentOptions' => [
                            'noWrap' => true
                        ],
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['student/admin-view-student', 'id' => $model->STUDENTID,]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['student/admin-update-student', 'id' => $model->STUDENTID,]);
                                //  ['data-method' => 'POST', 'data-params' => ['id'=>$model->STUDENTID]]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['student/admin-delete-student'], [
                                    'data' => [
                                        'confirm' => controllers::t('label', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                        'params' => ['id' => $model->STUDENTID]
                                    ]]);
                            }
                        ],],
                ],
            ]); ?>

        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>

<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>

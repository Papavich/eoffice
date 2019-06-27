<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 4/1/2561
 * Time: 15:13
 */
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaAssessment;
use app\modules\eoffice_ta\models\TaTopicAssessment;
?>
<?php
$title = "จัดการหัวข้อการประเมิน";
$back = controllers::t( 'label', 'Back' );
$this->title = $title;
?>
<!-- page title -->

<!-- /page title -->
<div id="content" class="padding-20">
    <!--
                      PANEL CLASSES:
                          panel-default
                          panel-danger
                          panel-warning
                          panel-info
                          panel-success

                      INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                              All pannels should have an unique ID or the panel collapse status will not be stored!
                  -->
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong></strong> <!-- panel title -->
							</span>

            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
            </ul>
            <!-- /right options -->

        </div>

        <!-- panel content -->


        <div class="panel-body">

            <table class="table table-striped table-hover table-bordered" id="sample_editable">
                <thead>
                <tr>

                    <th>รหัสหัวข้อประเมิน</th>
                    <th>ชื่อหัวข้อประเมิน</th>
                    <th>รหัสฟอร์มการประเมิน</th>
                    <th>รอบประเมิน</th>
                    <th>Action</th>

                </tr>
                </thead>
                <?php

                foreach ($model as $row){

                    ?>
                    <tbody>
                    <tr>

                        <td><?=$row->topic_ass_id?></td>
                        <td><?=$row->topic_ass_name?></td>
                        <td><?=$row->assessment_id?></td>
                        <td><?=$row->past?></td>


                        <td><?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-eye-open size-14']), ['ta-topic-assessment/view','id'=>$row->assessment_id,
                                'past'=>$row->past],
                                ['class' => 'btn btn-sm btn-green'])?>

                            <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-pencil size-14']), ['ta-topic-assessment/update','id'=>$row->assessment_id,
                                'past'=>$row->past],
                                ['class' => 'btn btn-sm btn-blue'])?>

                            <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-trash size-14']), ['ta-topic-assessment/delete','id'=>$row->assessment_id,
                                'past'=>$row->past],
                                ['class' => 'btn btn-sm btn-red'])?>
                        </td>


                    </tbody>

                    <?php

                } ?>
            </table>

        </div>

    </div>


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
use app\modules\eoffice_ta\models\TaAssessmentOpen;
?>
<?php
$title = "จัดการฟอร์มประเมิน";
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
                    <th>ลำดับ</th>
                    <th>ชื่อฟอร์ม</th>
                    <th>ผู้ประเมิน</th>
                    <th>รายละเอียด</th>
                    <th>ภาคเรียน</th>
                    <th>ช่วงประเมิน</th>
                    <th>ปีการศึกษา</th>
                    <th>หมายเหตุ</th>
                    <th>สถานะการประเมิน</th>
                    <th>วันที่สร้าง</th>
                    <th><?= Html::a(Html::tag('i', ' สร้างฟอร์มประเมิน',
                            ['class' => 'fa fa-plus size-14']), ['ta-assessment/create'],
                            ['class' => 'btn btn-sm btn-green'])?></th>

                </tbody>
                </tr>
                </thead>

                <?php
                $n=1;
                foreach ($model as $row){

                if ($row->active == '0'){
                    $text_active="Not Active";
                }

                if($row->active == '1'){
                    $text_active="Active";
                }

                ?>
                <tbody>
                <tr>
                    <td><?=$n?></td>
                    <td><?=$row->taAssessment->ta_assessment_name?></td>
                    <td><?=$row->taAssessment->type_user?></td>
                    <td><?=$row->taAssessment->ta_assessment_detail?></td>
                    <td><?=$row->term?></td>
                    <td><?=$row->past?></td>
                    <td><?=$row->year?></td>
                    <td><?=$row->taAssessment->ta_assessment_note?></td>
                    <td><?=$text_active?>
                    <td></td>
                    <td><?= Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-eye-open size-14']), ['ta-assessment/view','id'=>$row->ta_assessment_id,
                            'past'=>$row->past],
                            ['class' => 'btn btn-sm btn-green'])?>

                        <?= Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-pencil size-14']), ['ta-assessment/update','id'=>$row->ta_assessment_id,
                            'past'=>$row->past],
                            ['class' => 'btn btn-sm btn-blue'])?>

                        <?= Html::a(Html::tag('i', '',
                            ['class' => 'glyphicon glyphicon-trash size-14']), ['ta-assessment/delete','id'=>$row->ta_assessment_id,
                            'past'=>$row->past],
                            ['class' => 'btn btn-sm btn-red'])?>
                    </td>

                <?php
                    $n=$n+1;
                } ?>
            </table>
            </div>

        </div>
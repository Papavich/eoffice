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
$title = "เปิด-ปิด ประเมิน";
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
                    <th>รหัสฟอร์มการประเมิน</th>
                    <th>รอบประเมิน</th>
                    <th>ภาคเรียนที่เปิดให้ประเมิน</th>
                    <th>ปีการศึกษาที่เปิดให้ประเมิน</th>
                    <th>สถานะการเปิดประเมิน</th>
                    <th>Action</th>

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
                        <td><?=$row->ta_assessment_id?></td>
                        <td><?=$row->past?></td>
                        <td><?=$row->term?></td>
                        <td><?=$row->year?></td>
                        <td><?=$text_active?></td>

                        <td><?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-eye-open size-14']), ['ta-assessment-open/view','id'=>$row->ta_assessment_id,
                            'past'=>$row->past],
                                ['class' => 'btn btn-sm btn-green'])?>

                            <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-pencil size-14']), ['ta-assessment-open/update','id'=>$row->ta_assessment_id,
                                'past'=>$row->past],
                                ['class' => 'btn btn-sm btn-blue'])?>

                            <?= Html::a(Html::tag('i', '',
                                ['class' => 'glyphicon glyphicon-trash size-14']), ['ta-assessment-open/delete','id'=>$row->ta_assessment_id,
                                'past'=>$row->past],
                                ['class' => 'btn btn-sm btn-red'])?>
                        </td>


                    </tbody>

                    <?php
                    $n=$n+1;
                } ?>
            </table>

            </div>

        </div>


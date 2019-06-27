<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 3/3/2561
 * Time: 16:23
 */
use yii\helpers\Html;
use app\modules\eoffice_ta\models\TaWorking;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRegisterSection;


?>

<!-- Tabs Left -->
<div id="panel-misc-portlet-r2" class="panel panel-default">
    <?php
    foreach ($modelRegisSecs as $regisSec) {
        $sec1 = $regisSec->section;

        $modelRegisSecs2 = TaRegisterSection::findOne(['section'=>$sec1,
            'person_id'=>$regisSec->person_id,'term'=>$regisSec->term]);
        $idtab = 'ttab'.$modelRegisSecs2->section.'l_nobg';
        ?>
    <div class="panel-heading">
        <ul class="nav nav-tabs pull-left">

        <!-- tabs nav -->
                    <li class=""><!-- TAB 1 -->
                        <a href="#<?=$idtab?>" data-toggle="tab"><span class="label label-danger">Sec.<?=$sec1?></span></a>
                    </li>

        </ul>
        <!-- /tabs nav -->

        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
        </ul>
        <!-- /right options -->
    </div>


    <!-- panel content -->
    <div class="panel-body">
        <!-- tabs content -->

        <div class="tab-content transparent">
            <?php
           // foreach ($modelRegisSecs as $regisSec) {
          //  $sec2 = $regisSec->section;
            if ($sec1 == $modelRegisSecs2->section){
            ?>
            <div id="<?=$idtab?>" class="tab-pane"><!-- TAB 1 CONTENT -->
                Sec.<?=$modelRegisSecs2->section?>

                <?php   ///'term'=>$t,'year'=>$y
                   $Working = TaWorking::find()->where(['section'=>$modelRegisSecs2->section,
                       'person_id'=>$regisSec->person_id,'term_id'=>$regisSec->term,
                       'year_id'=>$regisSec->year])->all();
                  ?>
                <div class="table-responsive">
                    <table class="table table-hover table-vertical-middle nomargin">
                        <thead>
                        <tr>
                            <th class="text-center" width="9%">วันที่</th>
                            <th class="text-center" width="2%">หัวข้อ</th>
                            <th class="text-center" width="2%">
                                <?= Html::a(Html::tag('i', ' ลงเวลาทำงาน',
                                    ['class' => 'glyphicon glyphicon-plus']),
                                    ['ta-working/create','sec'=>$modelRegisSecs2->section,
                                        's'=>$modelRegisSecs2->subject_id,
                                        'ver'=>$modelRegisSecs2->subject_version,
                                        't'=>$modelRegisSecs2->term,'y'=>$modelRegisSecs2->year],
                                    ['class' => 'btn btn-sm btn-green ']) ?>
                            </th>
                        </tr>
                        </thead>
                <?php  foreach ($Working as $item){ ?>
                        <tbody>
                        <tr>
                            <td><?=$item->working_date?></td>
                            <td><?=$item->ta_work_title?></td>
                            <td></td>
                        </tr>
                        </tbody>
                    <?php  } ?>
                    </table></div>
            </div><!-- /TAB 1 CONTENT -->
            <?php  } //}?>
        </div>

        <!-- /tabs content -->

    </div>
    <!-- /panel content -->
    <?php  } ?>
</div>
<!-- /Tabs Left -->


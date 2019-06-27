<?php

use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
$this->title = 'รายงาน จำนวนบุคลากร';
?>


<!-- panel content -->
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class=""></i> สถิติ
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group">

                    <div class="col-md-12 col-sm-12">

                        <center><?= Html::a('กราฟสถิติ', ['report/report-one'], ['class' => 'btn btn-success']) ?></center>
                    </div>



                </div>
            </div>
        </div>
        </div>
    <?php
    $ctype = [];

    echo '<div class="panel-body"> ';
    echo '<table class="table table-striped table-hover table-bordered" id="sample_editable_1">';
    echo ' <thead> ';
    echo ' <tr> ';
    echo ' <th rowspan="3" ><center>ชื่อ นามสกุล</center></th> ';
    echo '      <th rowspan="3" ><center>สาขา</center></th>';
    for ($year = $current_year; $year >= $current_year - 4; $year--) {
        echo '   <th rowspan="1" ><center>';
        echo $year;


        echo ' </center></th>';
    }
    /*echo '     <th rowspan="3" ><center>รวม</center></th>';*/


    echo '       </tr> ';
    echo '      <tr>';



    echo '  </thead>';
    echo '    <tbody>';
    echo '   <tr>';
    foreach ($project_order_count as $person) {

        echo '<tr>';
        echo '<td>' . $person['name'] . '</td>';
        echo '<td>' . $person['dept'] . '</td>';

        foreach ($person['years'] as $year) {





                    echo '<td>' . $type['count'] . '</td>';




        }
        echo '</tr>';

    }
    echo '   </tr>';



    echo '   </tbody>';
    echo '</table>';

    echo  '</div>';



    ?>

</div>
<!-- /panel content -->


</div>
</section>
<!-- /MIDDLE -->
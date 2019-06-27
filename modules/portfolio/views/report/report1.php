<?php

use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;

$this->title = 'รายงาน จำนวนบุคลากร';
?>


<!-- panel content -->
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class=""></i> ค้นหาข้อมูล สถิติ
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group">

                    <div class="col-md-12 col-sm-12">

                        <center><?= Html::a('สถิตินักศึกษา', ['report/report-std'], ['class' => 'btn btn-success']) ?>
                            <?= Html::a('กราฟสถิติ', ['report/report2'], ['class' => 'btn btn-info']) ?></center>
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
    for ($year = $current_year; $year >= $current_year - 1; $year--) {
        echo '   <th colspan="6" ><center>';
        echo $year;


        echo ' </center></th>';
    }
    /*echo '     <th rowspan="3" ><center>รวม</center></th>';*/

    echo '       </tr> ';
    echo '      <tr>';
    for ($year = $current_year; $year >= $current_year - 1; $year--) {
        echo '    <th colspan="3" ><center>National</center></th>';
        echo '    <th colspan="3" ><center>International</center></th>';
    }
    echo '     </tr>';
    echo '<tr> ';
    for ($year = $current_year; $year >= $current_year - 1; $year--) {
        echo '   <td ><center>Journal</center></td>';
        echo ' <td><center>Conference</center></td>';
       echo '    <td><center>Book</center></td>';
        echo '     <td><center>Journal</center></td>';
        echo '    <td><center>Conference</center></td>';
        echo '       <td><center>Book</center></td>';
    }

    echo '   </tr>';


    echo '  </thead>';
    echo '    <tbody>';
    echo '   <tr>';
    foreach ($publication_order_count as $person) {

        echo '<tr>';
        echo '<td>' . $person['name'] . '</td>';
        echo '<td>' . $person['dept'] . '</td>';

        foreach ($person['years'] as $year) {

            foreach ($year['disses'] as $diss) {

                foreach ($diss['types'] as $type) {
                    echo '<center>';

                    echo '<td>' . $type['count'] . '</td>';
                    echo '</center>';

                }
            }
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
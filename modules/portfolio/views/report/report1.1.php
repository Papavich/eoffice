<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'รายงาน จำนวนบุคลากร';
?>


<!-- panel content -->
<div class="panel-body">

    <?php
    $ctype = [];

    echo '<table class="table table-striped table-hover table-bordered" id="sample_editable_1">';
    echo '<thead>';

    echo '<tr>';
    echo '<td ><center>รายชื่อ</center></t>';
    echo '<th rowspan="3" ><center>สาขา</center></th>';

//
//    for ($year = $current_year; $year >= $current_year - 4; $year--) {
//        echo '<th colspan="6" ><center>';
//        echo $year;
//        echo '</center></th>';
//
//    }
//
//    // echo '<th rowspan="1" ><center>รวม</center></th>';
//
//    echo '</tr>';
//    echo ' <tr>';
//
//    for ($year = $current_year; $year >= $current_year - 4; $year--) {
//        echo ' <th  ><center>National</center></th>';
//        echo ' <th  ><center>International</center></th>';
//    }
//    echo '  </tr>';
//    echo '  <tr>';
//    for ($year = $current_year; $year >= $current_year - 4; $year--) {
//        echo ' <td ><center>Jour</center></td>';
//        echo ' <td ><center>Conf</center></td>';
//        echo ' <td  ><center>Jour</center></td>';
//        echo ' <td ><center>Conf</center></td>';
//        // echo '     <td  rowspan="1"><center>Poster</center></td>';
//
//
    echo '        </tr>';
//}

    echo '        </thead>';

    echo '<tbody>';
    //    for ($year = $current_year; $year >= $current_year - 0; $year--) {
    //        foreach ($persons as $person) {
    //            echo '<tr>';
    //            echo '<td>name</td>';
    //            echo '<td>department</td>';
    //            foreach ($disseminations as $dissemination) {
    //                foreach ($public_types as $public_type) {
    //
    //                    $count = '';

        foreach ($publication_order_count as $person) {

            echo '<tr>';
            echo '<td>' . $person['name'] . '</td>';
            echo '<td>' . $person['dept'] . '</td>';

            foreach ($person['years'] as $year) {

                foreach ($year['disses'] as $diss) {

                    foreach ($diss['types'] as $type) {

                        echo '<td>' . $type['count'] . '</td>';


                    }
                }
            }
            echo '</tr>';
        }

    //
    //
    //                    echo '<td>' . $count . '</td>';
    //                }
    //            }
    //            echo '</tr>';
    //     }   }
    //    }
    echo '</tr>';


    echo ' </tbody> ';


    echo '  </table>';


    ?>

</div>
<!-- /panel content -->


</div>
</section>
<!-- /MIDDLE -->
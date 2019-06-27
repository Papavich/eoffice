<?php

use yii\grid\GridView;

?>
<div class="person-index">

    <?php
        echo '<table><tr><th colspan="7"><h3>รายงานบุคลากร ทั้งหมดจำนวน '.$count.' คน</h3></th></tr></table>';
    ?>

    <?= GridView::widget([
        'dataProvider' => $model,
        'layout' => '{items}',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'person_id',
            [
               'attribute' => 'person_id',
               'value' => 'person_id',
            ],
            //'prefix_id',
            //prefix.prefix_name',
            [
               'attribute' => 'prefix',
               'value' => 'prefix.prefix_name',
            ],
            'person_firstname',
            'person_lastname',
            //'position.position_name',
            [
               'attribute' => 'position',
               'value' => 'position.position_name', 
            ],
            //'department.department_name',
            [
               'attribute' => 'department',
               'value' => 'department.department_name',
            ],  
        ], //end col
    ]); ?>


</div>


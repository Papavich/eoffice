<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/25/2017
 * Time: 4:06 AM
 */
?>

<?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label' => 'คำนำหน้า',
            'value' => function($model){
                return $model[0][0];
            }
        ],
        [
            'label' => 'ชื่อ นามสกุล',
            'value' => function($model){
                return $model[0][1];
            }
        ],
        [
            'label' => 'หมายเลขบัตรประชาชน',
            'value' => function($model){
                return $model[0][2];
            }
        ],
        [
            'label' => 'เพศ',
            'value' => function($model){
                return $model[0][3];
            }
        ],
        [
            'label' => 'อายุ',
            'value' => function($model){
                return $model[0][4];
            }
        ],
        [
            'label' => 'หน่วยอายุ(ปีเดือนวัน)',
            'value' => function($model){
                return $model[0][5];
            }
        ],
        [
            'label' => 'HN',
            'value' => function($model){
                return $model[0][6];
            }
        ],
        [
            'label' => 'AN',
            'value' => function($model){
                return $model[0][7];
            }
        ],
        [
            'label' => 'Doctor',
            'value' => function($model){
                return $model[0][8];
            }
        ],
        [
            'label' => 'Clinical Diagnosis',
            'value' => function($model){
                return $model[0][9];
            }
        ],
    ]
])?>
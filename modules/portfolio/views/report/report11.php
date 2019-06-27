<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'รายงาน จำนวนบุคลากร';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">

            <div class="box-body">
                <?php
                
                // print_r($department);
                 //print_r($count);

                $data1 = array();
                $data = array();
                foreach ($publication_order_count  as $value) {
                    $data[] = $value['count'];

                }
                $data = array_map('intval', $data);
                //                 $data1 = array();
                foreach ($publication_order_count  as $value) {
                    $data1[] = $value['year'];
                }
                $data1 = array_map('intval', $data1);
                

                
                
                
                echo Highcharts::widget([
                    'scripts' => [
                       'highcharts-3d',  
                    ],
                    'options' => [
                        'chart' => [
                            'type' => 'column',
                            'borderWidth' => 1,
                            'borderRadius' => 5,
                            'options3d' => [
                                'enabled' => true,
                                'alpha' => 10,
                                'beta' => 30,
                            ]
                            //'inverted' => true,
                        ],
                        'title' => ['text' => 'รายงานจำนวนโครงการวิจัย'],
                        'subtitle' => ['text' => 'รายงานจำนวนโครงการวิจัย'],
                        'credits' => ['enabled' => true],
                        'legend' => [
                            'align' => 'right',
                            'verticalAlign' => 'middle',
                            'layout' => 'vertical',
                            'borderWidth' => 2,
                            'borderRadius' => 3,
                        ],
                        'xAxis' => [
                            'title' => ['text' => 'แต่ล่ะปี'],
                            'categories' => $data1,
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวนผลงาน']
                        ],
                        'series' => [
                            [
                                'name' => 'จำนวนผลงาน',
                                'data' => $data,
                                'dataLabels' => [
                                    'enabled' => true,
                                    'x' => -5,
                                    'y' => 30,
                                ]
                            ],
                            
                        ],
                        
                    ]
                ]);
                ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
               
            </div><!-- box-footer -->
        </div><!-- /.box -->
    </div>
</div>




<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'รายงาน จำนวนบุคลากร';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">รายงาน จำนวนบุคลากรแยกตามแผนก</h3>
    
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php
                
                 //print_r($department);
                 //print_r($count);
                
                $cat = array();
                foreach ($department as $value) {
                    $cat[] = $value['department_name'];
                }
                
                $data = array();
                foreach ($count as $value) {
                    $data[] = intval($value['countperson']);
                }
                
                /*$data = array();
                foreach ($count as $value) {
                    $data[] = $value['countperson'];
                }
                $data = array_map('intval', $data);*/
                
                
                
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
                            'title' => ['text' => 'แผนก'],
                            'categories' => $cat,
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวนพนักงาน']
                        ],
                        'series' => [
                            [
                                'name' => 'จำนวนพนักงาน', 
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




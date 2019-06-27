<?php

use miloschuman\highcharts\Highcharts;

$this->title = 'รายงาน จำนวนบุคลากรแยกตามแผนก';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">

            <div class="box-body">
                <?php
                
                 //print_r($department);
                 //print_r($count);
                $d= [];
                $c = [];


                    // foreach($yearx['year'] as $count) {

                         //$d ['count'] = $count ;

               // }




//                }
//                print_r($publication_order_count);
//              exit();

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
                    'options' => [
                        /*'chart' => [
                            'type' => 'column',
                            //'inverted' => true,
                        ],*/
                        'title' => ['text' => 'รายงานจำนวนบผลงานตีพิมพ์'],
                        'subtitle' => ['text' => 'รายงานจำนวนบผลงานตีพิมพ์ตั้งแต่ ปี 2018-2017'],
                        'credits' => ['enabled' => false],
                        'legend' => [
                            'align' => 'right',
                            'verticalAlign' => 'middle',
                            'layout' => 'vertical',
                            'borderWidth' => 2,
                            'borderRadius' => 3,
                        ],
                        'xAxis' => [
                            'title' => ['text' => 'จำนวนผลงานในแต่ละปี'],
                            'categories' =>$data1 ,
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวนผลงานตีพิมพ์']
                        ],
                        'series' => [
                            [
                                'lineWidth' => 5,
                                'name' => 'จำนวนผลงานตีพิมพ์',
                                'data' => $data ,
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
                The footer of the box
            </div><!-- box-footer -->
        </div><!-- /.box -->
    </div>
</div>





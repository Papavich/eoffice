<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

$this->title = 'รายงาน จำนวนบุคลากร';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">รายงาน จำนวนบุคลากรแยกตามตำแหน่ง</h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                <?php       
                
                //echo print_r($data);
                
                $posData = array();
                foreach ($data as $value) {
                    extract($value);
                    $posData[] = array($value['member_name'], intval($value['count']));
                }
                
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-3d',
                    ],
                    'options' => [
                        'chart' => [
                            'type' => 'pie',
                            'borderWidth' => 1,
                            'borderRadius' => 5,
                            'options3d' => [
                                'enabled' => true,
                                'alpha' => 55,
                                'beta' => 0,   
                            ]
                        ],
                        'plotOptions' => [
                            'pie' => [
                                'depth' => 50,  // 3d
                                'showInLegend' => true,
                                'dataLabels' => [
                                    'distance' => -50,
                                    'style' => [
                                        'fontWeight' => 'bold',
                                        'width' => '140px',
                                    ],
                                    'formatter' => new JsExpression('function() { return this.point.name +" "+ Highcharts.numberFormat(this.y,0) + " คน"  }'),
                                ]
                            ]
                        ],
                        'title' => ['text' => 'รายงานจำนวนบุคลากร'],
                        'subtitle' => ['text' => 'รายงานจำนวนบุคลากรแยกตำแหน่ง'],
                        'credits' => ['enabled' => true],
                        'legend' => [
                            'align' => 'right',
                            'verticalAlign' => 'middle',
                            'layout' => 'vertical',
                            'borderWidth' => 2,
                            'borderRadius' => 3,
                        ],                      
                        'series' => [
                            [
                                'name' => 'จำนวนพนักงาน', 
                                'data' => $posData,
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





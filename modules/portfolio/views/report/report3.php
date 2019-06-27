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
                <?=Highcharts::widget([
                        'options'=> [
                                'title' =>[
                                        'text'=> 'สรุปรายงาน'
                                ],
                                'xAxis'=>[
                                        'categories' => [ 'จำนวน']
                                ],
                                 'yAxis'=>[
                                    'title' => ['text' => 'ครั้ง']
                                  ],
                            'series'=> $graph,

                        ]
                ])
                
                ?>
            </div><!-- /.box-body -->
            <div class="box-footer">
                
            </div><!-- box-footer -->
        </div><!-- /.box -->
    </div>
</div>





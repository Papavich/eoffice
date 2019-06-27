<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
use yii\widgets\Pjax;
use xj\bootbox\BootboxAsset;

BootboxAsset::register($this);
//register with replace Yii.confirm
BootboxAsset::registerWithOverride($this);


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $row backend\models\Project_Member*/


$this->title = 'ผลงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-body">
                    <?php
                    foreach ($positions as $row){
                        echo $row['pro_member_id'] . '<br>';
                        echo $row['member_name'] . '<br>';
                        echo $row['project_name_thai'];



                    }

                    ?>



                                </div>
                            </div>

                        </div>
                    </div>



                </div>




            </div>
            </div>

        </div>
    </div>




</div>

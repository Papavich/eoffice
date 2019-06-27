<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 1/2/2561
 * Time: 18:17
 */
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_ta\controllers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_ta\models\TaScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php
    $month = $obj->getMonth($obj->getMonthNow());
    $this->title = 'Calendar';
?>
<?php
$SUN = controllers::t( 'label', 'Sunday');
$MON = controllers::t( 'label', 'Monday');
$TUE = controllers::t( 'label', 'Tuesday');
$WED = controllers::t( 'label', 'Wednesday');
$THU = controllers::t( 'label', 'Thursday');
$FRI = controllers::t( 'label', 'Friday');
$SAT = controllers::t( 'label', 'Saturday');
?>
<style>
    .calendar-group {
        display: block;border: 0px solid #EEE;
    }
    .calendar-group2 {
        display: block;border: 1px solid #EEE; width:100%;
    }
    .calendar-list {float: left;display: inline-block;border: 1px solid #EEE;
        width: <?php echo (100/7);?>%;height: 80px;
    }
    .calendar-th {float: left;display: inline-block;border: 1px solid #EEE;
        width: <?php echo (100/7);?>%;height: 40px; text-align:center;
    }
    .calendar-title { padding: 1px;border-bottom: 0px solid #EEE;
        background-color:#F6F6F6; text-align:right;
    }
    .calendar-message { padding: 5px;}
    .calendar-message-list{ padding: 3px;8px;color: #FFF;
    font-size: 0.9em;background-color: #FFC414;
    }
    .table-style .today {background: #2A3F54; color: #ffffff;}
    .table-style th:nth-of-type(7),td:nth-of-type(7) {color: blue;}
    .table-style th:nth-of-type(1),td:nth-of-type(1) {color: red;}
    .table-style tr:first-child th{background-color:#F6F6F6; text-align:center; font-size: 15px;}
</style>

<div class="panel-body">
        <a class="btn btn-success" href="#" style="scroll-snap-margin-top: -35px;">ประจำปี</a>
        <br>

        <div class="col-md-12" style="padding:0px;">
            <center>
                <table class="table table-bordered table-style table-responsive">
                    <tr>
                    <th colspan="2">
                        <a href="?ym=<?php //echo $prev; ?>">
                            <span class="glyphicon glyphicon-chevron-left"></span></a>
                    </th>
                        <th colspan="3">
                        ปฏิทินเดือน <?php echo $month['th'];?>
                        <?php echo $obj->getYearNow(); ?>
                        </th><th colspan="2">
                        <a href="?ym=<?php //echo $next; ?>">
                            <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </th>
                    </tr>
                </table>
            </center>
        </div>

    <div class="col-md-12" style="padding:0px;">
            <table class="table table-bordered table-style table-responsive">
            <?php if(!empty($calendar)){ ?>
                <tr class="calendar-group">
                    <th class="calendar-th"><?=$SUN?></th>
                    <th class="calendar-th"><?=$MON?></th>
                    <th class="calendar-th"><?=$TUE?></th>
                    <th class="calendar-th"><?=$WED?></th>
                    <th class="calendar-th"><?=$THU?></th>
                    <th class="calendar-th"><?=$FRI?></th>
                    <th class="calendar-th"><?=$SAT?></th>
                </tr>
                <tr class="calendar-group">
                    <?php foreach ($calendar as $record){ ?>
            <td class="calendar-list">
                <div class="calendar-title">
                    <?php
                       if(is_object($record)){
                           $select = $record; echo (!empty($record->day)) ? $record->day : "";
                       }else {
                           echo (!empty($record)) ? $record:"";
                       }
                    ?>
                <?php if(!empty($select)) {?>
                    <p class="calendar-message-list">
                        <?php echo (!empty($select->message)) ? $select->massage :"";?>
                    </p>
                <?php }?>
                </div>
            </td>
                        <?php unset($select);?>
                    <?php  }?>
           </tr>

            <?php  }?>
            </table>
    </div>
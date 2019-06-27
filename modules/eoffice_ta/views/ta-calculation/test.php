<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 15/1/2561
 * Time: 14:15
 */
use app\modules\eoffice_ta\models\TaCalculation;
use app\modules\eoffice_ta\models\TaRuleApproach;
use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\models\TaWorkloadTeacher;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>



 <!--   <div id="content" class="padding-20">

        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-3">

                <div class="well well-sm" id="event-container">
                    <h4>Draggable Events</h4>

                    <ul id="external-events" class="list-unstyled">
                        <li>
                            <span class="bg-calendar bg-primary text-white" data-description="lite desc">Default</span>
                        </li>
                        <li>
                            <span class="bg-calendar bg-info text-white" data-description="info desc">Info</span>
                        </li>
                        <li>
                            <span class="bg-calendar bg-warning text-white" data-description="warning desc">Warning</span>
                        </li>
                        <li>
                            <span class="bg-calendar bg-danger text-white" data-description="danger desc">Danger</span>
                        </li>
                    </ul>

                    <div class="sky-form">
                        <label class="checkbox">
                            <input type="checkbox" name="checkbox" id="drop-remove" checked=""><i></i> remove after drop
                        </label>
                    </div>

                </div>

                <div class="alert alert-default">
                    NOTE: Click a calendar day to create an event!
                </div>

            </div>

            <div class="col-sm-12 col-md-12 col-lg-9">

                <!-- Panel -->
    <!--   <div id="panel-calendar" class="panel panel-default">

           <div class="panel-heading">

                       <span class="title elipsis">
                           <strong>Test Calculate</strong>  -->
    <!-- panel title -->
    <!--	</span>  -->


    <!--   <div class="panel-options pull-right">   -->
    <!-- panel options -->
    <!--         <ul class="options list-unstyled">
                <li>
                    <a href="#" class="opt dropdown-toggle" data-toggle="dropdown"><span class="label label-disabled"><span id="agenda_btn">Month</span> <span class="caret"></span></span></a>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a data-widget="calendar-view" href="#month"><i class="fa fa-calendar-o color-green"></i> <span>Month</span></a></li>
                        <li><a data-widget="calendar-view" href="#agendaWeek"><i class="fa fa-calendar-o color-red"></i> <span>Agenda</span></a></li>
                        <li><a data-widget="calendar-view" href="#agendaDay"><i class="fa fa-calendar-o color-yellow"></i> <span>Today</span></a></li>
                        <li><a data-widget="calendar-view" href="#basicWeek"><i class="fa fa-calendar-o color-gray"></i> <span>Week</span></a></li>
                    </ul>
                </li>
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
            </ul>
        </div>  -->
                        <!-- /panel options -->

                        <!--     </div>  -->

                    <!-- panel content -->
                    <div class="panel-body">

                        <?php $form = ActiveForm::begin([//\yii\helpers\Url::current(),
                            'class' => 'form-horizontal',
                            'action' => ['test'],
                            'method' => 'get', //['csrf' => false]
                        ]); ?>
                        <?php // $form->field($model, 'symbol_value') ?>
                        <?=Html::input('number', 'symbol_value'/*, $t*/)?>
                        <div class="form-group">
                            <?= Html::submitButton('Precess', ['class' => 'btn btn-primary']) ?>
                            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>

                        <div id="calendar" data-modal-create="true"><!-- CALENDAR CONTAINER --></div>

                  <?php     //
                  //  $Calculate = TaCalculation::find()->where(['ta_rule_id' => $RuleApproach->ta_rule_approach_id])->all();

                 /*  foreach ($Calculate as $calculate){
                      $cal_id =  $calculate->ta_calculate_id;
                      $cal_symbol = $calculate->symbol;
                      $status_symbol = $calculate->status_symbol;


                       if($status_symbol == TaCalculation::SYMBOL_MAIN_OR_ANSWER){
                           $M_symbol = $cal_symbol.' = ';
                           echo $M_symbol;
                       }else{
                           $N_symbol = $cal_symbol;
                           echo $N_symbol;
                       }
*/
                     //  echo $M_symbol.$N_symbol;
              //   }
            //     $model = $calculate;
                //     $model = $cal_symbol;
                    // $model = 20;
                    // $t=30;
                     ?>
                        <br>
                        <?php /*
                        $L = TaCalculation::findOne(['symbol'=>'L','status_symbol'=>TaCalculation::SYMBOL_VARIABLE,
                            'ta_rule_id'=>$RuleApproach->ta_rule_approach_id]);
 */
                        ?>
                        <?php  //$L->symbol?><br>
                        <?php  // $L->symbol_value?><br>
                        <?php   //การแสดงค่าที่ได้จาก text inputออกมา คำรสณหรือแสดงได้
                       /* $number_std = \Yii::$app->request->get('symbol_value');
                        echo $number_std/$L->symbol_value;
                       */
                        ?>
                        <?php  //echo $this->render('_form_amount_ta', ['model'=> ]); ?>


                            <?php
                            //$num= 0;
                          /*  $num   = (int)$_POST["num"];
                            $total = 0;

                            for ($i=0; $i <= $num; $i++) {
                                $total = $total + $i;
                            }
                            echo $total;  */
                            ?>

                        <br><br>

                    </div>
                    <!-- /panel content -->
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin([
                                'action' => ['test'],
                            'method' => 'get']); ?>

                        <div class="table-responsive">
                            <table class="table  table-vertical-middle nomargin">
                                <thead>
                                <tr>
                                    <th class="width-30"></th>
                                    <th>section</th>
                                    <th>time</th>
                                </tr>
                                </thead>
                                <?php
                                // $wload_id = 'W-S'.$sec.'-'.$s.'-'.$t;
                                $secs = TaWorkloadTeacher::find()->where(['subject_id'=>'322437','term'=>'2/2560','year'=>'2560'])->all();
                                foreach ($secs as $sec){
                                    $sec1 = $sec->section;
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <?=Html::input('checkbox', 'section[]', $sec1,array('multiple'=>"multiple"))?>
                                            <?php /* $form->field($model, 'section')->checkbox(['value'=>$sec1])
                                                ->label(false,['layout'=>'inline']) */?>
                                        </td>
                                        <td><?=$sec->section?></td>
                                        <td><?=$sec->time_start.'-'.$sec->time_end?></td>
                                    </tr>
                                    </tbody>
                                <?php } ?>
                            </table>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <p>
                            <?php   //การแสดงค่าที่ได้จาก text inputออกมา คำรสณหรือแสดงได้
                            //$count=  \app\modules\pms\models\Model::loadMultiple($secs, Yii::$app->request->get());
                            $count = (int)count(\Yii::$app->request->get('section'));
                        //    $count3 = array(\Yii::$app->request->get('section[]'));
                            $secccs[] = \Yii::$app->request->get('section[]');
                            echo  'จำนวน'.$count.'<br>';
                            //echo  'จำนวน555='.$count3.'<br>';
                           // $sec_tests = implode($_GET['section']);

                            //echo 'secที่เลือกvvvvvvv='.$sec_tests.'<br>';
                            //$num[] =  Yii::$app->getRequest()->getQueryParam('section[]');
                            //echo  'จำนวนoo='.$num.'<br>';

                           /* foreach ($sec_tests as $item){
                                echo 'secที่เลือก=='.$item.'<br>';
                            }*/
                            $sec_tests[] = implode(',',$_GET['section']);
                            foreach ($sec_tests as $item){
                            $rs = explode(',',$item);
                             foreach ($rs as $item2){
                                echo 'secที่เลือก=='.$item2.'<br>';
                            }}
                          /* for ($i=0;$i<$count;$i++){
                          // foreach ($sec_tests as  $num2){
                               // echo 'secที่เลือก'.$num2;

                         //  }
                               echo substr($sec_tests,0.5,2.5);
                              // echo substr($sec_tests[$i],0.5,1.5);
                           }*/

                            ?></p>
                </div>
                <!-- /Panel -->

            </div>

        </div>

    </div>
<?php    /*$this->registerJsFile(Yii::getAlias('@web/assets/plugins/jquery/jquery.cookie.js')
,['depends' => [\yii\web\JqueryAsset::className()]]);
    */
?>

<?php /*$this->registerJsFile(Yii::getAlias('@web/assets/plugins/jquery/jquery.ui.touch-punch.min.js')
    ,['depends' => [\yii\web\JqueryAsset::className()]]);
 */
?>
<?php /* $this->registerJsFile(Yii::getAlias('@web/assets/plugins/moment.js')
    ,['depends' => [\yii\web\JqueryAsset::className()]]);
 */
?>
<?php /* $this->registerJsFile(Yii::getAlias('@web/assets/plugins/bootstrap.dialog/dist/js/bootstrap-dialog.min.js')
    ,['depends' => [\yii\web\JqueryAsset::className()]]);
 */
?>
<?php /*
$this->registerJsFile(Yii::getAlias('@web/assets/plugins/fullcalendar/fullcalendar.js')
    ,['depends' => [\yii\web\JqueryAsset::className()]]);
 */
?>
<?php /*
$this->registerJsFile(Yii::getAlias('@web/assets/plugins/fullcalendar/gcal.js')
    ,['depends' => [\yii\web\JqueryAsset::className()]]); */
?>
<?php /*$this->registerJsFile(Yii::getAlias('@web/assets/js/view/demo.calendar.js')
    ,['depends' => [\yii\web\JqueryAsset::className()]]);*/
?>
<?php   /*
$this->registerJs("
var date 	= new Date();
			var d 		= date.getDate();
			var m 		= date.getMonth();
			var y 		= date.getFullYear();

			var _calendarEvents = [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1),
					allDay: false,
					className: [\"bg-primary\"],
					description: 'some description...',
					icon: 'fa-clock-o'
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2),
					allDay: false,
					className: [\"bg-primary\"],
					description: '',
					icon: 'fa-check'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false,
					className: [\"bg-warning\"],
					description: '',
					icon: 'fa-clock-o'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false,
					className: [\"bg-primary\"],
					description: '',
					icon: 'fa-clock-o'
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false,
					className: [\"bg-primary\"],
					description: '',
					icon: 'fa-lock'
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					className: [\"bg-success\"],
					description: '',
					icon: 'fa-clock-o'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
					className: [\"bg-danger\"],
					description: '',
					icon: ''
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/',
					className: [\"bg-info\"],
					description: '',
					icon: 'fa-clock-o'
				}
			];
");     */
?>




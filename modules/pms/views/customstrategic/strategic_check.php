<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 22/1/2561
 * Time: 21:27
 */
use yii\widgets\ActiveForm;
use app\modules\pms\models\StrategicIssues;
$this->registerJsFile('@web/web_pms/js/strategicCustom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<header id="page-header">
    <h1>กลยุทธ์ประจำปีงบประมาณ</h1>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div class="page-profile">

        <div class="row ">
            <div class="col-md-12 col-lg-12">
                <?php $form = ActiveForm::begin(['action'=> '../customstrategic/savecheck']); ?>
                <fieldset>
                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <select name="year" id="strategic_year" class="form-control pointer">
                                <option value="" selected disabled>--------- เลือกปีงบประมาณ ---------</option>
                                <?php
                                $date = date("Y")+548;
                                for($i = 2560;$i<$date;$i++){ ?>
                                    <option value='<?= $i; ?>'><?= $i; ?></option>
                                <?php } ?>

                            </select>
                            <br>
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <a class="btn btn-sm btn-blue btn-3d" href="../customstrategic/strategic-show"><i class="glyphicon glyphicon-arrow-left"></i>ย้อนกลับ</a>
                        </div>
                        <div id="show">
                            <?php
                            foreach ($dis as $key => $rows2) {
                                $data = StrategicIssues::find()->where(['strategic_issues_id'=>$rows2->strategic_issues_strategic_issues_id])->one();

                                echo " <div class=\"col-md-12 col-sm-12\">ประเด็นยุทธศาสตร์ที่ ".$data->strategic_issues_id." ".$data->strategic_issues_name."<br></div>";
                                foreach ($strategic as $key => $rows){

                                    if($rows2->strategic_issues_strategic_issues_id==$rows->strategic_issues_strategic_issues_id) {
                                        ?>

                                        <div class="col-md-6 col-sm-6">
                                            <label class="checkbox">
                                                <input type="checkbox" name="strategiccheck[]" value="<?= $rows->strategic_issues_strategic_issues_id.$rows->strategic_id; ?>">
                                                <i></i> <?= $rows->strategic_name; ?>
                                            </label>
                                        </div>

                                        <?php
                                    }
                                }
                                echo "<div class=\"col-md-12 col-sm-12\"><br></div>";
                            }
                            ?>
                        </div>
                    </div>


                    <input type="hidden" id="yearNow" value="<?=$yearNow?>">

                    <div class="row" align="center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success hidden"  id="yearCheck">บันทึก</button>
                        </div>
                    </div>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<JS
$(document).ready(function() {
    $('#strategic_year').change(function(){
        var year = $('#strategic_year').val();
        var yearNow = $('#yearNow').val();
        if(year <= yearNow){
            $('#yearCheck').hide();
        }else{
            $('#yearCheck').removeClass("hidden");
            $('#yearCheck').show();
           
        }
    });
    
});

JS
);
?>
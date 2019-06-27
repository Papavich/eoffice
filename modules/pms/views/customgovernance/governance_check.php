<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/1/2561
 * Time: 23:37
 */
use yii\widgets\ActiveForm;
$this->registerJsFile('@web/web_pms/js/governanceCustom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<header id="page-header">
    <h1>เพิ่มและปรับแก้ไขแบบเสนอโครงการ (แผน 103-1/5)</h1>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div class="page-profile">

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <?php $form = ActiveForm::begin(['action'=> '../customgovernance/savecheck']); ?>
                <fieldset>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h5>เลือกหลักธรรมาภิบาลที่จะแสดงในแบบเสนอโครงการ (แผน 103-1/5)</h5>
                            <br>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <select name="year" id="governance_year" class="form-control pointer">
                                <option value="" selected disabled>--------- เลือกปีงบประมาณ ---------</option>
                            <?php
                            $date = date("Y")+548;
                            for($i = 2560;$i<$date;$i++){ ?>
                                <option value='<?= $i; ?>'><?= $i; ?></option>
                            <?php } ?>

                            </select>
                            <br>
                        </div>
                        <div id="show">
                        <?php
                        foreach ($governance as $key => $governance){ ?>
                                <div class="col-md-6 col-sm-6">
                                    <label class="checkbox">
                                        <input type="checkbox" name="governancecheck[]" value="<?= $governance->governance_id; ?>">
                                        <i></i> <?= $governance->governance_name; ?>
                                    </label>
                                </div>
                        <?php } ?>
                        </div>
                    </div>

                    <input type="hidden" id="yearNow" value="<?=$yearNow?>">


                    <div class="row" align="center">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success hidden" id="yearCheck">บันทึก</button>
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
    $('#governance_year').change(function(){
        var year = $('#governance_year').val();
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

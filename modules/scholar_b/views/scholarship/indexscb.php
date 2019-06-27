<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 20/2/2561
 * Time: 17:23
 */
?>

<div class="padding-15">
    <div class="panel-body">
        <div class="container">
            <div class="row">
                <div class="hero-unit center">
                    <h1>กรุณาเลือกทุนที่จะสมัคร</h1>
                    <div class="col-md-2 col-sm-2"></div>
                    <div class="col-md-8 col-sm-8">
                        <select class="form-control" onchange="location = this.value;">
                            <?php $Scbtype = \app\modules\scholar_b\models\ScbScholarshipTypeHasYear::find()->all(); ?>
                            <option value="#">กรุณาเลือกประเภททุน</option>
                            <?php
                            foreach ($Scbtype as $item) {
                                echo "<option value='../scholarship/detail-scb1?id=".$item->scholarship_year
                                    ."".$item->scholarship_id."'>" . $item->scname->scholarship_name
                                    ." ปีการศึกษา ".$item->scholarship_year." </option>";
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCss("  .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
");
?>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php
$this->registerJs(<<<JS
    $(document).ready(function() {
    
});
JS
); ?>
<style>
    .classboarder {
        height: auto;
        background: #e6e6e6;
    }

    .classboarder2 {
        height: auto;
        width: auto;
        background: #e6e6e6;
    }

    .classdivsubject {
        width: 150px;
        height: auto;
        text-align: right;
    }

    .classdivsubject2 {
        width: 150px;
        height: auto;
        text-align: left;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 25%;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
    }

</style>


<div id="content" class="padding-20">
    <div align="left">
        <!-- page title -->
        <header id="page-header">
            <strong>เพิ่มเงื่อนไขรายวิชา <span id="showsubjectcondition"></span></strong>
        </header>
        <!-- /page title -->
    </div>


    <div id="tagcondition" class="panel-body" style="display:none;">
        <table width="100%">
            <tr>
                <td width="10%">
                    <div class="classboarder">
                        <div class="classdivsubject"><br>
                            <span>รหัสรายวิชา : </span><br><br>
                            <span>เวอร์ชั่นรายวิชา : </span></span><br><br>
                            <span>หน่วยกิตรายวิชา : </span></span><br><br>
                            <span>ปีการศึกษา : </span><br><br>
                            <span>ภาคการศึกษา : </span><br><br>
                        </div>
                    </div>
                </td>
                <td width="90%">
                    <div class="classboarder2">
                        <div class="classdivsubject2"><br>
                            <span id="subject_id"></span><br><br>
                            <span id="subject_version"></span><br><br>
                            <span id="subject_credit"></span><br><br>
                            <span id="plan_year"></span><br><br>
                            <span id="plan_semerter"></span><br><br>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <br>
        <?php $form = ActiveForm::begin(['action' => ['pastvalue']]) ?>

        จำนวน Section : <select id="section_no" name="section_no" class="form-control pointer required valid inline-block"  style="width: 17% !important;">
            <option disabled="disabled" selected="selected">เลือกจำนวน Section</option>
            <option value="1">1 Section</option>
            <option value="2">2 Section</option>
            <option value="3">3 Section</option>
            <option value="4">4 Section</option>
            <option value="5">5 Section</option>
            <option value="6">6 Section</option>
            <option value="7">7 Section</option>
            <option value="8">8 Section</option>
            <option value="9">9 Section</option>
            <option value="10">10 Section</option>
        </select>

        <?=
        Html::a('ตกลง', ['pastvalue',
        ],
            [
                'class' => 'btn btn-success btn-3d',
                'style' => 'display: inline;',
                'data' => [
                    'confirm' => 'ยืนยันการเพิ่ม section ? ',
                    'method' => 'post',
                ],

            ]) ;
        ?>

        <?php $form = ActiveForm::end(); ?>

        </div>
    </div>
</div>



<script type="text/javascript">
    function clickcheckedsection(checkid,i) {
        var idtag = "conditionsection" + i;
        if ($("#" + checkid).is(":checked")) {
            $("#"+idtag).show();
        } else {
            $("#"+idtag).hide();
        }
    }

    function clickcheckedroom(checkid2,i2) {
        var idtag = "roomcondition" + i2;
        if ($("#" + checkid2).is(":checked")) {
            $("#"+idtag).show();
        } else {
            $("#"+idtag).hide();
        }
    }

</script>


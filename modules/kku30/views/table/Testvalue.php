<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<!--CHECKBOX SHOW TABLE-->
<label class="radio" style="color: #F44336"><input name="model_schedule" type="radio" value="1"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        1</b></label>
<label class="radio" style="color: blue"><input name="model_schedule" type="radio" value="2"
                                                onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        2</b></label>
<label class="radio" style="color: #009688"><input name="model_schedule" type="radio" value="3"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        3</b></label>
<label class="radio" style="color: #FFA000"><input name="model_schedule" type="radio" value="4"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        4</b></label>
<label class="radio" style="color: #E040FB"><input name="model_schedule" type="radio" value="5"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        5</b></label>
<label class="radio" style="color: #000066"><input name="model_schedule" type="radio" value="6"
                                                   onclick="setvaluetagmodel(this.value)"><i></i><b>แบบที่
        6</b></label>
<!-- CHECKBOX SHOW TABLE -->

<!-- PRINT BUTTON -->
<div align="right" id="hide-print">

    <a onclick="printWindow()" class="btn btn-blue btn-sm"><i class="fa et-printer"></i>Print &nbsp;&nbsp;|&nbsp;&nbsp;
        <i class="fa et-download"></i>Download</a>
</div>
<!-- PRINT BUTTON -->

<!-- CREATE TABLE BTN -->
<div align="center" id="hide-print">
    <input type="hidden" id="Room" name="Room" value="">
    <button type="button" class="btn btn-3d btn-green" onclick="insertTimeslot()">บันทึกตารางเรียน</button>
</div>
<!-- CREATE TABLE BTN -->
<script>

</script>
<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 8/3/2561
 * Time: 0:45
 */?>



<div class="col-md-4 col-sm-4">
    <?= $form->field($comHasProsub, 'group_plan')->widget(DepDrop::classname(), [
        'options'=>['id'=>'ddl-budget'],
        'data'=> [],
        'pluginOptions'=>[
            'depends'=>['ddl-place'],
            'placeholder'=>'เพิ่มเอกสารใหม่',
            'url'=>Url::to(['pms/../compact/get-budget'])
        ]
    ])->label(false)
    ; ?>
</div>

<div class="col-md-4 col-sm-4">
    <label>เลือกรอบเอกสารขอใช้ประมาณ</label>
</div>

<?php

use yii\helpers\Html;

?>
<h3><?= Html::encode($this->title) ?></h3>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Design Section</strong>
                  </span>
        </div>
        <div class="panel-body">
            <?php
                $model = \app\modules\eoffice_form\models\ReqTemplate::find()
            ->where(['template_id' => $template_id])
            ->one();

            echo 'ท่านไม่สามารถยื่นคำร้องได้ ! <br>เนื่องจากท่านได้ยื่น '.$model['template_name'].' <br>ในวันที่ '.$cr_date.' แล้ว';

            ?>
         </div>
    </div>
</div>
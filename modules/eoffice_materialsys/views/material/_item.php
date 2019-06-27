<?php

use yii\helpers\Html;

?>

<div class="col-sm-6 col-md-2">
    <div class="thumbnail" style="height: 270px">
        <img src="<?= Yii::$app->homeUrl ?>web_mat/images/<?= $model->material_image ?>" style="height: 150px">
        <div class="caption">
            <h5><?= $model->material_name; ?></h5>
            <div class='action-material' style="position: absolute;bottom: 30px;">
                <div class='action-btn' style="text-align: center">
                    <a style="width: 30%" class='btn btn-sm btn-default margin-top-3'
                            href='<?= Yii::$app->homeUrl . Yii::$app->controller->module->id ?>/material/update?id=<?= $model->material_id ?>' data-toggle="tooltip" data-placement="bottom" title="แก้ไข"><span
                                    class="glyphicon glyphicon-pencil"></span></a>
                    <a style="width: 30%" class='btn btn-sm btn-default margin-top-3'
                            href='<?= Yii::$app->homeUrl . Yii::$app->controller->module->id ?>/material/view?id=<?= $model->material_id ?>' data-toggle="tooltip" data-placement="bottom" title="รายละเอียด"><span
                                    class="glyphicon glyphicon-eye-open"></span></a>
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->material_id], ['data'=>['method' => 'POST','confirm' => 'ยืนยันการลบวัสดุ',],'class' => 'btn btn-sm btn-danger margin-top-3']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
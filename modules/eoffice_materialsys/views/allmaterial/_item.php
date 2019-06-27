<?php

use yii\helpers\Html;
use app\modules\eoffice_materialsys\models\MatsysMaterial;

?>

<div class="col-sm-6 col-md-2">
    <div class="thumbnail" style="height: 270px">
        <img src="<?= Yii::$app->homeUrl ?>web_mat/images/<?= $model->material_image ?>" style="height: 150px">
        <div class="caption">
            <h5><?= $model->material_name; ?></h5>
            <div class='action-material' style="position: absolute;bottom: 30px;">
                <div class='action-btn' style="text-align: center">
                    <button name='addItem' data-id='<?= $model->material_id; ?>' class='btn btn-info btn-sm'>
                        เพิ่มรายการ
                    </button>
                </div>
                <div class='text-tbody' style="display: none">
                    <div><b>ชื่อวัสดุ </b>: <span name='material_name'><?= $model->material_name; ?></span></div>
                    <div><b>รหัสวัสดุ </b>: <span name='material_id'><?= $model->material_id; ?></span></div>
                    <div><b>รายละเอียด </b>: <span name='material_detail'><?= $model->material_detail; ?></span></div>
                    <div><b>จำนวนคงเหลือ </b>: <span name='material_all'><?= MatsysMaterial::amountAll($model->material_id); ?></span>
                        <span name='material_unit'><?= $model->material_unit_name; ?></span></div>
                    <span name='material_type'><?= $model->location->location_name; ?></span>
                    <img class="image" src="<?= Yii::$app->homeUrl ?>web_mat/images/<?= $model->material_image ?>" style="height: 150px">
                </div>
            </div>
        </div>
    </div>
</div>

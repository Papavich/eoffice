<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'ข้อมูลตำแหน่ง (ทั้งหมด ') . Html::encode($count) . ' รายการ)';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <div class="box">

            <div class="box-body">

                <table class="table table-bordered">
                    <tr>
                        <th>รหัส</th>
                        <th>ชื่อตำแหน่ง</th>
                        <th>ลบ</th>
                    </tr>
<?php foreach ($positions as $position): ?>
                        <tr>
                            <td><?= Html::encode($position['position_id']); ?></td>
                            <td><?= Html::encode($position['position_name']); ?></td>
                            <td><a href="<?= Url::to(['position/delete', 'id' => Html::encode($position['position_id'])]); ?>"><span class="fa fa-trash"></span></a></td>
                        </tr>
<?php endforeach; ?>
                </table>

            </div>
        </div>

    </div>
</div>







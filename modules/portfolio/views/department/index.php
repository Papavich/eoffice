<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'แผนก ทั้งหมด ' . Html::encode($count) . ' รายการ');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">

        <div class="box">

            <div class="box-body">

                <?php
                //  echo "SQL: ".$sql->sql;
                ?>
                <table class="table table-hover">
                    <tr>
                        <th>รหัส</th>
                        <th>แผนก</th>
                        <th>ลบ</th>
                    </tr>
<?php foreach ($departments as $department): ?>
                        <tr>
                            <td><?= Html::encode($department['department_id']); ?></td>
                            <td><?= Html::encode($department['department_name']); ?></td>
                            <td><a href="<?= Url::to(['department/delete', 'id' => Html::encode($department['department_id'])]); ?>"><span class="fa fa-trash"></span></a></td>
                        </tr>
<?php endforeach; ?>
                </table>

            </div>
        </div>



    </div>
</div>







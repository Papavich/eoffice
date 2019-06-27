<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;

?>
<?php
$Data_check = \app\modules\kku30\models\Kku30CheckTable::find()
    ->all();
?>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-vertical-middle nomargin">
            <thead>
            <tr bgcolor="#BBEBFF">
                <th class="text-center">ปีการศึกษา</th>
                <th class="text-center">เทอม</th>
                <th class="text-center">สถานะการจัดตาราง</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($Data_check as $row) {
                ?>
                <tr class="text-center">
                    <td><?=$row['check_table_year']?></td>
                    <td><?=$row['check_table_semester']?></td>
                    <td>ทำการดำเนินการเรียบร้อยแล้ว</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>





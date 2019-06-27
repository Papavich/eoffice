<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\fileupload\FileUploadUI;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\User;

$this->title = Html::encode($this->title) . '- แก้ไขหนังสือทำลาย';
?>
<section id="middle" style="margin: 2% 0 5% 15%;">
    <div class="wizard" style="padding: 2%">
        <header>
            <h4>
                <strong >
                        <span class="padding-10">แก้ไขรายการหนังสือทำลาย</span>
                </strong>
            </h4>
            <div class="row margin-bottom-40 margin-top-20">
                <div  class="col-sm-3">
                    <select class="form-control" id="sel1">
                        <option>รอการอนุมัติ</option>
                        <option>อนุมัติแล้วกำลังทำลาย</option>
                        <option>ทำลายต้นฉบับเสร็จสิ้น</option>
                    </select> 
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-warning">แก้ไขสถานะ</button>
                </div>
            </div>
        </header>

        <div class="container">
            <b>รายการหนังสือที่ต้องการแก้ไข</b>
            <table class="table table-striped table-hover table-bordered"
                   id="sample_editable_1" style="width: 90%">
                <thead>
                <tr>
                    <th class="col-sm-1">เลขที่หนังสือ</th>
                    <th class="col-sm-1">วันที่</th>
                    <th class="col-sm-2">เรื่อง</th>
                    <th class="col-sm-1">สถานที่</th>
                    <th class="col-sm-1">สถานะ</th>
                    <th class="col-sm-1"></th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < 7; $i++) { ?>
                    <tr>
                        <td align="center">
                            ศธ0514.1.2/<?= $i + 1; ?>
                        </td>
                        <td align="center">
                            31/05/60
                        </td>
                        <td align="center">
                            คณะแพทยศาสตร์ มหาวิทยาลัยขอนแก่น
                        </td>
                        <td align="center">
                            6302
                        </td>
                        <td align="center">
                            รออนุมัติ
                        </td>
                        <td align="center">
                            <a href="#" class="btn btn-3d btn-xs btn-reveal btn-red btnw confirmDeleteRoll">
                                <i class="fa fa-trash"></i>
                                <span>ลบ</span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <br><br>
            <b>รายการหนังสือที่ต้องการเพิ่มลงในรายการหนังสือ</b>
            <table class="table table-striped table-hover table-bordered"
                   id="sample_editable_1" style="width: 90%">
                <thead>
                <tr>
                    <th><input type="checkbox" id="choseall">เลือก</th>
                    <th>เลขที่</th>
                    <th>วันที่หนังสือ</th>
                    <th>วันครบทำลาย</th>
                    <th>เรื่อง</th>
                    <th >สถานที่</th>
                    <th>ผู้รับ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < 5; $i++) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="checkalllist">
                        </td>
                        <td align="center">
                            <?= $i + 1 ?>
                        </td>
                        <td align="center">
                            31/05/60
                        </td>
                        <td align="center">
                            29/09/60
                        </td>
                        <td align="center">
                            ทดสอบ <?= $i + 1 ?>
                        </td>
                         <td align="center">
                            6302
                        </td>
                        <td align="center">
                            นางสาวชนกนันท์ ถูไกรวงษ์
                        </td>

                        <td align="center">
                            <a href="#" class="btn btn-3d btn-xs btn-green btnw">
                                <span>เพิ่มรายการ</span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        <button type="button" class="btn btn-success">แก้ไขรายการ</button>
        </div>
        </div>
</section>
<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS
        $('#choseall').click(function () {    
            $(':checkbox.checkalllist').prop('checked', this.checked);    
        });
                                
JS
);
?>
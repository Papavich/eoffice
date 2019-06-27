<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 21/2/2561
 * Time: 23:03
 */
use yii\helpers\Html;
use app\modules\scholar_b\models\ScbCandidate;
use yii\widgets\ActiveForm;
$this->registerJsFile('@web/web_scb/js/score.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = Html::encode($this->title) . 'รายชื่อสมัครโครงการช้างเผือก';
?>
<!-- page title -->
<header id="page-header">
    <h1>ข้อมูลส่วนตัว</h1>
    <ol class="breadcrumb">
        <li><a href="../login/login-success">หน้าหลัก</a></li>
        <li class="active">ข้อมูลส่วนตัว</li>
    </ol>
</header>
<!-- /page title -->


<!-- Panel Tabs -->
<div class="scb-candidate-index">
    <div class="panel-body">
        <div id="panel-ui-tan-l1" class="panel panel-default">
            <div class="panel-heading">
                                    <span class="elipsis"><!-- panel title -->
                                        <strong>ข้อมูลนักเรียน</strong>
                                    </span>
                <!-- tabs nav -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><!-- TAB 1 -->
                        <a href="#ttab1_nobg" data-toggle="tab">ข้อมูลส่วนตัว</a>
                    </li>
                    <li class=""><!-- TAB 2 -->
                        <a href="#ttab2_nobg" data-toggle="tab">ข้อมูลบิดา-มารดา</a>
                    </li>
                    <li class=""><!-- TAB 3 -->
                        <a href="#ttab3_nobg" data-toggle="tab">ภูมิลำเนา</a>
                    </li>
                    <li class=""><!-- TAB 4 -->
                        <a href="#ttab4_nobg" data-toggle="tab">ประวัติการศึกษา</a>
                    </li>
                    <li class=""><!-- TAB 5 -->
                        <a href="#ttab5_nobg" data-toggle="tab">ผลการศึกษา</a>
                    </li>
                    <li class=""><!-- TAB 6 -->
                        <a href="#ttab6_nobg" data-toggle="tab">คะแนนสอบ</a>
                    </li>
                    <li class=""><!-- TAB 7 -->
                        <a href="#ttab7_nobg" data-toggle="tab">ผลงาน</a>
                    </li>
                </ul>
                <!-- /tabs nav -->
            </div>

            <!-- panel content -->
            <div class="panel-body">
                <!-- tabs content -->
                <div class="tab-content transparent">
                    <div id="ttab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->
                        <strong>ข้อมูลนักเรียน</strong>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>หมู่โลหิต</th>
                                    <th>วันเกิด</th>
                                    <th>เชื้อชาติ</th>
                                    <th>สัญชาติ</th>
                                    <th>ศาสนา</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td><?= $model_candidate->blood_type ?></td>
                                    <td><?= $model_candidate->birth_date ?></td>
                                    <td><?= $model_candidate->origin ?></td>
                                    <td><?= $model_candidate->nationality ?></td>
                                    <td><?= $model_candidate->religion ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /TAB 1 CONTENT -->

                    <div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                        <strong>ข้อมูลบิดา-มารดา</strong>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>สถานะ</th>
                                    <th>อาชีพ</th>
                                    <th>เบอร์โทรศัพท์ติดต่อ</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($model_candidate->scbParentsIdCardParents as $row) { ?>
                                    <?php echo "<tr><td>"
                                        . $row->parent_type . " " . $row->firstname . " " . $row->lastname
                                        . "</td><td>"
                                        . $row->status . "</td><td>"
                                        . $row->occupation . "</td><td>"
                                        . $row->mobile . "</td></tr>" ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /TAB 2 CONTENT -->

                    <div id="ttab3_nobg" class="tab-pane"><!-- TAB 3 CONTENT -->
                        <strong>ภูมิลำเนา</strong>
                        <div class="modal-body">
                            <table class="table table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>ที่อยู่</th>
                                    <th>ตำบล/แขวง</th>
                                    <th>อำเภอ</th>
                                    <th>จังหวัด</th>
                                    <th>รหัสไปรษณีย์</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($model_address as $address) { ?>
                                    <?php echo "<tr><td>" . $address->address_type . "</td><td>"
                                        . $address->tumbon . "</td><td>"
                                        . $address->amphor . "</td><td>"
                                        . $address->province . "</td><td>"
                                        . $address->zipcode . "</td></tr>" ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /TAB 3 CONTENT -->

                    <div id="ttab4_nobg" class="tab-pane"><!-- TAB 4 CONTENT -->
                        <strong>ประวัติการศึกษา</strong>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ชื่อโรงเรียน</th>
                                    <th>ถนน</th>
                                    <th>อำเภอ</th>
                                    <th>จังหวัด</th>
                                    <th>เบอร์โทรศัพท์โรงเรียน</th>
                                    <th>เป็นโรงเรียน</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td><?= $model_candidate->schoolname ?></td>
                                    <td>หน้าเมือง</td>
                                    <td>เมือง</td>
                                    <td>กาฬสินธ์ุ</td>
                                    <td>040-345678</td>
                                    <td><?= $model_candidate->school_status ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /TAB 4 CONTENT -->

                    <div id="ttab5_nobg" class="tab-pane"><!-- TAB 5 CONTENT -->
                        <strong>ผลการศึกษา</strong>
                        <div class="modal-body">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>คะแนนเฉลี่ย</th>
                                    <th>เกรดเฉลี่ย</th>
                                </tr>
                                <?php foreach ($model_candidate->scbEnrollScholarships as $row) { ?>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5 รวมทุกวิชา</th>
                                    <?php echo "<td>" . $row->gpax_4to5 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5 วิชาคณิตศาสตร์เท่ากับ</th>
                                    <?php echo "<td>" . $row->gpa_math4to5 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4 วิชาคณิตศาสตร์</th>
                                    <?php echo "<td>" . $row->gpa_math4 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 5 วิชาคณิตศาสตร์</th>
                                    <?php echo "<td>" . $row->gpa_math5 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4 วิชาเคมี</th>
                                    <?php echo "<td>" . $row->gpa_chem4 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 5 วิชาเคมี</th>
                                    <?php echo "<td>" . $row->gpa_chem5 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4 วิชาฟิสิกส์</th>
                                    <?php echo "<td>" . $row->gpa_physic4 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 5 วิชาฟิสิกส์</th>
                                    <?php echo "<td>" . $row->gpa_physic5 . "</td>" ?>
                                </tr>
                                <tr>
                                    <th>คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5 เฉพาะวิชาคณิตศาสตร์ ฟิสิกส์ เคมี</th>
                                    <?php echo "<td>" . $row->gpa_sum_chem_physic_math_4to5 . "</td>" ?>
                                </tr>
                                </thead>
                                <?php } ?>
                            </table>
                        </div>
                    </div>

                    <div id="ttab6_nobg" class="tab-pane"><!-- TAB 5 CONTENT -->
                        <strong>คะแนนสอบ</strong><br>
                        <div id="graph"></div>
                        <p>วิทยาศาสตร์ = <?php
                            $model_score=\app\modules\scholar_b\models\ScbScore::find()
                            ->where('scb_subject_subject_id=1')
                                ->andWhere('candidate_id_card="'.$model_candidate->id_card.'"')
                            ->one();
                            if (!empty($model_score)){
                                echo $model_score->score;
                            }else{
                                echo "";
                            }



                            ?></p>
                        <p>คณิตศาสตร์ =
                            <?php
                            $model_score=\app\modules\scholar_b\models\ScbScore::find()
                                ->where('scb_subject_subject_id=2')
                                ->andWhere('candidate_id_card="'.$model_candidate->id_card.'"')
                                ->one();

                            if (!empty($model_score)){
                                echo $model_score->score;
                            }else{
                                echo "";
                            }


                            ?>
                        </p>
                        <p>ความถนัดทางคอมพิวเตอร์ =
                            <?php
                            $model_score=\app\modules\scholar_b\models\ScbScore::find()
                                ->where('scb_subject_subject_id=3')
                                ->andWhere('candidate_id_card="'.$model_candidate->id_card.'"')
                                ->one();

                            if (!empty($model_score)){
                                echo $model_score->score;
                            }else{
                                echo "";
                            }


                            ?>
                        </p>
                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">
                            เพิ่มคะแนน
                        </button>
                        <div id="demo" class="collapse">
                            <table class="table">
                                <thead>
                                <tr>
                                    <!-- ในส่วนของคะแนนสอบ สามารถเพิ่มวิชาเข้าไปได้ แค่ต้องปรับแต่งนิดหน่อย -->
                                    <th>วิทยาศาสตร์</th>
                                    <th>คณิตศาสตร์</th>
                                    <th>ความถนัดทางคอมพิวเตอร์</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form method="get">
                                    <tr>
                                        <td>
                                            <input type="text" hidden value="<?= $model_candidate->id_card?>" id="id">
                                            <input type="text"  id="sci"  class="form-control">
                                        </td>
                                        <td>
                                            <input type="text"  id="math" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text"  id="com" class="form-control">
                                        </td>
                                    </tr>
                                </form>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success" id="score_candidate" name="score_candidate">บันทึก</button>
                        </div>
                    </div>

                    <div id="ttab7_nobg" class="tab-pane"><!-- TAB 7 CONTENT -->
                        <strong>ผลงาน</strong>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ผลงานที่ได้รับรางวัล</th>
                                    <th>ระดับการแข่งขัน</th>
                                    <th>วันที่แข่งขัน</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>เหรียญทองหุ่นยนต์ ม.ปลาย สพฐ</td>
                                    <td>ประเทศ</td>
                                    <td>21/10/55</td>
                                    <td><a href="#" class="btn btn-default btn-xs"><i
                                                    class="fa fa-edit white"></i> แสดงความคิดเห็น </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>แข่งขันตอบปัญหา ICT</td>
                                    <td>ภาค</td>
                                    <td>22/11/55</td>
                                    <td><a href="#" class="btn btn-default btn-xs"><i
                                                    class="fa fa-edit white"></i> แสดงความคิดเห็น </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ผลงานที่เข้าร่วมแข่งขัน</th>
                                    <th>ระดับการแข่งขัน</th>
                                    <th>วันที่แข่งขัน</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>หุ่นยนต์กู้ภัย อายุไม่เกิน 18</td>
                                    <td>ประเทศ</td>
                                    <td>23/12/55</td>
                                    <td><a href="#" class="btn btn-default btn-xs"><i
                                                    class="fa fa-edit white"></i> แสดงความคิดเห็น </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /tabs content -->
        </div>
    </div>
</div>

<?php

$this->registerJs(<<<JS
 



JS
);
?>

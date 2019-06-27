<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbCandidate */

$this->title = $model->id_card;
$this->params['breadcrumbs'][] = ['label' => 'Scb Candidates', 'url' => ['index-other']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scb-candidate-view">
    <div id="content" class="padding-20">
        <div id="panel-1" class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="panel-heading">
        <span class="title elipsis">
            <i class="fa fa-save" aria-hidden="true"></i>
            <strong> ข้อมูลการสมัคร</strong> <!-- panel title -->
        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <label>รหัสบัตรประชาชน :</label>
                            <?php echo $model->id_card; //echo $model_parent[0] -> parents_id;?><br>

                            <label>ชื่อ-นามสกุล :</label>
                            <?php echo $model->prefix . ' ' . $model->firstname . ' ' . $model->lastname ?><br>

                            <label>กรุ๊ปเลือด :</label>
                            <?php echo $model->blood_type ?><br>

                            <label>วัน/เดือน/ปี ที่เกิด :</label>
                            <?php echo $model->birth_date ?><br>

                            <label>เชื้อชาติ :</label>
                            <?php echo $model->origin ?><br>

                            <label>สัญชาติ :</label>
                            <?php echo $model->nationality ?><br>

                            <label>ศาสนา :</label>
                            <?php echo $model->religion ?><br>

                            <label>สถานที่เกิด :</label>
                            <?php echo $model->place_of_birth ?><br>

                            <label>Email :</label>
                            <?php echo $model->email ?><br>

                            <label>เบอร์โทรศัพท์ :</label>
                            <?php echo $model->mobile ?><br>

                            <label>สถานะ :</label>
                            <?php echo $model->status ?><br>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="panel-heading">
                         <span class="title elipsis">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <strong> ที่อยู่ที่สามารถติดต่อได้</strong> <!-- panel title -->
                         </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <label>ที่อยู่ : </label>
                            <?php foreach ($address_candidate as $key => $address) { ?>
                                <?php echo $address->address_type . ' ' . $address->tumbon
                                    . ' ' . $address->amphor . ' ' . $address->province . ' ' . $address->zipcode ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel-heading">
                         <span class="title elipsis">
                            <i class="fa fa-group" aria-hidden="true"></i>
                            <strong> ข้อมูลบิดา-มารดา</strong> <!-- panel title -->
                         </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?php foreach ($model->scbParentsIdCardParents as $row) {
                                ?>
                                <?php if ($row->parent_type == 'นาย') { ?>
                                    <strong>ข้อมูลบิดา</strong><br>
                                    <label>เลขบัตรประจำตัวประชาชน : </label>
                                    <?php echo $row->id_card_parent ?><br>
                                    <label>ชื่อ-นามสกุล : </label>
                                    <?php echo $row->firstname . ' ' . $row->lastname ?><br>
                                    <label>เบอร์โทรศัพท์ : </label>
                                    <?php echo $row->mobile ?><br>
                                    <label>อาชีพ : </label>
                                    <?php echo $row->occupation ?><br>

                                <?php } else if ($row->parent_type == 'นาง' || $row->parent_type == 'นางสาว') { ?>
                                    <strong>ข้อมูลมารดา</strong><br>
                                    <label>เลขบัตรประจำตัวประชาชน : </label>
                                    <?php echo $row->id_card_parent . '<br>'; ?>
                                    <label>ชื่อ-นามสกุล : </label>
                                    <?php echo $row->firstname . ' ' . $row->lastname ?><br>
                                    <label>เบอร์โทรศัพท์ : </label>
                                    <?php echo $row->mobile ?><br>
                                    <label>อาชีพ : </label>
                                    <?php echo $row->occupation ?><br>
                                <?php }
                            } ?>
                        </div>
                    </div>
                </div>


                <div style="text-align:center;">
                    <?= Html::a('แก้ไขข้อมูล', ['update', 'id' => $model->id_card], ['class' => 'btn btn-success']) ?>
                    <?= Html::a("กลับสู่หน้าหลัก", ['site/index-other'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>


        </div>
    </div>

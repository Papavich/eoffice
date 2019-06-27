<?php
use app\modules\scholar_b\controllers;
?>
<!-- /page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Candidates List') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Candidates List') ?></li>
    </ol>
</header>
<!-- /page title -->

<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-4">
                    <h4>รายชื่อผู้สมัคร</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label>กรุณาเลือกทุนการศึกษา</label>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12" style="margin-top: 20px">
                        <table id="table1" class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="85%">ชื่อทุนการศึกษา</th>
                                <th width="10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 1;
                            foreach ($sc_year as $item) {

                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><a href="../candidate/list-by-sc?id=<?=$item->scholarship_id?>&year=<?=$item->scholarship_year?>"><?= $item->scname->scholarship_name . " ปีการศึกษา " . $item->scholarship_year ?></a></td>
                                    <td></td>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
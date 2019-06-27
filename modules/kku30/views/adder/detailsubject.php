<!--JS-->
<?= $this->render('/table/_formjs') ?>
<!--JS-->


<section>
    <!-- page title -->
    <header id="page-header">
        <h1>รายละเอียดวิชา <?= $sub_id ?> <?= $sub_namethai ?> <b> </b></h1>
        <ol class="breadcrumb">
            <li><a href="/kku30">หน้าแรก</a></li>
            <li><a href="javascript:history.back(1);">แสดงรายวิชาที่เปิดสอน</a></li>
            <li class="active">รายละเอียดวิชา</li>
        </ol>
    </header>

    <div id="section-to-print">
        <div id="content" class="padding-20">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong> <?= $sub_id ?> <?= $sub_namethai ?> ( <?= $sub_nameeng ?> )</strong>
                </div>

                <div class="panel-body">

                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td width="25%"><b>รหัสวิชา</b></td>
                            <td width="75%"><?= $sub_id ?></td>
                        </tr>
                        <tr>
                            <td><b>ชื่อวิชาภาษาไทย</b></td>
                            <td><?= $sub_namethai ?></td>
                        </tr>
                        <tr>
                            <td><b>ชื่อวิชาภาษาอังกฤษ</b></td>
                            <td><?= $sub_nameeng ?></td>
                        </tr>
                        <tr>
                            <td><b>อาจารย์ผู้สอน</b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><b>จำนวนหน่วยกิต</b></td>
                            <td><?= $sub_credit ?></td>
                        </tr>
                        <tr>
                            <td><b>จำนวนชั่วโมง</b></td>
                            <td><?= $sub_time ?></td>
                        </tr>
                        <tr>
                            <td><b>หลักสูตรปี</b></td>
                            <td><?= $sub_version ?></td>
                        </tr>
                        <tr>
                            <td><b>ปีการศึกษา</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b><b>ภาคการเรียนที่</b></b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>ประเภทวิชา</b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><b>กลุ่มผู้เรียน</b></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td><b>คำอธิบายวิชา</b></td>
                            <td><?= $sub_desc ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-heading">
                    <span class="title elipsis">
                                <!-- PRINT BUTTON -->
                        <div align="right" class="hidden-print">
                            <button class="btn btn-blue btn-sm" onclick="printWindow()"><i class="fa et-printer"></i>Print &nbsp;&nbsp;|&nbsp;&nbsp;     <i
                                    class="fa et-download"></i>Download</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>




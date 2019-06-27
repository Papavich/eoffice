<section id="#S">


    <!-- page title -->
    <header id="page-header">
        <h1>โครงการวิจัย</h1>
        <ol class="breadcrumb">
            <li><a href="#">กิจกรรม</a></li>
            <li class="active">โครงการวิจัย</li>
        </ol>
    </header>
    <!-- /page title -->

    <div id="content" class="padding-20">


        <div id="panel-1" class="panel panel-default">

            <div class="panel-heading">
							<span class="title elipsis">
								<strong>โครงการวิจัย</strong> <!-- panel title -->
							</span>

                <!-- right options -->
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                           data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                           data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    <li><a href="#" class="opt panel_close" data-confirm-title="Confirm"
                           data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip"
                           title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                </ul>
                <!-- /right options -->

            </div>

            <!-- panel content -->
            <div class="panel-body">


                <?php /* @var $row \app\modules\portfolio\models\Project */
                foreach ($sql2 as $row) { ?>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                        <thead>

                        <tr>
                            <th><?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;
                                    echo $row4->project->project_name_eng;

                                } ?></th>
                            <th>
                                <a href="Expenses-namepublic.html" class="btn btn-xs btn-default btn-bordered">
                                    <i class="et-megaphone"></i>
                                    <span>ผลงานตีพิมพ์</span></a>

                            </th>
                        </tr>

                        </thead>

                    </table>
                    <div class="col-md-9 col-sm-8">
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                            <tbody>
                            <tr>หัวหน้าโครงการ : <?php foreach ($row->projectMembers as $row4) {
                                    if ($row4->project_role_id == 1) {
                                        echo \app\modules\portfolio\models\Person::findOne($row4->member_id)->person_name;
                                    }


                                } ?>&nbsp;

                                <?php foreach ($row->projectMembers as $row5) {
                                    echo $row5->project->project_name_eng;

                                } ?>
                            </tr>
                            <br>
                            <tr>ระยะเวลา :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></tr>
                            <th>
                                งบประมาณ :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></th>
                            <br>
                            <tr>
                                เว็บไซต์ :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></tr>
                            <br>
                            <tr>ผู้ให้ทุนสนับสนุน :<?php foreach ($row->projectMembers as $row4) {
                                    echo $row->sponsorSponsor->sponsor_name;


                                } ?></tr>
                            <br>
                            <tr>ปีที่เริ่มต้น-ปีที่สิ้นสุด :&nbsp;&nbsp;<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->project->project_name_thai;

                                } ?></tr>

                            </tbody>

                        </table>

                    </div>
                    <div class="col-md-3col-sm-8">
                        <table>
                            <tr><h5>สมาชิกโครงการ</h5></tr>


                            <th><?php foreach ($row->projectMembers as $row2) {
                                    echo $row2->member_name;

                                } ?></th>


                        </table>

                    </div>
                <?php } ?>
            </div>
            <!-- /panel content -->


        </div>

    </div>

</section>
<!-- page title -->
<header id="page-header">
    <h1>Managed Datatables</h1>
    <ol class="breadcrumb">
        <li><a href="#">Tables</a></li>
        <li class="label label-sm label-success">Managed Datatables</li>
    </ol>
</header>
<!-- /page title -->

<input type="search" id="myInput2" onkeyup="myFunction2()" class="form-control" style="text-align: center;"
       placeholder="ค้นหา">
<div id="content" class="padding-20">

    <!--
        PANEL CLASSES:
            panel-default
            panel-danger
            panel-warning
            panel-info
            panel-success

        INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                All pannels should have an unique ID or the panel collapse status will not be stored!
    -->
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>การประชุมวิชาการ</strong> <!-- panel title -->
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


            <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                <tr>

                    <th>โครงการ</th>
                    <th>หัวหน้าโครงการ</th>
                    <th>ผู้สื่อสาร</th>
                    <th>ชื่อผลงาน</th>
                    <th>

                    </th>
                </tr>
                </thead>
                <?php /* @var $pub app\modules\portfolio\models\Publication */
                foreach ($query2 as $pub) { ?>
                    <tbody>
                    <tr class="odd gradeX">
                        <td>
                            <?php
                            //                            foreach ($project->projectMembers as $projectMember) {


                            echo $pub->pub_name_eng;

                            //                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($pub->publicationOrders as $pubMember) {


                                if ($pubMember->author_level_auth_level_id == 1) {
                                    if ($pub->person_id != null) {
                                        $person = Yii::$app->getDb()->createCommand('select person_fname_th,person_lname_th from view_pis_user WHERE id ='.$pub->person_id)->queryOne();
                                        var_dump($person);

                                        exit;

                                        echo $person['person_fname_th'] . '' . $person['person_lname_th'];
                                    } else {
                                        echo $pub->projectMemberProMember->member_name . '' . $pubMember->projectMemberProMember->member_lname;
                                    }


                                }


                                echo '<br>';

                            }
                            ?>

                        </td>
                        <td>
                            <?php
                            foreach ($pub->publicationOrders as $pubMem) {

                                if ($pubMem->author_level_auth_level_id !== 1) {
                                    if ($pubMem->authorLevelAuthLevel !== null) echo $pubMem->authorLevelAuthLevel->auth_level_name;
                                    if ($pubMem->authorLevelAuthLevel == null)
                                        echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

                                    if ($pub->person_id !== null) {
                                        $person = Yii::$app->getDb()->createCommand('select person_fname_th,person_lname_th from view_pis_user WHERE id =' . $pub->person_id)->queryOne();
                                        echo $person['person_fname_th'] . '' . $person['person_lname_th'];


                                    }


                                }


                                if ($pubMem->projectMemberProMember->member_name !== null) echo $pubMem->projectMemberProMember->member_name;
                                echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';


                                echo '<br>';

                            }
                            ?>

                        </td>
                        <td>
                            <a href="/cs-e-office/web/portfolio/portfolio/edit?pro1=<?php echo $pub->pub_id ?>"
                               class="btn btn-xs btn-default btn-quick"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="/cs-e-office/web/portfolio/portfolio/portfolio/delete?det=<?php echo $pub->pub_id ?>"
                               class="btn btn-xs btn-default btn-quick"><i class="fa fa-trash-o"></i> Delete</a>


                        </td>
                    </tr>


                    </td >
                    </tr >

                    </tbody>

                <?php } ?>
            </table>

        </div>
        <!-- /panel content -->

        <!-- panel footer -->
        <div class="panel-footer">


        </div>
        <!-- /panel footer -->

    </div>
    <!-- /PANEL -->

</div>
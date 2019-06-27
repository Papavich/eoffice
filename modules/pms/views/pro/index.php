<?php

?>


<!-- page title -->
<header id="page-header">
    <h1>ปฏิทินโครงการ</h1>
    <a href="./add">add</a>
    <table border="1">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>Option</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($pro as $key => $aa) : ?>
            <tr>
                <td><?= $aa-> project_id; ?></td>
                <td><?= $aa-> project_name; ?></td>
                <td><a href="./update&id=<?= $aa->project_id; ?>">แก้ไข</a> | <a href="./delete">ลบ</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div class="row">

        <div style="position: absolute;margin: auto" class="col-sm-12 col-md-12 col-lg-10">

            <!-- Panel -->
            <div id="panel-calendar" class="panel panel-default">

                <div class="panel-heading">

								<span class="title elipsis">
									<strong>MY EVENTS</strong> <!-- panel title -->
								</span>

                    <div class="panel-options pull-right"><!-- panel options -->
                        <ul class="options list-unstyled">
                            <li>
                                <a href="#" class="opt dropdown-toggle" data-toggle="dropdown"><span
                                            class="label label-disabled"><span id="agenda_btn">Month</span> <span
                                                class="caret"></span></span></a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a data-widget="calendar-view" href="#month"><i
                                                    class="fa fa-calendar-o color-green"></i> <span>Month</span></a>
                                    </li>
                                    <li><a data-widget="calendar-view" href="#agendaWeek"><i
                                                    class="fa fa-calendar-o color-red"></i> <span>Agenda</span></a></li>
                                    <li><a data-widget="calendar-view" href="#agendaDay"><i
                                                    class="fa fa-calendar-o color-yellow"></i> <span>Today</span></a>
                                    </li>
                                    <li><a data-widget="calendar-view" href="#basicWeek"><i
                                                    class="fa fa-calendar-o color-gray"></i> <span>Week</span></a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                                   data-placement="bottom"></a></li>
                        </ul>
                    </div><!-- /panel options -->

                </div>

                <!-- panel content -->
                <div class="panel-body">

                    <div id="calendar" data-modal-create="true"><!-- CALENDAR CONTAINER --></div>

                </div>
                <!-- /panel content -->

            </div>
            <!-- /Panel -->

        </div>

    </div>


</div>

<?php

/* @var $this \yii\web\View */

/* @var $content string */


use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\pfc\models\Teacher;
use app\modules\pfc\models\Student;
use app\modules\pfc\models\ProjectSubStudent;
use app\modules\pfc\models\Project;
use app\modules\pfc\models\Personnel;
use app\modules\pfc\models\ProjectConnect;

$session = Yii::$app->session;
\app\modules\pfc\assets\AppAsset::register($this);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>Project</title>
    <meta name="description" content=""/>
    <meta name="Author" content="Dorin Grigoras [www.stepofweb.com]"/>
    <?= Html::csrfMetaTags() ?>
    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>

    <!-- WEB FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext"
          rel="stylesheet" type="text/css"/>



    <!-- CORE CSS -->
    <link href="<?= Yii::$app->homeUrl ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!-- THEME CSS -->
    <link href="<?= Yii::$app->homeUrl ?>web_pfc/css/essentials.css" rel="stylesheet" type="text/css"/>
    <link href="<?= Yii::$app->homeUrl ?>web_pfc/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?= Yii::$app->homeUrl ?>web_pfc/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme"/>
    <link href="<?= Yii::$app->homeUrl ?>web_pfc/css/layout-datatables.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="<?= Yii::$app->homeUrl ?>plugins/jquery/jquery-2.1.4.min.js"></script>




    <?php $this->head() ?>
</head>


<body style="background-color: #FFFAFA;">
<?php $this->beginBody() ?>
<!-- WRAPPER -->
<div id="wrapper" class="clearfix">
    <?php if ($session->get('pfc_type') === 1): ?>
    <aside id="aside">
        <nav id="sideNav"><!-- MAIN MENU -->
            <ul class="nav nav-list">
                <li class="active">
                    <a href="#">
                        <i class="main-icon fa fa-book"></i>
                        <i class="fa main-icon pull-right fa-menu-arrow"></i>
                        <span>Project List</span>
                    </a>
                    <ul>
                        <!-- submenus -->
                        <li>
                            <a href="<?= Yii::$app->homeUrl ?>pfc/project/project_teacher?teacher_id=<?= $session['pfc_id'] ?>&type_degree=1">
                                <i class="main-icon et-desktop"></i>
                                <span class="label label-warning pull-right"></span>
                                <span>ปริญญาตรี</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= Yii::$app->homeUrl ?>pfc/project/project_teacher?teacher_id=<?= $session['pfc_id'] ?>&type_degree=2">
                                <i class="main-icon et-presentation"></i>
                                <span class="label label-warning pull-right"></span>
                                <span>ปริญญาโท</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= Yii::$app->homeUrl ?>pfc/project/project_teacher?teacher_id=<?= $session['pfc_id'] ?>&type_degree=3">
                                <i class="main-icon et-briefcase"></i>
                                <span class="label label-warning pull-right"></span>
                                <span>ปริญญาเอก</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?= Yii::$app->homeUrl ?>pfc/calendar/calendar">
                        <i class="main-icon fa fa-newspaper-o"></i>
                        <span class="label label-warning pull-right"></span>
                        <span>Calendar</span>
                    </a>
                </li>


                <h3 style="margin-top: 50px">ระบบหลัก</h3>
                <ul class="nav nav-list">
                    <li><a href="<?= Yii::$app->homeUrl ?>">
                            <i class="main-icon glyphicon glyphicon-log-out"></i>
                            <span>Back Main</span></a></li>
                </ul>

            </ul>
        </nav>
    </aside>
    <?php endif; ?>
    <!--    ------------------------------------------------------ Main Teacher ------------------------------------------------------------------->
    <!--    ------------------------------------------------------ Main student ------------------------------------------------------------------->
    <?php
    $student = Student::find()->where("student_id like :b",[":b"=>$session['pfc_id']])->all();
    $project_con = ProjectConnect::find()->where("student_id like :b",[":b"=>$session['pfc_id']])->all();
    $project = Project::find()->all();
    $project_id = null;
    if ($session->get('pfc_type') === 2):
        ?>
        <aside id="aside">
            <nav id="sideNav">
                <!-- MAIN MENU -->
                <ul class="nav nav-list">
                    <li class="active">
                        <a href="<?= Yii::$app->homeUrl ?>pfc/project/project_student?student_id=<?= $session['pfc_id'] ?>">
                            <i class="main-icon fa fa-newspaper-o"></i>
                            <span class="label label-warning pull-right"></span>
                            <span>Project Detail</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= Yii::$app->homeUrl ?>pfc/calendar/calendar">
                            <i class="main-icon fa fa-newspaper-o"></i>
                            <span class="label label-warning pull-right"></span>
                            <span>Calendar</span>
                        </a>
                    </li>


                    <h3 style="margin-top: 50px">ระบบหลัก</h3>
                    <ul class="nav nav-list">
                        <li><a href="<?= Yii::$app->homeUrl ?>">
                                <i class="main-icon glyphicon glyphicon-log-out"></i>
                                <span>Back Main</span></a></li>
                    </ul>

                </ul>
            </nav>
        </aside>
    <?php endif; ?>
    <!--    ------------------------------------------------------ Main student ------------------------------------------------------------------->
    <!--    ----------------------------------------------------   Main personnel  ------------------------------------------------------------------->
    <?php if ($session->get('pfc_type') === 3): ?>
        <aside id="aside">
            <nav id="sideNav">
                <ul class="nav nav-list">
                    <li>
                        <a href="<?= Yii::$app->homeUrl ?>pfc/personnel/personnel_type?student_id=<?= $session['pfc_id'] ?>">
                            <i class="main-icon fa fa-sign-in"></i>
                            <span class="label label-warning pull-right"></span>
                            <span>กำหนดการมาตรฐาน</span>
                        </a>
                    </li>


                    <h3 style="margin-top: 50px">ระบบหลัก</h3>
                    <ul class="nav nav-list">
                        <li><a href="<?= Yii::$app->homeUrl ?>">
                                <i class="main-icon glyphicon glyphicon-log-out"></i>
                                <span>Back Main</span></a></li>
                    </ul>

                </ul>
            </nav>
        </aside>
    <?php endif; ?>
    <!--    ----------------------------------------------------   Main personnel  ------------------------------------------------------------------->
    <!--    ----------------------------------------------------   Main Admin  ------------------------------------------------------------------->
    <?php if ($session->get('pfc_type') === 4): ?>
        <aside id="aside">
            <nav id="sideNav">
                <ul class="nav nav-list">

                    <li class="menu-open">
                        <a>
                            <i class="main-icon fa fa-book"></i>
                            <i class="fa main-icon pull-right fa-menu-arrow"></i>
                            <span>เจ้าหน้าที่</span>
                        </a>
                        <ul>
                            <li>
                                <a href="<?= Yii::$app->homeUrl ?>pfc/personnel/personnel_type?student_id=<?= $session['pfc_id'] ?>">
                                    <i class="main-icon fa fa-calendar"></i>
                                    <span class="label label-warning pull-right"></span>
                                    <span>กำหนดการมาตรฐาน</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <h3 style="margin-top: 50px">ระบบหลัก</h3>
                    <ul class="nav nav-list">
                        <li><a href="<?= Yii::$app->homeUrl ?>">
                                <i class="main-icon glyphicon glyphicon-log-out"></i>
                                <span>Back Main</span></a></li>
                    </ul>

                </ul>
            </nav>
        </aside>
    <?php endif; ?>
    <!--    ----------------------------------------------------   Main Admin  ------------------------------------------------------------------->

    </nav>

        <span id="asidebg"><!-- aside fixed background --></span>
    </aside>
    <!-- /ASIDE -->
    <!-- HEADER -->
    <header id="header">
        <!-- Mobile Button -->
        <button id="mobileMenuBtn"></button>
        <!--        = Yii::$app->basePath?><!--/assets/images/logo_light.png-->
        <!-- Logo jaa-->
        <span class="logo pull-left">
					<img src="<?= Yii::$app->homeUrl ?>web_pfc/images/logo_1.png" alt="admin panel" height="35" width="160" style="margin-top: 10px"/>
				</span>
        <form method="get" action="page-search.html" class="search pull-left hidden-xs">
            <input type="text" class="form-control" name="k" placeholder="Search for something..."/>
        </form>
        <nav>
            <!-- OPTIONS LIST -->
            <ul class="nav pull-right">
                <li class="dropdown pull-left">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img class="user-avatar" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg"
                             height="34"/>
                        <span class="user-name">
									<span class="hidden-xs">
										 <?php
                                         if (!Yii::$app->user->isGuest) {
                                             if (Yii::$app->user->identity->username == 'admin') {
                                                 print('Account(' . Yii::$app->user->identity->username . ')');
                                             } else {
                                                 print('Account(' . Yii::$app->user->identity->username . ')');
                                             }
                                         } else {
                                             print "ยังไม่ได้เข้าสู่ระบบ";
                                         }
                                         ?>
									</span>
								</span>
                    </a>
                    <ul class="dropdown-menu hold-on-click">
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            if (Yii::$app->user->identity->username == 'admin') {
                                ?>
                                <li>
                                    <a href="<?= Yii::getAlias('@web') ?>/admin/user"> Admin</a>
                                </li>
                                <?php
                            } else {
                            }
                            ?>

                            <li>
                                <a href="<?= Yii::getAlias('@web') ?>/personsystem/site/profileuser">Profile</a>
                            </li>
                            <li class="divider"></li>
                            <form action="<?= Yii::getAlias('@web') ?>/site/logout" method="post">
                                <input type="hidden" name="_csrf"
                                       value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                                <button type="submit" class="btn btn-link logout">Log Out</button>
                            </form>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
            <!-- /OPTIONS LIST -->
        </nav>

    </header>
    <!-- /HEADER -->
    <!--    content-->
    <section id="middle">
        <?= $content ?>
    </section>
    <!--    content-->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



<script type="text/javascript">
    var plugin_path = '<?= Yii::$app->homeUrl ?>plugins/';
</script>


<!-- CSS FOOTABLE -->
<link href="<?= Yii::$app->homeUrl ?>plugins/footable/css/footable.core.min.css" rel="stylesheet"
      type="text/css"/>
<link href="<?= Yii::$app->homeUrl ?>plugins/footable/css/footable.standalone.css" rel="stylesheet"
      type="text/css"/>




<!-- JS FOOTABLE -->
<script type="text/javascript">
    loadScript(plugin_path + "footable/dist/footable.min.js", function () {
        loadScript(plugin_path + "footable/dist/footable.sort.min.js", function () {
            loadScript(plugin_path + "footable/dist/footable.paginate.min.js", function () {
                /** remove if pagination not needed **/

                var $ftable = jQuery('.fooTableInit');


                /** 01. FOOTABLE INIT
                 ******************************************* **/
                $ftable.footable({
                    breakpoints: {
                        s600: 600,
                        s1000: 1000
                    }
                });


                /** 01. PER PAGE SWITCH
                 ******************************************* **/
                jQuery('#change-page-size').change(function (e) {
                    e.preventDefault();
                    var pageSize = jQuery(this).val();
                    $ftable.data('page-size', pageSize);
                    $ftable.trigger('footable_initialized');
                });

                jQuery('#change-nav-size').change(function (e) {
                    e.preventDefault();
                    var navSize = jQuery(this).val();
                    $ftable.data('limit-navigation', navSize);
                    $ftable.trigger('footable_initialized');
                });


                /** 02. BOOTSTRAP 3.x PAGINATION FIX
                 ******************************************* **/
                jQuery("div.pagination").each(function () {
                    jQuery("div.pagination ul").addClass('pagination');
                    jQuery("div.pagination").removeClass('pagination');
                });


            });
        });
    });

</script>

<!-- ---------------------------------------------------- JS Teacher Project Table -------------------------------------------------------->


<script type="text/javascript">
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
        loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){
            loadScript(plugin_path + "select2/js/select2.full.min.js", function(){

                if (jQuery().dataTable) {

                    function restoreRow(oTable, nRow) {
                        var aData = oTable.fnGetData(nRow);
                        var jqTds = $('>td', nRow);

                        for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                            oTable.fnUpdate(aData[i], nRow, i, false);
                        }

                        oTable.fnDraw();
                    }

                    function editRow(oTable, nRow) {
                        var aData = oTable.fnGetData(nRow);
                        var jqTds = $('>td', nRow);
                        jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
                        jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
                        jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
                        jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
                        jqTds[4].innerHTML = '<a class="edit" href="">Save</a>';
                        jqTds[5].innerHTML = '<a class="cancel" href="">Cancel</a>';
                    }

                    function saveRow(oTable, nRow) {
                        var jqInputs = $('input', nRow);
                        oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                        oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                        oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                        oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                        oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
                        oTable.fnDraw();
                    }

                    function cancelEditRow(oTable, nRow) {
                        var jqInputs = $('input', nRow);
                        oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                        oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                        oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                        oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                        oTable.fnDraw();
                    }

                    var table = $('#sample_editable_1');

                    var oTable = table.dataTable({
                        "lengthMenu": [
                            [5, 15, 20, -1],
                            [5, 15, 20, "All"] // change per page values here
                        ],
                        // set the initial value
                        "pageLength": 20,

                        "language": {
                            "lengthMenu": " _MENU_ records"
                        },
                        "columnDefs": [{ // set default column settings
                            'orderable': true,
                            'targets': [0]
                        }, {
                            "searchable": true,
                            "targets": [0]
                        }],
                        "order": [
                            [0, "asc"]
                        ] // set first column as a default sort by asc
                    });

                    var tableWrapper = $("#sample_editable_1_wrapper");

                    tableWrapper.find(".dataTables_length select").select2({
                        showSearchInput: false //hide search box with special css class
                    }); // initialize select2 dropdown

                    var nEditing = null;
                    var nNew = false;

                    $('#sample_editable_1_new').click(function (e) {
                        e.preventDefault();

                        if (nNew && nEditing) {
                            if (confirm("Previose row not saved. Do you want to save it ?")) {
                                saveRow(oTable, nEditing); // save
                                $(nEditing).find("td:first").html("Untitled");
                                nEditing = null;
                                nNew = false;

                            } else {
                                oTable.fnDeleteRow(nEditing); // cancel
                                nEditing = null;
                                nNew = false;

                                return;
                            }
                        }

                        var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
                        var nRow = oTable.fnGetNodes(aiNew[0]);
                        editRow(oTable, nRow);
                        nEditing = nRow;
                        nNew = true;
                    });

                    table.on('click', '.delete', function (e) {
                        e.preventDefault();

                        if (confirm("Are you sure to delete this row ?") == false) {
                            return;
                        }

                        var nRow = $(this).parents('tr')[0];
                        oTable.fnDeleteRow(nRow);
                        alert("Deleted! Do not forget to do some ajax to sync with backend :)");
                    });

                    table.on('click', '.cancel', function (e) {
                        e.preventDefault();

                        if (nNew) {
                            oTable.fnDeleteRow(nEditing);
                            nNew = false;
                        } else {
                            restoreRow(oTable, nEditing);
                            nEditing = null;
                        }
                    });

                    table.on('click', '.edit', function (e) {
                        e.preventDefault();

                        /* Get the row as a parent of the link that was clicked on */
                        var nRow = $(this).parents('tr')[0];

                        if (nEditing !== null && nEditing != nRow) {
                            /* Currently editing - but not this row - restore the old before continuing to edit mode */
                            restoreRow(oTable, nEditing);
                            editRow(oTable, nRow);
                            nEditing = nRow;
                        } else if (nEditing == nRow && this.innerHTML == "Save") {
                            /* Editing this row and want to save it */
                            saveRow(oTable, nEditing);
                            nEditing = null;
                            alert("Updated! Do not forget to do some ajax to sync with backend :)");
                        } else {
                            /* No edit in progress - let's start one */
                            editRow(oTable, nRow);
                            nEditing = nRow;
                        }
                    });

                }

            });
        });
    });

</script>
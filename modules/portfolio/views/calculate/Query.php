<?php
include "connectDB/connectdb.php";
?>

<!DOCTYPE html>
<!--
Conquer Template
http://www.templatemo.com/preview/templatemo_426_conquer
-->
<head>
    <title>มหาลัยขอนแก่่น</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Style Sheets -->

    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- JavaScripts -->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/jquery.singlePageNav.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.lightbox.js"></script>
    <script src="js/templatemo_custom.js"></script>
    <script src="js/responsiveCarousel.min.js"></script>
</head>
<body>

<style >

    * {
        box-sizing: border-box;
    }
    .btn {
        display: inline-block;
        border-radius: 2px;
        border: none;
        height: 45px;
        padding: 0;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .sm {
        width: 10%;
    }

    .md {
        width: 20%;
    }

    .lg {
        width: 40%;
    }

    .cta {
        background-color: #11aab2;
        color: white;

        transition: .2s ease;

    &:hover {
         background-color: darken($primary, 5%);
     //color: $primary;
     //border: 1px solid $primary;

         transition: .2s ease;
     }
    }


    .cta2 {
        background-color: #11b262;
        color: white;

        transition: .2s ease;

    &:hover {
         background-color: darken($primary, 5%);
     //color: $primary;
     //border: 1px solid $primary;

         transition: .2s ease;
     }
    }


    .row {
        width: 100%;
        position: relative;
        display: inline-block;
    //margin: 10px;
        text-align: center;
    }



</style>

<!-- header start -->
<div id="templatemo_home_page">
    <div class="templatemo_topbar">
        <div class="container">
            <div class="row">
                <div class="templatemo_titlewrapper"><img src="https://admissions.kku.ac.th/app//assets/img/logo.png" alt="" style="width:150px;height:180px;">

                    <div class="templatemo_title"><span></span></div>
                </div>
                <div class="clear"></div>
                <div class="templatemo_titlewrappersmall"></div>
                <nav class="navbar navbar-default templatemo_menu" role="navigation">
                    <div class="container-fluid">

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div id="top-menu">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a class="menu" href="admin.php">หน้าหลัก</a></li>



                                    <li><a class="menu" href="news.php">เพิ่มข้อมูล</a></li>







                                </ul>
                            </div>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="templatemo_headerimage">
        <div class="flexslider">

        </div>
    </div>
    <div class="slider-caption">
        <div class="templatemo_homewrapper">
            <div class="templatemo_hometitle"></div>
            <div class="templatemo_hometext"></div>
            <!-- <div class="templatemo_homebutton"><a href="#">Continue</a></div> -->
        </div>
    </div>
</div>
<!-- header end -->






<!-- follow me template -->


<script>
    $(function() {
        $('.crsl-items').carousel({
            visible: 4,
            itemMinWidth: 180,
            itemEqualHeight: 370,
            itemMargin: 9,
        });
        $("a[href=#]").on('click', function(e) {
            e.preventDefault();
        });
    });
</script>
</div>
</div>
<!-- team end -->
<div class="clear"></div>
<!-- contact start -->
<div class="templatemo_contactwrapper" id="templatemo_contact_page">
    <div class="container">
        <div class="row">

        </div>
    </div>

    <?php
    include "connectDB/connectdb.php";
    ?>

    <!Document HTML>
    <HTML>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>ข้อมูลมีผลงาน</title>
    <body>

    <div class="templatemo_servicewrapper" id="templatemo_service_page">
        <div class="container">
            <div class="row">
                <h3 class="text-muted">ข้อมูลผลงานการแข่งขัน</h3>



                <table class="table">
                    <thead>
                    <tr> <th class='text-center'>ลำดับ</th>
                        <th class='text-center'>รหัสนักศึกษา</th>
                        <th class='text-center'>ชื่อ</th>
                        <th class='text-center'>นามสกุล</th>


                        <th class='text-center'></th>

                    </tr>
                    </thead>
                    <?php
                    $sql = mysqli_query($conn,"SELECT * FROM student ");
                    $n=1;
                    while($row = mysqli_fetch_array($sql)){
                        echo "<tr class='text-center'>";
                        echo "<td>".$n."</td>";
                        echo "<td><a href='#".$row['Std_id']."'>&nbsp;&nbsp;".$row['Std_id']."</td>";

                        echo "<td>".$row['Fname']."</td>";
                        echo "<td>".$row['Lname']."</td>";
                        //echo "<td><img src=".$row['status_pic']." width='30em'>".$row['status_name']."</td>";
                        echo "<td><a href='add_news2.php'>บันทึกค่าใช้จ่าย</td>";
                        echo "<td><a href='add_news3.php'>บันทึกค่าข้อมูล</td>";
                        echo "<td><a href='4.php'>บันทึกการประชุมวิชาการ</td>";


                        echo "<td><a href='amdel_PO.php?bor_id=".$row['Std_id']."' onclick='return confirm(\"คุณแน่ใจที่ต้องการาลบ?\");'>
													<img src='http://icons.iconarchive.com/icons/everaldo/desktoon/256/Trash-Empty-icon.png' width='30em'>
												</a></td>";

                        echo "</tr>";
                        $n++;
                    }
                    ?>

                </table>

            </div>
        </div>

    </div>

</div>

</div>
<div class="templatemo_footerwrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">Copyright &copy; 2016 <a href="#">ICT group 31</a> | Design: <a href="http://www.templatemo.com">templatemo</a>
                &nbsp;&nbsp;&nbsp;<a href="imdex.php">Logout</a></div>
        </div>
    </div>
</div>




<!-- footer start -->

<!-- footer end -->
</body>
</HTML>

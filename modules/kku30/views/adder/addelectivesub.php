
<section>
    <!-- page title -->
    <header id="page-header">
        <h1>เพิ่มวิชาเลือกที่จะทำการเปิดการสอน</h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li><a href="searchsubjectsemester?sub_student=<?=$sub_student?>&sub_year=<?=$sub_year?>&sub_stdyear=<?=$sub_stdyear?>">วิชาเลือกที่เปิดสอน</a></li>
            <li class="active">เพิ่มวิชาเลือก</li>
        </ol>
    </header>
    <!-- /page title -->
    <!--    SHOW SUBJECT LIST-->
    <div id="partA">
        <?= $this->render('_formaddelectivesub', [
            'model' => $model, //ใช้ไปก่อน
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'sub_year' => $sub_year,
            'plan_semester' => $plan_semester,
        ]) ?>
    </div>


</section>




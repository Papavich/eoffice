<section>
    <!-- page title -->
    <header id="page-header">
        <h1>จัดกลุ่มของ section วิชา <?=$Data_id_sub?> <?=$Data_nameThai?> ภาคการเรียนที่ <?=$plan_semester?> ประจำปีการศึกษา <?=$sub_year?></h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li class="active">รายวิชาที่เปิดสอน</li>
        </ol>
    </header>
        <?= $this->render('_formaddgroupsection', [
            'section_no' => $section_no,
            'Data_id_sub' => $Data_id_sub,
            'Data_nameThai' => $Data_nameThai,
            'Data_nameEng' => $Data_nameEng,
            'plan_semester' => $plan_semester,
            'subject_version' => $subject_version,
            'subject_credit' => $subject_credit,
            'subject_count_lec' => $subject_count_lec,
            'subject_count_lab' => $subject_count_lab,
            'sub_year' => $sub_year,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'std_amount' => $std_amount,
            'L1' => $L1,
            'L2' => $L2,
            'L3' => $L3,
            'LB1' => $LB1,
            'LB2' => $LB2,
            'LB3' => $LB3,

            'condition_lab' => $condition_lab,
            'condition_section' => $condition_section,
            'major' => $major,
            'std_year' => $std_year,
            'std_project' => $std_project,
            'lec_time' => $lec_time,
            'lab_time' => $lab_time,

            'count_lecture' => $count_lecture,
            'count_lab' => $count_lab,

            'std_cs_project1'=>$std_cs_project1,
            'std_cs_project2'=>$std_cs_project2,
            'std_cs_project3'=>$std_cs_project3,
            'std_cs_project4'=>$std_cs_project4,

            'std_it_project1'=>$std_it_project1,
            'std_it_project2'=>$std_it_project2,
            'std_it_project3'=>$std_it_project3,
            'std_it_project4'=>$std_it_project4,

            'std_gis_project1'=>$std_gis_project1,
            'std_gis_project2'=>$std_gis_project2,
            'std_gis_project3'=>$std_gis_project3,
            'std_gis_project4'=>$std_gis_project4,

        ]) ?>
</section>


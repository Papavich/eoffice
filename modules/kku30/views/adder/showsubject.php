
<section>
    <!-- page title -->
    <header id="page-header">
        <h1>แสดงวิชาที่จะทำการเปิดการสอน</h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li class="active">รายวิชาที่เปิดสอน</li>
        </ol>
    </header>
    <!-- /page title -->
    <!--    SHOW SUBJECT LIST-->
    <div id="partA" >
        <?= $this->render('_formshowsubject', [
            'model' => $model, //ใช้ไปก่อน
            'Count_AllData' => $Count_AllData,
            'Count_Term1' => $Count_Term1,
            'Count_Term2' => $Count_Term2,
            'Data_subject_term1' => $Data_subject_term1,
            'Data_subject_term2' => $Data_subject_term2,
            'sub_student' => $sub_student,
            'sub_stdyear' => $sub_stdyear,
            'sub_year' => $sub_year,
            'course_id' => $course_id,
            'subject_opened' => $subject_opened,
            'subject_opened_program' =>$subject_opened_program
        ]) ?>
    </div>
    <!--    SHOW SUBJECT LIST-->
    <!--    SHOW ADD SUBJECT-->

    <div id="partB">
        <?= $this->render('_formshowelectivesub', [
            'Count_AllData_Elective' => $Count_AllData_Elective,
            'Count_Elective_Term1' => $Count_Elective_Term1,
            'Count_Elective_Term2' => $Count_Elective_Term2,
            'Data_subject_elective_term1' => $Data_subject_elective_term1,
            'Data_subject_elective_term2' => $Data_subject_elective_term2,
            'sub_year' => $sub_year,
            'sub_stdyear' => $sub_stdyear,
            'sub_student' => $sub_student,
            'course_id' => $course_id,
            'subject_opened' => $subject_opened,
            'subject_opened_program' =>$subject_opened_program
        ]) ?>
    </div>
    <!--    SHOW ADD SUBJECT-->




</section>




<!--JS-->
<script>
    function showAddcondition(sub_engname,sub_teacher) {
       $("#sub_engname").text(sub_engname);
       $("#sub_teacher").text(sub_teacher);
        var x = document.getElementById("addCondition");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
<!--JS-->

<section>
    <!-- page title -->
    <header id="page-header">
        <h1>เพิ่มเงื่อนไขการจัดตาราง</h1>
        <ol class="breadcrumb">
            <li><a href="../table/index">หน้าแรก</a></li>
            <li class="active">เพิ่มเงื่อนไข</li>
        </ol>
    </header>
    <!-- /page title -->




    <!--     SEND DATA and RENDER  _formconditionsubject (SHOW FORM SHOW SUBJECT ADDED) -->

                <?= $this->render('_formconditionsubject', [
                    'model'=>$model,
                    'data_term1'=> $data_term1,
                    'data_term2'=> $data_term2,
                    'N'=>$N,
                    'sub_student' => $sub_student,
                    'sub_year' => $sub_year,
                    'sub_stdyear' => $sub_stdyear,
                    'sub_project' => $sub_project,
                ])
                ?>
    <!--     SEND DATA and RENDER  _formconditionsubject (SHOW FORM SHOW SUBJECT ADDED) -->

<!--     SEND DATA and RENDER  _formaddcondition (SHOW FORM ADD CONDITION) -->

    <?= $this->render('_formaddcondition', [
        'model'=>$model,
        'data_term1'=> $data_term1,
        'data_term2'=> $data_term2,
        'N'=>$N,
        'sub_student' => $sub_student,
        'sub_year' => $sub_year,
        'sub_stdyear' => $sub_stdyear,
        'sub_project' => $sub_project,
    ]) ?>

    <!--     SEND DATA and RENDER  _formaddcondition (SHOW FORM ADD CONDITION) -->
</section>

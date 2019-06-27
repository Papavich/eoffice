<?php
?>
<div id="content" class="padding-20 well">
    <h4>เพิ่มข้อมูลกลยุทธ์</h4>

    <?php
    echo $this->render('strategic_form_kuy',['modelstrategic' => $modelstrategic ,'modelstrategicissues' => $modelstrategicissues]);
    ?>


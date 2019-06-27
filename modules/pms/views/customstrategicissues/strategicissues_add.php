<?php
?>
<div id="content" class="padding-20 well">
    <h4>เพิ่มข้อมูลประเด็นยุทธศาสตร์</h4>
    <?php
    echo $this->render('strategicissues_form',['modelstrategicissues' =>$modelstrategicissues]);
    ?>


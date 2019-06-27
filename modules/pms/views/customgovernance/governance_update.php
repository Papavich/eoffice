<?php
?>

    <div id="content" class="padding-20">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-transparent">
                        <strong>แก้ไขข้อมูลหลักธรรมาภิบาล</strong>
                    </div>
<?php
echo $this->render('governance_form',['modelgovernance' =>$modelgovernance]);
?>
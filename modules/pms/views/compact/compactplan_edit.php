<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/2/2561
 * Time: 21:41
 */
?>

<header id="page-header">
    <h1><strong>แก้ไขเอกสารขออนุมัติจัดโครงการ</strong></h1>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">


                    <?php
                    echo $this->render('compactplan_form',[
                        'modelprosub'=>$modelprosub,'execute'=>$execute,
                        'prosubbudget'=>$prosubbudget,
                        'manager'=>$manager,
                    ]);

                    ?>

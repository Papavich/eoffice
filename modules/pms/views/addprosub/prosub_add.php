<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 29/1/2561
 * Time: 19:01
 */
?>

<header id="page-header">
    <h1><strong>เพิ่มแบบเสนอโครงการ</strong></h1>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">


    <?php

//    echo var_dump($modelProbudget1)."<br><br>";
//    echo var_dump($modelProbudget2)."<br><br>";
//    exit;
    echo $this->render('prosub_form',[
            'modelprosub'=>$modelprosub,
        'strtegicisOfYear'=>$strtegicisOfYear,
        'governanceOfYear'=>$governanceOfYear,
        'modelgovernance'=>$modelgovernance,
        //'modelstrategicHasPro'=>$modelstrategicHasPro,
        'modelsPurpose' =>$modelsPurpose,
        'modelsIndicator' =>$modelsIndicator,
        'modelsPlace' =>$modelsPlace,
        'modelsExecute' =>$modelsExecute,
        'modelProbudget' => $modelProbudget,
        'modelProbudget2' => $modelProbudget2,
        'modelProbudget3' => $modelProbudget3,
        'modelCostplan' => $modelCostplan,
        'modelResult' => $modelResult,
        'modelEffect' => $modelEffect,
        'modelProblem' => $modelProblem,
        'manager'=>$manager,
        'operator'=>$operator,
    ]);
    ?>

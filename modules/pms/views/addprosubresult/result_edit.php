<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 14/2/2561
 * Time: 22:25
 */
?>

<header id="page-header">
    <h1><strong>แก้ไขแบบสรุปผลการดำเนินงานโครงการ</strong></h1>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">


<?php
    echo $this->render('result_form',[
        'modelprosub'=>$modelprosub,
        'modelsPlace'=>$modelsPlace,
        'governanceOfYear'=>$governanceOfYear,
        'modelproblem' => $modelproblem,
        'modelsuggest' => $modelsuggest,
        'modelresult' => $modelresult,
        'modeltarget' => $modeltarget,
        'model_file'=>$model_file,
        'modeldocument' => $modeldocument,
        'modelExecute'=>$modelExecute,
        'sumCost'=>$sumCost,
        'id_compact'=>$id_compact,
        'id'=>$id,
        'modelcomhasprosub'=>$modelcomhasprosub,
    ]);
?>

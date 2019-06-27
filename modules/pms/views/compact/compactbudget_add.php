<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 12/2/2561
 * Time: 21:41
 */
?>

<header id="page-header">
    <?php
    if(!$modelcompacthasprosub->isNewRecord){
        echo "<h1><strong>แก้ไขเอกสารอนุมัติขอใช้งบประมาณ</strong></h1>";
    }else{
        echo "<h1><strong>เพิ่มเอกสารอนุมัติขอใช้งบประมาณ</strong></h1>";
    }
    ?>

</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">


                    <?php
                    if(!$modelcompacthasprosub->isNewRecord){
                        echo $this->render('compactbudget_form',[
                                'modelcompacthasprosub'=>$modelcompacthasprosub,'execute'=>$execute,
                            'id'=>$id,'compact'=>$compact,'manager'=>$manager,]);
                    }else{
                        echo $this->render('compactbudget_form',[
                                'modelcompacthasprosub'=>$modelcompacthasprosub,'execute'=>$execute,
                            'id'=>$id,'manager'=>$manager,]);
                    }

                    //                    echo $this->render('compactbudget_form',[
//                        'modelprosub'=>$modelprosub,
//                        'execute'=>$execute,
//                        'modelcompacthasprosub'=>$modelcompacthasprosub,
//                        'prosubbudget'=>$prosubbudget,
//                        'modelsExecute'=>$modelsExecute,
//                        'modelsExecuteCost'=>$modelsExecuteCost,
//                        'budget'=>$budget,
//                        'comhasexecute'=>$comhasexecute,
//                        'id_pro'=>$id_pro,
//                    ]);

                    ?>

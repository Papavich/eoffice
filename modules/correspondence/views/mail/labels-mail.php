<?php
use app\modules\correspondence\controllers;
use yii\helpers\Html;
use app\modules\correspondence\models\CmsInbox;
use yii\data\Pagination;

$this->title = Html::encode($this->title) . 'ป้ายกำกับ';
?>

<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<section class="content">
    <div class="content-wrapper">
        <div class="row">
            <!-- Menu mail  -->
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- Mail Header -->
                    <?= $this->render('mail_header', ['model_label' => $model_label,'pages' => $pages,
                        'searchData'=>  $searchData]) ?>
                    <!-- /.Mail Header -->
                    <!-- Mail Body -->
                    <br>
                    <div class="row tabs nomargin" style="color: black">
                        <style>
                            .box .nav-stacked > li {
                                border-bottom: 2px solid #606060;
                            }

                            ul.list-hover > li {
                                background-color: #ffffff;
                            }

                            div.tabs ul.nav-tabs li.active {
                                background-color: #c6c3c6;
                            }

                            div.tabs div.tab-content {
                                background-color: white;
                                /* border-radius: 5px;
                                 border:2px solid black;*/
                                margin-left: 10px;

                            }
                        </style>
                        <!-- tabs -->
                        <div class="col-md-2 col-sm-2 nopadding-right nopadding-left" style="border: 2px solid white;">
                            <ul class="nav nav-tabs nav-stacked list-unstyled list-hover slimscroll height-300"
                                data-slimscroll-visible="true">

                                <?php
                                foreach ($model_label as $index=>$label) {
                                    $query="";
                                    $query = CmsInbox::find()
                                        ->from(['inbox_label','cms_inbox','cms_inbox_label'])
                                        ->where(['cms_inbox.user_id' => $user->id])
                                        ->andWhere(['inbox_trash' => 0])
                                        ->andWhere(['inbox_label.label_id' => $label->inbox_label_id])
                                        ->andWhere('cms_inbox_label.inbox_label_id=inbox_label.label_id')
                                        ->andWhere('cms_inbox.inbox_id = inbox_label.inbox_id')
                                        ->count();
                                    if ($index == 0) {
                                        echo '<li class="label-name" >
                                            <a href="#tab' . $index . '" data-toggle="tab">
                                                <span class="badge  pull-right" style="background-color: #f46600" id="'.$label->inbox_label_id.'">' . $query . '</span>
                                               ' . $label->label_name . '
                                            </a>
                                        </li>';
                                    } else {
                                        echo '<li class="label-name" >
                                                <a href="#tab' . $index . '" data-toggle="tab">
                                                    <span class="badge  pull-right" style="background-color: #f46600" id="'.$label->inbox_label_id.'">' . $query . '</span>
                                                   ' . $label->label_name . '
                                                </a>
                                            </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- tabs content -->
                        <div class="col-md-10 col-sm-10 nopadding-right nopadding-left">
                            <div class="tab-content" style="color: black">
                                <?php
                                foreach ($model_label as $index => $label) {
                                    $query = CmsInbox::find()
                                        ->where(['cms_inbox.user_id' => $user->id])
                                        ->andWhere(['inbox_trash' => 0])
                                        ->andWhere(['inbox_label.label_id' => $label->inbox_label_id])
                                        ->joinWith(['inboxLabels', 'doc', 'doc.speed', 'doc.secret']);
                                    $countQuery = clone $query;
                                    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
                                    $dataProvider[$index] = new \yii\data\ActiveDataProvider([
                                        'query' => $query,
                                        'pagination' => $pages
                                    ]);

                                    if ($index == 0) {
                                        echo '<div id="tab' . $index . '" class="tab-pane active">
                                                <h4 style="color: black">' . $label->label_name . '</h4>';
                                        //content in label
                                        ?>
                                        <?= $this->render('mail_body-gridview', ['dataProvider' =>$dataProvider[$index],'gridColumns'=>$gridColumns
                                            ,'pages' => $pages]) ?>
                                        <?php echo '</div>';
                                    } else {
                                        echo '<div id="tab' . $index . '" class="tab-pane fade">
                                                <h4 style="color: black">' . $label->label_name . '</h4>';
                                        //content in label
                                        ?>
                                        <?= $this->render('mail_body-gridview', ['dataProvider' => $dataProvider[$index],'gridColumns'=>$gridColumns
                                            ,'model_label' => $model_label,'pages' => $pages]) ?>
                                        <?php echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <!-- /.Mail Body -->
                    </form>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                </div>
                <br>
                <span id="manage-labels" style="display: none">
                    <a href="#" class="btn btn-default">
                        <?= controllers::t('menu', 'Manage labels') ?>
                    </a>
                </span>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <section class="content" id="manage-labels-tab" style="display: none">
        <div class="">
            <div class="row">
                <!-- Menu mail  -->
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <table class="table table-bordered table-striped" id="manage-labels-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><?= controllers::t('menu', 'Labels') ?></th>
                                <th><?= controllers::t('menu', 'Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($model_label as $label) {
                                echo "<tr>";
                                echo "<td>" . $label['label_name'] . "</td>";
                                echo "<td>" ?>
                                <a href='#EditLabelModal' onclick='redirectDeleteRoll("<?= $label['inbox_label_id'] ?>")'
                                   class='btn btn-3d btn-xs btn-reveal btn-warning btnw label-edit'
                                   data-toggle='modal' data-whatever='@mdo'>
                                    <i class='fa fa-edit'></i>
                                    <span><?= controllers::t('menu', 'Edit') ?></span>
                                </a>
                                <a href='#' onclick='redirectDeleteRoll("<?= $label['inbox_label_id'] ?>")'
                                   class='btn btn-3d btn-xs btn-reveal btn-danger btnw confirmDeleteLabel'>
                                    <i class='fa fa-trash'></i>
                                    <span><?= controllers::t('menu', 'Delete') ?> </span></a>
                                <?php
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <br>
    <br>
</section>


<!-- /.content -->
<?= $this->render('label_form') ?>

<script>
    var pass_id;

    function redirectDeleteRoll(id) {
        pass_id = id;
    }
</script>

<!-- MODAL EDIT LABEL -->
<div class="modal fade bs-example-modal-sm" id="EditLabelModal" role="dialog" style="color: black">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
            </div>
            <div class="modal-body">
                <div class="cms-inbox-label-form">
                    <?php
                    $id = "";

                    $model_label_edit = new \app\modules\correspondence\models\CmsInboxLabel();
                    //echo isset($_SESSION['id_label']);
                    ?>
                    <div class="cms-inbox-label-form">
                        <div id="edit-label-error">
                            <span style='color: red'><?=controllers::t('menu','Label names must be unique.')?></span>
                        </div>
                        <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'mail-labels-edit-modal'], ['options' => ['enctype' => 'multipart/form-data']]); ?>

                        <?= $form->field($model_label_edit, 'inbox_label_id')
                            ->hiddenInput(['id' => 'inbox_label_id'])->label(false) ?>

                        <?= $form->field($model_label_edit, 'label_name')->textInput([
                            'id' => 'label_name', 'maxlength' => true, 'autocomplete' => 'off']) ?>
                        <?= $form->field($model_label_edit, 'user_id')
                            ->hiddenInput(['id' => 'user_id'])->label(false) ?>
                        <div class="form-group">
                            <?= \yii\helpers\Html::submitButton($model_label_edit->isNewRecord ? controllers::t('menu', 'Create')
                                : controllers::t('menu', 'Edit'), ['class' => $model_label_edit->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                                'id' => 'submitEditLabel']) ?>
                        </div>

                        <?php \yii\widgets\ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL LABEL -->


<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- Page Script -->
<?php
//$this->registerJsFile("@web/assets/plugins/bootstrap/js/bootstrap.min.js", [
//]);

$this->registerJs(<<<JS

   $('.summary').css('display','none');
   $('#example_paginate-top').remove();
        $(".confirmDeleteLabel").click(function(){
         swal({
            title: titleSwal,
            text: textSwal,
            icon: "warning",
            dangerMode: true,
            buttons: [buttonCancelSwal, buttonConfirmSwal],
        })
            .then(willDelete => {
            if(willDelete) {
              swal(successSwal, { icon: "success", button: false,});
                return   $.ajax({
                            url    : '../cms-inbox-label/delete',
                            type   : 'GET',                            
                            data   : {
                                'id' : pass_id
                            },
                            success: function (data) {
                               // $("#loading").removeClass("se-pre-con");
                               //console.log(data);
                                window.location.reload();
                            }
                        });  
                }
            }
        );
        });


JS
);
?>

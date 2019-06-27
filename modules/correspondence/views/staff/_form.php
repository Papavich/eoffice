<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\controllers;
$this->title = Html::encode($this->title) . '- ลงทะเบียนหนังสือรับ';
$date = new DateTime("now", new DateTimeZone('Asia/Bangkok'));

function add_nol($number, $add_nol)
{
    while (strlen($number) < $add_nol) {
        $number = "0" . $number;
    }
    return $number;
}

if (isset($id)) {
    $id = add_nol($id + 1, 4);
} else {
    $id = add_nol(1, 4);
}


?>

<section id="middle" style="color: black">
    <div id="content" class="padding-30">
        <div id="panel-2" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>ลงทะเบียนหนังสือรับ</strong> <!-- panel title -->
                </span>
            </div>

            <div class="panel-body">
                <!-- upload file -->
                <?php
                echo \kato\DropZone::widget([
                    'options' => [
                        'url' => 'createreceive',
                        'maxFilesize' => '2',

                    ],
                    'clientEvents' => [
                        'complete' => "function(file){console.log(file)}",
                        'removedfile' => "function(file){alert(file.name + ' is removed')}"
                    ],
                ]);
                ?>
            </div><!-- panel-body -->
        </div>
    </div>
</section>

<?php
$this->registerJs(<<<JS
$(document).ready(function(){
myDropzone.on("removedfile", function(file) {
alert(file.name + ' is removed');
});

                                var addFormGroup = function (event) {
                                    event.preventDefault();

                                    var formGroup = $(this).closest('.form-group');
                                    var multipleFormGroup = formGroup.closest('.multiple-form-group');
                                    var formGroupClone = formGroup.clone();

                                    $(this)
                                        .toggleClass('btn-default btn-add btn-danger btn-remove')
                                        .html('–');

                                    formGroupClone.find('input').val('');
                                    formGroupClone.insertAfter(formGroup);

                                    var lastFormGroupLast = multipleFormGroup.find('.form-group:last');
                                    if (multipleFormGroup.data('max') <= countFormGroup(multipleFormGroup)) {
                                        lastFormGroupLast.find('.btn-add').attr('disabled', true);
                                    }
                                };

                                var removeFormGroup = function (event) {
                                    event.preventDefault();

                                    var formGroup = $(this).closest('.form-group');
                                    var multipleFormGroup = formGroup.closest('.multiple-form-group');

                                    var lastFormGroupLast = multipleFormGroup.find('.form-group:last');
                                    if (multipleFormGroup.data('max') >= countFormGroup(multipleFormGroup)) {
                                        lastFormGroupLast.find('.btn-add').attr('disabled', false);
                                    }

                                    formGroup.remove();
                                };

                                var countFormGroup = function (form) {
                                    return form.find('.form-group').length;
                                };

                                $(document).on('click', '.btn-add', addFormGroup);
                                $(document).on('click', '.btn-remove', removeFormGroup);
                           
});
JS
);
?>





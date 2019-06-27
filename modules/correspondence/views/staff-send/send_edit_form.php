<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\fileupload\FileUploadUI;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\User;
use \app\modules\correspondence\controllers;
$this->title = Html::encode($this->title) . controllers::t('menu', 'Edit Send Book');
$date = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
\Yii::setAlias('@webword', '@web/../modules/correspondence');
function findUserId()
{
    $userid = User::find()
        ->where(['username' => Yii::$app->user->identity->username])
        ->one();
    return $userid->id;

}
$this->registerCss("
.form-group{
 margin:3px;
}
");
$docid = "";
$this->registerJsFile('@web/../modules/correspondence/style/js/input.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/send-edit.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <section id="middle" style="padding: 0px 3% 0px 3%">
        <div class="wizard" style="padding-bottom: 10px">
            <header style="margin-left: 50px">
                <h4>
                    <strong>
                        <br>
                        <?=controllers::t('menu', 'Edit Send Book')?>
                    </strong>
                </h4>
                <br>
            </header>
            <div class="container">
                <style>
                    @media only screen and (max-width: 767px) {
                        .receiveedit {
                            width: 100%;
                            padding: 6px 12px;
                        }

                        /*    .fileadd {
                                background-color: #d43f3a;
                            }*/
                    }

                    /* Medium Devices, Desktops */
                    @media only screen and (min-width: 768px) and (max-width: 1024px) {
                        .receiveedit {
                            padding-left: 15px;
                            width: 72%;
                        }

                        /* .fileadd {
                             background-color: green;
                         }
*/
                        .col1 {
                            width: 70%;
                        }

                    }

                    @media only screen and  (min-width: 1024px) {
                        .receiveedit {
                            padding-left: 15px;
                            width: 72%;
                        }

                        /* .fileadd {
                             background-color: #0a1380;
                         }*/
                        .col1 {
                            width: 500px;
                        }
                    }
                </style>
                <div class="form-horizontal">
                    <?php $form = ActiveForm::begin(['method' => 'post'], ['options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']]) ?>
                    <div class="col-sm-6 col1">
                        <div class="form-group">
                            <label class="control-label col-sm-3"><?=controllers::t('menu', 'Sending number')?> :</label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           value="<?= substr($model_roll->doc_roll_send_id, -4) ?>"
                                           disabled>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo $form->field($model_doc, 'sent_date', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ],
                            [
                                'inputOptions' => ['class' => 'form-control input-group-addon ',
                                    'style' => 'border:2px solid #d2d6de; border-radius:5px 5px 5px 5px;']
                            ])
                            ->textInput()->input('text', ['id' => 'datetimepicker2',
                                'required'])
                            ->label(controllers::t('menu', 'Sent Date'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- date book -->
                        <?php
                        echo $form->field($model_doc, 'doc_date', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ],
                            [
                                'inputOptions' => ['class' => 'form-control input-group-addon ',
                                    'style' => 'border:2px solid #d2d6de; border-radius:5px 5px 5px 5px;']
                            ])
                            ->textInput()->input('text', ['id' => 'datetimepicker3',
                                'required'])
                            ->label(controllers::t('menu', 'Doc Date'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- code book -->
                        <?php
                        echo $form->field($model_doc, 'doc_id_regist', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])->textInput()->input('text', ['placeholder' => "ศธ.0514.2.1.3/332", 'id' => 'doc_id'])
                            ->label(controllers::t('menu', 'Doc Id Regist'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- secret -->
                        <?php
                        echo $form->field($model_doc, 'secret_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(CmsDocSecret::find()->asArray()->all(), 'secret_id', 'secret_name')
                            )->label(controllers::t('menu', 'Secret ID'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- fast -->
                        <?php
                        echo $form->field($model_doc, 'speed_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocSpeed::find()->asArray()->all(), 'speed_id', 'speed_name')
                            )->label(controllers::t('menu', 'Speed ID'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- topic -->
                        <?php
                        echo $form->field($model_doc, 'doc_subject', [
                            'template' => '{label}<div class="col-sm-9"> <div class="form-group">{input}{error}{hint}</div></div>'
                        ], [
                            'inputOptions' => ['class' => 'form-control']
                        ])->textarea(['placeholder' => "รายงานการประชุมเกี่ยวกับ..."])
                            ->label(controllers::t('menu', 'Doc Subject'), ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- type -->
                        <?php
                        echo $form->field($model_doc, 'type_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocType::find()
                                    ->asArray()->all(), 'type_id', 'type_name')
                                , ['prompt' => '--- กรุณาเลือกประเภทหนังสือ ---'])
                            ->label(controllers::t('menu', 'Type ID'), ['class' => 'control-label col-sm-3']);
                        ?>
                    </div>
                    <!-- sub type -->
                    <div class="col-sm-6 col1">
                        <!-- sub type -->
                        <?php
                        echo $form->field($model_doc, 'sub_type_id', [
                            'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocSubType::find()->asArray()->all(), 'sub_type_id', 'sub_type_name')
                                , ['id' => 'subtype-id', 'prompt' => '--- กรุณาเลือหมวดหมู่หนังสือ ---'])
                            ->label(controllers::t('menu', 'Sub Type ID'), ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- money -->
                        <div class="form-group" id="money" style="display: none">
                            <?php
                            echo $form->field($model_doc, 'money', [
                                'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                            ])
                                ->textInput(['type' => 'number', 'id' => 'cms_money'])
                                ->label(controllers::t('menu', 'Money'), ['class' => 'control-label col-sm-4']);
                            ?>
                        </div>
                        <!-- address -->
                        <?php
                        echo $form->field($model_doc, 'address_id', [
                            'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->label(controllers::t('menu', 'Address ID'), ['class' => 'control-label col-sm-4'])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsAddress::find()
                                    ->where(['sub_type_id' => $model_doc->subType->sub_type_id])
                                    ->asArray()->all(), 'address_id', 'address_name')
                                , ['prompt' => '--- กรุณาเลือกสถานที่เก็บต้นฉบับ ---']);
                        ?>
                        <!-- from -->
                        <?php
                        echo $form->field($model_doc, 'doc_from', [
                            'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                        ])->textInput()->input('text', ['placeholder' => "ส่งมาจาก.."])
                            ->label(controllers::t('menu', 'Doc From'), ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- to -->
                        <div class="form-group" style="margin-bottom:15px">
                            <label class="control-label col-sm-4"><?= controllers::t('menu', 'To') ?></label>
                            <div class="col-sm-8">
                                <div class="form-group required">
                                    <input type="text" class="form-control" placeholder="คณะ/หน่วยงาน..." list="pname"
                                           id="keyword" autocomplete="off"
                                           onkeyup="send(event)"  value="<?= $model_doc->docDept->doc_dept_name ?>">
                                    <p class="help-block field-dept_id-error" style="margin-bottom: 0px; display: none;">
                                        <?= controllers::t('menu','From cannot be blank.') ?>
                                    </p>
                                </div>
                                <datalist id="pname"></datalist>
                            </div>
                        </div>
                        <!--Tel-->
                        <?php
                        echo $form->field($model_doc, 'doc_tel', [
                            'template' => '{label}<div class="col-sm-8"> <div class="form-group">{input}{error}{hint}</div></div>'
                        ], [
                            'inputOptions' => ['class' => 'form-control']])
                            ->textInput()->input('text',['placeholder' => "กรอกเบอร์โทร",'list'=>'doc_tel','onkeyup'=>'sendTel(event)',
                                'autocomplete'=>'off'])
                            ->label(controllers::t('menu', 'Doc Tel'), ['class' => 'control-label col-sm-4']);
                        ?>
                        <datalist id="doc_tel"></datalist>
                        <!-- doing -->
                        <div class="form-group">
                            <label class="control-label col-sm-4"><?=controllers::t('menu', 'Doc Roll Receive Doing')?>:</label>
                            <div class="col-sm-8">
                                <?= $form->field($model_roll, 'doc_roll_send_doing')->label(false)->error(false); ?>
                            </div>
                        </div>
                        <!-- doc ref -->
                        <div class="form-group">
                            <label class="control-label col-sm-4"><?=controllers::t('menu', 'Related Documents')?>:</label>
                            <div>
                                <?php
                                $docRef = \app\modules\correspondence\models\CmsDocRef::find()->where(['doc_id' => $model_doc->doc_id])->all();
                                if ($docRef) {
                                    foreach ($docRef as $row) {
                                        $doc = \app\modules\correspondence\models\CmsDocument::findOne($row['doc_ref']);
                                        if ($doc->cmsDocRollReceives) {
                                            echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                                                . $doc->doc_subject,
                                                \yii\helpers\Url::to('../staff-receive/detail_book?id=' . $doc->doc_id),
                                                ['target' => '_blank', 'style' => 'font-size: 16px']);
                                            ?>
                                            <a href='#' onclick='passId("<?= $row['doc_ref_id'] ?>")' class='btn btn-3d btn-xs btn-reveal btn-red
                                                         btnw confirmDeleteDocRef' style='margin-left: 10px;'>
                                                <i class='fa fa-trash'></i>
                                                <span><?=controllers::t('menu', 'Delete')?></span>
                                            </a>
                                            <?php
                                        } elseif ($doc->cmsDocRollSends) {
                                            echo Html::a("เลขที่ " . $doc->doc_id_regist . " เรื่อง "
                                                . $doc->doc_subject,
                                                \yii\helpers\Url::to('detail_book?id=' . $doc->doc_id),
                                                ['target' => '_blank', 'style' => 'font-size: 16px']);
                                            ?>
                                            <a href='#' onclick='passId("<?= $row['doc_ref_id'] ?>")' class='btn btn-3d btn-xs btn-reveal btn-red
                                                         btnw confirmDeleteDocRef' style='margin-left: 10px;'>
                                                <i class='fa fa-trash'></i>
                                                <span><?=controllers::t('menu', 'Delete')?></span>
                                            </a>
                                            <?php
                                        }
                                        echo "<br>";
                                    }
                                }

                                ?>
                            </div>
                            <div class="col-sm-8">
                                <br>
                                <a href="#docRefModal" class="btn btn-primary" style="width: 100%" id="docRefLink">
                                    <?=controllers::t('menu', 'Click to attach documentation')?>
                                </a>
                            </div>

                            <div id="docRefModalDetail" style="display: none">
                                <br><br><br>
                                <div id="panel-misc-portlet-r1" class="panel panel-default"
                                     style="border: 2px solid black; width: 100%; border-radius: 5px;
margin-left: 6%">
                                    <!-- panel content -->
                                    <div class="" style="display: block;padding: 15px; ">
                                        <label class="control-label col-sm-4"><?=controllers::t('menu', 'Doc Subject')?>:</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       placeholder="พิมพ์ชื่อเรื่องที่ต้องการอ้างอิงเพื่อค้นหา"
                                                       list="docRefList"
                                                       autocomplete="off" id="keyworddocRef"
                                                >
                                                <a class="btn btn-primary" id="searchDocRef" onclick="senddocRef(event)">
                                                    <?=controllers::t('menu', 'Search')?>
                                                </a>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-striped example">
                                            <thead>
                                            <tr>
                                                <th width="5%"><?=controllers::t('menu', 'Choose')?></th>
                                                <th><?=controllers::t('menu', 'Doc Id Regist')?></th>
                                                <th><?=controllers::t('menu', 'Doc Subject')?></th>
                                                <th><?=controllers::t('menu', 'Receive Date')?></th>
                                            </tr>
                                            </thead>
                                            <tbody id="docRefList">

                                            </tbody>
                                        </table>

                                    </div>
                                    <!-- /panel content -->

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4"><?=controllers::t('menu', 'Existing file')?>:</label>
                            <div class="col-sm-8">
                                <?php
                                $query = \app\modules\correspondence\models\CmsFile::find()
                                    ->from(['cms_doc_file', 'cms_file', 'cms_document'])
                                    ->where(
                                        "cms_doc_file.doc_id = '" . $_GET["id"] . "'")
                                    ->andWhere("cms_doc_file.doc_id = cms_document.doc_id")
                                    ->andWhere("cms_doc_file.file_id = cms_file.file_id")
                                    ->all();
                                $i = 0;
                                foreach ($query as $items) {
                                    echo Html::a($items->file_name, Url::to(Yii::getAlias('@web') . '/web_cms/uploads/'
                                        . $items->file_path . '/' . $items->file_name), ['target' => '_blank', 'style' => 'font-size: 16px']);
                                    echo "<a href=\"#\" onclick=\"redirectDeleteFile('" . $_GET['id'] . "',$items->file_id)\" class=\"btn btn-3d btn-xs btn-reveal btn-red btnw confirmDeleteFile\"
                                      style='margin-left: 10px;' >
                                            <i class=\"fa fa-trash\"></i>
                                            <span>".controllers::t('menu', 'Delete')."</span>
                                        </a>";
                                    echo "<br>";
                                    // echo $_SESSION["filename"][$i]["name"];
                                    $_SESSION["filename"][$i]["name"] = $items->file_name;
                                    $i++;

                                }
                                $_SESSION['idDocSend'] = $_GET['id'];
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <label class="control-label" style="padding-bottom: 20px;"><?=controllers::t('menu', 'Upload File')?>:</label>
                        <?php
                        $_SESSION["fileOperation"] = "update";
                        $file1 = \app\modules\correspondence\models\CmsFile::find()
                            ->from(['cms_file', 'cms_doc_file'])
                            ->where("cms_doc_file.file_id = cms_file.file_id AND cms_doc_file.doc_id = '" . $_GET['id'] . "'")
                            ->one();
                        echo FileUploadUI::widget([
                            'model' => $model_file,
                            'attribute' => 'file',
                            'url' => ['file/update-file', 'docid' => $_GET['id']],
                            'gallery' => false,
                            'fieldOptions' => [
                                'accept' => '/*',
                            ],
                            'clientOptions' => [
                                'maxFileSize' => 2000000,
                                'maxFiles' => 4,
                                'autoUpload' => true
                            ],
                            // ...
                            'clientEvents' => [
                                'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                                
                            }',
                                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);                                                        
                            }',

                            ],
                        ]);

                        ?>
                    </div>
                    <div id="hidden-input">
                        <input type="hidden" id="updateId" value="<?= $_GET['id'] ?>">
                        <input type="hidden" id="oldDept" value="<?= $model_doc->docDept->doc_dept_name ?>">
                        <?= $form->field($model_doc, 'doc_dept_id')->hiddenInput(['id' => 'dept_id'])->label(false); ?>

                        <?= $form->field($model_doc, 'receive_date')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_doc, 'user_id')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_doc, 'check_id')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_doc, 'doc_expire')->hiddenInput()->label(false); ?>

                        <?= $form->field($model_roll, 'doc_roll_send_id')->hiddenInput()->label(false)
                            ->error(false); ?>
                        <?= $form->field($model_doc, 'doc_ref')->hiddenInput(['id' => 'docRef'])->label(false); ?>
                    </div>
                    <div class="col-md-12" style="padding-bottom:30px;clear: both">
                        <button type="submit" class="btn btn-success btn-lg next-step" id="saveEditSend">
                            <?=controllers::t('menu', 'Save')?>
                        </button>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
                <!-- **************************** End Form *********************************************** -->
                <div class="clearfix"></div>

            </div>
        </div>
    </section>
    <script>
        //pass parameter to delete document in ajax
        var pass_iddoc, pass_file, pass_ref;

        function redirectDeleteFile(iddoc, idfile) {
            pass_iddoc = iddoc;
            pass_file = idfile;

        }

        function passId(idref) {
            pass_ref = idref;
        }

        var xmlHttp;

        function send(event) {
            xmlHttp = new XMLHttpRequest();
            var keyword = document.getElementById("keyword").value;

            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {  //  �������顴�١��ŧ
                var url = "search?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListDept;
                xmlHttp.send();
            }
        }

        function showListDept() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("pname").innerHTML = xmlHttp.responseText;
            }
        }

        function senddocRef(event) {
            xmlHttp = new XMLHttpRequest();
            var keyword = document.getElementById("keyworddocRef").value;
            console.log(keyword);
            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {  //  �������顴�١��ŧ
                var url = "search-doc-ref?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListRef;
                xmlHttp.send();
            }
        }

        function showListRef() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("docRefList").innerHTML = xmlHttp.responseText;
            }
        }
        function showListTel() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("doc_tel").innerHTML = xmlHttp.responseText;
            }
        }
        function sendTel(event) {
            xmlHttp = new XMLHttpRequest();
            let keyword = document.getElementById("cmsdocument-doc_tel").value;

            if (event.keyCode == 13) {  // ��ҡ� Enter
                // document.location = "productDetail2.php?pname=" + keyword;

            } else if (event.keyCode != 40) {
                let url = "search-tel?keyword=" + keyword;
                xmlHttp.open("GET", url);
                xmlHttp.onreadystatechange = showListTel;
                xmlHttp.send();
            }
        }
    </script>
<?php
/** @var TYPE_NAME $docid */
$this->registerJs(<<<JS
    $(".confirmDeleteFile").click(function () {
        swal({
            title: titleSwal,
            text: textSwal,
            icon: "warning",
            dangerMode: true,
            buttons: [buttonCancelSwal, buttonConfirmSwal],
        })
            .then(willDelete=> {
            if(willDelete) {
                swal(successSwal, { icon: "success", button: false,});
               return $.ajax({
                   url: '../file/delete-file-in-db',
                   type: 'get',
                   data: {
                       'iddoc': pass_iddoc,
                       'idfile': pass_file
                   },
                   success: function (data) {
                       window.setTimeout(function () {
                           window.location.reload();
                       }, 500);
                   }
               });
            }

        }
    );
    });
    $(".confirmDeleteDocRef").click(function () {
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
                return $.ajax({
                    url: 'delete-doc-ref',
                    type: 'post',
                    data: {
                        'idref': pass_ref,
                    },
                    success: function (data) {
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    }

                    });
                }
            }
        );
    });
JS
);
?>
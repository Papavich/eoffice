<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\fileupload\FileUploadUI;
use app\modules\correspondence\models\CmsDocSecret;
use app\modules\correspondence\models\User;
use yii\bootstrap\ActiveForm;
use app\modules\correspondence\controllers;

use app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisMajor;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisBoardOfDirectors;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */
$this->title = Html::encode($this->title) . controllers::t('menu', 'Add Received Book');
$date = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
date_default_timezone_set("Asia/Bangkok");
$this->registerCss("
.form-group{
 margin:5px;
}
");
function findUserId()
{
    $userid = User::find()
        ->where(['username' => Yii::$app->user->identity->username])
        ->one();
    return $userid->id;

}

// generate doc_roll_id key
// add_nol(last id of doc_roll_id, size of id)
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
$docid = "";
$this->registerJsFile('@web/../modules/correspondence/style/js/input.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/receive.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/contract-list.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/mail.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('@web/../modules/correspondence/style/js/api.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<section id="middle" style="padding: 0px 3% 0px 3%">
    <div class="wizard" style="padding-bottom: 10px">
        <div align="center" id="receive-text">
            <?= controllers::t('menu', 'Add Received Book') ?>
        </div>
        <!-- ************************************process step ******************************************* -->
        <div class="wizard-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active" style="margin: 0 10% 0 10%">
                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                       title=" <?= controllers::t('menu', 'Add Received Book') ?>">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-close"></i>
                            </span>
                    </a>
                </li>
                <li role="presentation" class="disabled" style="margin-right: 10%">
                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                       title="อัพโหลดไฟล์">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-save-file"></i>
                            </span>
                    </a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab"
                       title="<?= controllers::t('menu', 'Send to') ?>">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon glyphicon-send"></i>
                            </span>
                    </a>
                </li>
            </ul>
        </div>

        <div id="container-receive">
            <div class="tab-content">
                <!-- ************************************ STEP 1 ******************************************* -->
                <div class="tab-pane active form-horizontal" role="tabpanel" id="step1">
                    <h4><?= controllers::t('menu', 'Add Received Book') ?></h4>
                    <?php $form = ActiveForm::begin(
                        [   'method' => 'post',
                            'options' => [
                                'class' => 'form-horizontal',
                                'autocomplete' => 'off',
                                'enctype' => 'multipart/form-data'
                            ]
                        ]) ?>
                    <div class="col-lg-6">
                        <!-- secret -->
                        <?php
                        echo $form->field($model_doc, 'secret_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(CmsDocSecret::find()->asArray()->all(), 'secret_id', 'secret_name')
                            )->label($model_doc->secret_id, ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- fast -->
                        <?php
                        echo $form->field($model_doc, 'speed_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocSpeed::find()->asArray()->all(), 'speed_id', 'speed_name')
                            )->label($model_doc->speed_id, ['class' => 'control-label col-sm-3']);
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
                            ->label($model_doc->type_id, ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- sub type -->
                        <?php
                        echo $form->field($model_doc, 'sub_type_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->dropDownList(
                                \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocSubType::find()
                                    ->asArray()->all(), 'sub_type_id', 'sub_type_name')
                                , ['id' => 'subtype-id', 'prompt' => '--- กรุณาเลือหมวดหมู่หนังสือ ---'])
                            ->label($model_doc->sub_type_id, ['class' => 'control-label col-sm-3']);
                        ?>
                        <!-- money -->
                        <div class="form-group" id="money" style="display: none">
                            <?php
                            echo $form->field($model_doc, 'money', [
                                'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                            ])
                                ->textInput(['type' => 'number', 'value' => 0])
                                ->label($model_doc->money, ['class' => 'control-label col-sm-3']);
                            ?>
                        </div>
                        <!-- address -->
                        <?php
                        echo $form->field($model_doc, 'address_id', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ])
                            ->label(controllers::t('menu', 'Address ID'), ['class' => 'control-label col-sm-3'])
                            ->widget(\kartik\depdrop\DepDrop::className(), [
                                'data' => [],
                                'pluginOptions' => [
                                    'depends' => ['subtype-id'],
                                    'placeholder' => '--- กรุณาเลือกสถานที่เก็บต้นฉบับ ---',
                                    'url' => Url::to(['address/get-address'])
                                ],
                            ]);
                        ?>
                        <div class="form-group" style="margin-bottom:15px">
                            <label class="control-label col-sm-3"><?= controllers::t('menu', 'Registration number') ?></label>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?= $id ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- date book -->
                        <?php
                        echo $form->field($model_doc, 'doc_date', [
                            'template' => '{label}<div class="col-sm-9"><div class="form-group">{input}{error}</div></div>'
                        ],
                            [
                                'inputOptions' => ['class' => 'form-control input-group-addon ',
                                    'style' => 'border:2px solid #d2d6de; border-radius:5px 5px 5px 5px;']
                            ])
                            ->textInput()->input('text', ['id' => 'datetimepickerrecevie', 'value' => $date->format('Y-m-d H:i:s'),
                                'required'])
                            ->label($model_doc->doc_date, ['class' => 'control-label col-sm-3']);
                        ?>
                    </div>

                    <!-- type -->
                    <div class="col-lg-6">
                        <!-- from -->
                        <div class="form-group" style="">
                            <label class="control-label col-sm-4"><?= controllers::t('menu', 'Doc From') ?></label>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="คณะ/หน่วยงาน..." list="pname"
                                           id="keyword" autocomplete="off"
                                           onkeyup="send(event)">
                                    <p class="help-block field-dept_id-error"
                                       style="margin-bottom: 0px; display: none;">
                                        <?= controllers::t('menu', 'From cannot be blank.') ?>
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
                            ->textInput()->input('text', ['placeholder' => "กรอกเบอร์โทร", 'list' => 'doc_tel', 'onkeyup' => 'sendTel(event)',
                                'autocomplete' => 'off'])
                            ->label($model_doc->doc_tel, ['class' => 'control-label col-sm-4']);
                        ?>
                        <datalist id="doc_tel"></datalist>
                        <!-- code book -->
                        <?php
                        echo $form->field($model_doc, 'doc_id_regist', [
                            'template' => '{label}<div class="col-sm-8"><div class="form-group">{input}{error}</div></div>'
                        ])->textInput()->input('text', ['placeholder' => "ศธ.0514.2.1.3/332", 'id' => 'doc_id'])
                            ->label($model_doc->doc_id_regist, ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- topic -->
                        <?php
                        echo $form->field($model_doc, 'doc_subject', [
                            'template' => '{label}<div class="col-sm-8"> <div class="form-group">{input}{error}{hint}</div></div>'
                        ], [
                            'inputOptions' => ['class' => 'form-control']
                        ])->textarea(['placeholder' => "รายงานการประชุมเกี่ยวกับ..."])
                            ->label($model_doc->doc_subject, ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- doing -->
                        <?php
                        echo $form->field($model_roll, 'doc_roll_receive_doing', [
                            'template' => '{label}<div class="col-sm-8"> <div class="form-group">{input}{error}{hint}</div></div>'
                        ])
                            ->label($model_roll->doc_roll_receive_doing, ['class' => 'control-label col-sm-4']);
                        ?>
                        <!-- doc ref -->
                        <div class="form-group">
                            <label class="control-label col-sm-4"><?= controllers::t('menu', 'Related Documents') ?>
                                :</label>
                            <div class="col-sm-8">
                                <a href="#docRefModal" class="btn btn-primary" style="width: 100%" id="docRefLink">
                                    <?= controllers::t('menu', 'Click to attach documentation') ?>
                                </a>
                            </div>
                            <div id="docRefModalDetail" style="display: none">
                                <br><br><br>
                                <div id="panel-misc-portlet-r1" class="panel panel-default"
                                     style="border: 2px solid black; width: 100%; border-radius: 5px;
margin-left: 6%">
                                    <!-- panel content -->
                                    <div class="" style="display: block;padding: 15px; ">
                                        <label class="control-label col-sm-4"><?= controllers::t('menu', 'Doc Subject') ?>
                                            :</label>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                       placeholder="พิมพ์ชื่อเรื่องที่ต้องการอ้างอิงเพื่อค้นหา"
                                                       list="docRefList"
                                                       autocomplete="off" id="keyworddocRef"
                                                >
                                                <a class="btn btn-primary" id="searchDocRef"
                                                   onclick="senddocRef(event)">
                                                    <?= controllers::t('menu', 'Search') ?>
                                                </a>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-striped example">
                                            <thead>
                                            <tr>
                                                <th width="5%"><?= controllers::t('menu', 'Choose') ?></th>
                                                <th><?= controllers::t('menu', 'Doc Id Regist') ?></th>
                                                <th><?= controllers::t('menu', 'Doc Subject') ?></th>
                                                <th><?= controllers::t('menu', 'Receive Date') ?></th>
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
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-6"><?= controllers::t('menu', 'Want to approve the head of the sector') ?>
                                :</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" name="approve" id="approve" class="approve" value="3">
                                    <i></i> <?= controllers::t('menu', 'Yes') ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="approve" id="not-approve" class="approve" value="1"
                                           checked>
                                    <i></i><?= controllers::t('menu', 'No') ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div align="right">
                        <button type="submit"
                                class="btn btn-success  next-step"><?= controllers::t('menu', 'Upload File') ?></button>
                    </div>
                    <div id="hidden-input">
                        <?php
                        $docReceiveId = 'DID' . date("YmdHis") . gettimeofday()["usec"];
                        ?>
                        <?= $form->field($model_doc, 'doc_id')->hiddenInput(['value' => $docReceiveId])->label(false); ?>
                        <?= $form->field($model_doc, 'sent_date')->hiddenInput(['value' => '0000-00-00 00:00:00'])->label(false); ?>
                        <?= $form->field($model_doc, 'user_id')->hiddenInput(['value' => findUserId()])->label(false); ?>
                        <?= $form->field($model_doc, 'check_id')->hiddenInput(['id' => 'checkId'])->label(false); ?>
                        <?= $form->field($model_doc, 'receive_date')->hiddenInput(['value' => $date->format('Y-m-d H:i:s')])->label(false); ?>
                        <?= $form->field($model_doc, 'doc_expire')->hiddenInput(['id' => 'docExpire'])->label(false); ?>
                        <?= $form->field($model_doc, 'doc_dept_id')->hiddenInput(['id' => 'dept_id'])->label(false); ?>
                        <?= $form->field($model_doc, 'doc_from')->hiddenInput(['value' => 'no'])->label(false)->error(false); ?>
                        <?= $form->field($model_doc, 'doc_ref')->hiddenInput()->label(false); ?>

                        <?php
                        $_SESSION['doc_roll_receive_id'] = date("Y") . $id;

                        ?>
                        <input type="hidden" id="cmsdocrollreceive-doc_roll_receive_id"
                               value="<?= $_SESSION['doc_roll_receive_id'] ?>">
                    </div>
                    <?php ActiveForm::end() ?>

                    <!-- **************************** End Form *********************************************** -->
                </div>
                <!-- *************************** STEP 2 ****************************************** -->
                <div class="tab-pane form-horizontal" role="tabpanel" id="step2">
                    <h4>อัพโหลดไฟล์</h4>
                    <!-- upload file-->
                    <div style="font-size: 16px">
                        <b>ชื่อเรื่อง:</b> <span id="subjectInUploadFile"></span><br>
                        <b>ประเภทหนังสือ:</b> <span id="typeInUploadFile"></span>
                    </div>
                    <div class="form-group multiple-form-group"><br>
                        <div class="col-sm-10">
                            <br>
                            <?= FileUploadUI::widget([
                                'model' => $model_file,
                                'attribute' => 'file',
                                'url' => ['file/upload-file', 'type' => 'receive', 'id' => $docReceiveId],
                                'gallery' => false,
                                'fieldOptions' => [
                                    'accept' => '/*'
                                ],
                                'clientOptions' => [
                                    'maxFileSize' => 2000000,
                                    'maxFiles' => 4,
                                    'autoUpload' => true
                                ],
                            ]);
                            $_SESSION["fileOperation"] = "insert";
                            ?>
                            <div style="display: inline;float: right">
                                <button type="button"
                                        class="btn  btn-default  prev-step"><?= controllers::t('menu', 'Back') ?></button>
                                <button type="button" class="btn btn-success  next-step2"
                                        id="next_tab2"><?= controllers::t('menu', 'Next') ?></button>
                            </div>

                        </div>
                    </div>


                </div>
                <!-- *************************** complete ****************************************** -->
                <div class="tab-pane form-horizontal" role="tabpanel" id="complete">
                    <h4><?= controllers::t('menu', 'Send to') ?></h4>
                    <div class="form-group multiple-form-group">
                        <div class="col-sm-12">
                            <form method='post' id='form_mail'>
                                <div class="form-group">
                                    <label style="float: left;clear: left; margin: auto; margin-right: 5px;"
                                           class="checkbox-inline">
                                        <input type="checkbox" value="" name="" id="allContract"><b>เลือกทั้งหมด</b>
                                    </label><br>
                                    <label style="float: left;clear: left; margin: auto; margin-right: 5px;"
                                           class="checkbox-inline">
                                        <input type="checkbox" value="" name="" id="ceo" class="checkedAll"><b>คณะผู้บริหาร</b>
                                    </label><br>
                                    <label style="float: left;margin: auto; margin-right: 2%;"
                                           class="checkbox-inline">
                                        <input type="checkbox" value="" name="" id="cs" class="checkedAll"><b>คณาจารย์ประจำสาขาวิชาวิทยาการคอม﻿พิวเตอร์</b>
                                    </label><br>
                                    <label style="float: left; margin: auto; margin-right: 2%;"
                                           class="checkbox-inline">
                                        <input type="checkbox" value="" name="" id="ict" class="checkedAll"><b>คณาจารย์ประจำสาขาวิชาเทคโนโลยีสารสนเทศ</b>
                                    </label><br>
                                    <label style="float: left;margin: auto ;margin-right: 2%;"
                                           class="checkbox-inline">
                                        <input type="checkbox" value="" name="" id="gis" class="checkedAll"><b>คณาจารย์ประจำสาขาวิชาภูมิสารสนเทศศาสตร์</b>
                                    </label><br>
                                    <label style="float: left;margin: auto ;margin-right: 2%;"
                                           class="checkbox-inline">
                                        <input type="checkbox" value="" name="" id="staff" class="checkedAll"><b>เจ้าหน้าที่ภายในภาควิชา</b>
                                    </label><br>
                                    <br><br>
                                    <div class="col-md-7 col-xs-7 col-sm-7"
                                         style=" border: 2px solid #1c2b36; padding: 2%; border-radius: 5px ">
                                        <!-- contract box -->
                                        <div id="contarct-box">
                                            <input type='checkbox' name='checkAllCEO' id='checkAll2'><span
                                                    id="check3">เลือกทั้งหมด</span><br><br>
                                            <div id="listOfCEO">
                                                <?php
                                                //TODO ดึงข้อมูลจริงมาจากระบบกลาง
                                                /*                                                            $leader = \app\modules\correspondence\models\User::findOne(9);
                                                                                                            echo '1<input type="checkbox" name="list_mail[]" value="' . $leader->id . '"   class="listceo" />
                                                                                                        ' . $leader->prefix_th . $leader->fname . " " . $leader->lname .
                                                                                                                ' <b>(' . $leader->person_position . ')</b>' . '<br>';*/
                                                foreach ($receiver as $rows):
                                                    if ($rows->boardDirector) {
                                                        if ($rows->boardDirector->position_name == "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์"
                                                            && $rows->boardDirector->period_describe == "สมัยปัจจุบัน") {
                                                            echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listceo" />
                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname .
                                                                ' <b>(' . $rows->boardDirector->position_name . ')</b>' . '<br>';
                                                            break;
                                                        }
                                                    }
                                                endforeach;
                                                foreach ($receiver as $rows):
                                                    if ($rows->boardDirector) {
                                                        if ($rows->boardDirector->position_name != "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์") {
                                                            echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listceo" />
                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname .
                                                                ' <b>(' . $rows->boardDirector->position_name . ')</b>' . '<br>';
                                                        }
                                                    }

                                                    ?>
                                                <?php endforeach; ?>

                                            </div>
                                            <div id="listOfCS">
                                                <?php
                                                foreach ($receiver as $rows):
                                                    if (!$rows->boardDirector && $rows->major) {
                                                        if ($rows->major->code == "CS")
                                                            echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listcs" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                    }
                                                    ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <div id="listOfICT">
                                                <?php
                                                foreach ($receiver as $rows):
                                                    if (!$rows->boardDirector && $rows->major) {
                                                        if ($rows->major->code == "IT")
                                                            echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listict" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                    } else {
                                                        if ($rows->boardDirector) {
                                                            if ($rows->boardDirector->position_name == "หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์" && $rows->boardDirector->period_describe != "สมัยปัจจุบัน"
                                                                && $rows->major) {
                                                                if ($rows->major->code == "IT")
                                                                    echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listict" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                            }

                                                        }
                                                    }
                                                    ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <div id="listOfGIS">
                                                <?php
                                                foreach ($receiver as $rows):
                                                    if (!$rows->boardDirector && $rows->major) {
                                                        if ($rows->major->code == "GIS")
                                                            echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="listgis" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname . '<br>';
                                                    }
                                                    ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <div id="listOfStaff">
                                                <?php
                                                foreach ($receiver as $rows):
                                                    if (!$rows->boardDirector && !$rows->major) {
                                                        echo '<input type="checkbox" name="list_mail[]" value="' . $rows->person_id . '"   class="liststaff" />
                                                                        ' . $rows->PREFIXNAME . $rows->person_name . " " . $rows->person_surname .
                                                            ' <b>(' . $rows->person_position_staff . ')</b>' . '<br>';
                                                    }
                                                    ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <br>
                                        </div>
                                        <!-- /contract box -->
                                    </div>
                                </div>
                                <div style="display: inline;float: right ">
                                    <button type="button"
                                            class="btn btn-default prev-step"><?= controllers::t('menu', 'Back') ?></button>
                                    <button type="submit" class="btn btn-success"
                                            id="saveReceiveButton"><?= controllers::t('menu', 'Save') ?>
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="loading">
                    <span id="loading-content" style="font-size: 22px;  position: absolute; top: 500px; left: 525px">

                    </span>
        </div>
    </div>
    </div>
    </div>
</section>
<script>
    var dateExpixe1, dateExpixe2;
    dateExpixe1 = "<?= date('Y') + 5 . '-' . date('m-d H:i:s');?>";
    dateExpixe2 = "<?= date('Y') + 10 . '-' . date('m-d H:i:s');?>";
    var xmlHttp;

    function send(event) {
        xmlHttp = new XMLHttpRequest();
        var keyword = document.getElementById("keyword").value;

        if (event.keyCode == 13) {  // ��ҡ� Enter
            // document.location = "productDetail2.php?pname=" + keyword;

        } else if (event.keyCode != 40) {
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
        //console.log(keyword);
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
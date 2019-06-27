<?php

use app\modules\correspondence\controllers;


?>
<!-- SEARCH FORM -->
<div class="row" style="margin-left: 5%;margin-right:3%">
    <div class="form-inline">
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => [$url . (isset($_GET['id']) && $_GET['id'] != "" ? $_GET['id'] : '')],
            'method' => 'get',
            'options' => [
                'class' => '',
                'style' => ''
            ],
        ]); ?>
        <div class="form-group">
            <label><?= controllers::t('menu', 'Search') ?> : </label>
            <input type="text" style="width: 400px"
                   name="keyword"
                   class="form-control" placeholder="กรอกสิ่งที่ต้องการค้นหา...."
                   id="nameForSearch" title="กรอกสิ่งที่ต้องการค้นหา"
                   value="<?php echo $searchData["keyword"] ?>">
        </div>
        <!--<div class="form-group">
            <label>ระหว่างวันที่:</label>
            <input type="text" class="form-control rangepicker" style="width: 600px"
                   data-format="yyyy-mm-dd"
                   id="dateRange" name="range-date"
                   autocomplete="off" value="<?php /*echo $searchData["range-date"] */?>">
        </div>-->
        <div class="form-group">
            <label style="margin-top: 7px; padding: 5px;">
                <?=controllers::t('menu','Date range')?>:</label>
            <?php
            // DateRangePicker in a dropdown format (uneditable/hidden input) and uses the preset dropdown.
            echo \kartik\daterange\DateRangePicker::widget([
                'name' => 'range-date',
                'value' => ($searchData["range-date"] == "" ? "" : $searchData["range-date"] ),
                'presetDropdown' => true,
                'pluginOptions' => [
                    'showDropdowns' => true,
                ],
            ]);
            ?>
        </div>
        <div style="padding: 10px 0 10px 0; margin-top: 5px" class="row">
           <div class="col-md-1" style="padding: 0px">
                <label><?= controllers::t('menu','Document type') ?> :  </label>
            </div>
            <div class="col-md-9" style="padding: 0px">
                <?php echo \kartik\select2\Select2::widget([
                    'name' => 'type',
                    'value' => $searchData["type"],
                    'data' => \yii\helpers\ArrayHelper::map(\app\modules\correspondence\models\CmsDocType::find()->all(), 'type_id', 'type_name'),
                    'options' => ['multiple' => true,
                        'title'=>controllers::t('menu','Document type')
                        ,'placeholder'=>controllers::t('menu','Document type')]
                ]);
                ?>
                <i class="fancy-arrow-"></i>
            </div>
            <!--            <select id="doc-type" class="form-control select2-hidden-accessible" name="type[]" multiple="" size="4"
                    data-s2-options="s2options_c4acac00" data-krajee-select2="select2_2ad88ba1"
                    tabindex="-1" aria-hidden="true">
                <option value="">--- กรุณาเลือกประเภทหนังสือ ---</option>
                <?php
            /*                $type = \app\modules\correspondence\models\CmsDocType::find()->all();
                            foreach ($type as $item) {
                                echo "<option value='" . $item['type_id'] . "'>" . $item['type_name'] . "</option>";
                            }
                            */?>
            </select>-->
        </div>

        <div style="float:right;padding: 10px 35px 0 0">
            <label style="padding-left: 0px;"
                   class="checkbox-inline"><input type="radio" value="searchByType"
                                                  name="search_by"
                    <?php if ("searchByType" == $searchData["search_by"]) echo 'checked'; ?>>
               <?=controllers::t('menu', 'Search by book type')?>
            </label>
            <label style="padding-left: 5px;"
                   class="checkbox-inline"><input type="radio" value="searchById"
                                                  name="search_by" id="searchById"
                    <?php if ("searchById" == $searchData["search_by"]) echo 'checked'; ?>>
                <?=controllers::t('menu', 'Search by book number')?>
            </label>
            <label style="padding-left: 5px;"
                   class="checkbox-inline"><input type="radio"
                                                  value="searchBySubject"
                                                  name="search_by"
                                                  id="searchBySubject"
                    <?php if ("searchBySubject" == $searchData["search_by"]) echo 'checked'; ?>>
                <?=controllers::t('menu', 'Search by subject')?>
            </label>

            <?= \yii\helpers\Html::submitButton(controllers::t('menu', 'Search')
                , ['class' => 'btn btn-lg btn-success', 'style' => '']) ?>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /SEARCH FORM -->
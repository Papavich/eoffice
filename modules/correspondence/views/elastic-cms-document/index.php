<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\correspondence\models\ElasticCmsDocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Elastic Cms Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elastic-cms-document-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Elastic Cms Document', ['create'], ['class' => 'btn btn-success']) ?>
    </p><?php $form = \yii\widgets\ActiveForm::begin( ['id' => 'search-form', 'method' => 'get', 'action' => 'index'] ); ?>
    <fieldset>
        <div class="row">
            <div class="form-group">
                <div class="col-md-3 col-sm-3">
                    <label></label>
                    <select name="search_by" class="form-control pointer">
                        <option value="1" <?php if (1 == $searchData["search_by"]) echo 'selected'; ?>>1</option>
                        <option value="2" <?php if (2 == $searchData["search_by"]) echo 'selected'; ?>>2</option>
                        <option value="3" <?php if (3 == $searchData["search_by"]) echo 'selected'; ?>>3</option>
                    </select>
                </div>
                <div class="col-md-9 col-sm-9">
                    <label>****</label>
                    <input type="text" name="keyword" class="form-control"
                           value="<?php echo $searchData["keyword"] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-6 col-sm-6">
                    <label>777</label>
                    <select name="branch" class="form-control pointer">


                        <option value="0"></option>
                        <?php foreach (\app\modules\correspondence\models\CmsDocType::find()->all() as $item) { ?>
                            <option value="<?= $item->type_id ?>" <?php if ($item->type_id == $searchData["branch"]) echo 'selected'; ?>>
                                <?php
                                    echo $item->type_name;
                                ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-3d btn-teal pull-right"><i
                    class="fa fa-search">phon
        </button>
    </fieldset>
    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

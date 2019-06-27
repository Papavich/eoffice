<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 6/8/2560
 * Time: 18:56
 */
use app\modules\eoffice_ta\models\TaNews;
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\controllers;

?>
<?php
$main_title = controllers::t('label','News');
$title = controllers::t('label','News Detail');
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => $main_title, 'url' => ['site/index']];
$this->params['breadcrumbs'][] = $title;
?>

<div class="ta-news-detail">

    <!--content news -->

            <div class="panel-body">
        <div class="row">
            <div class="col-md-9">
                <div id="panel-misc-portlet-l1" >
                    <header id="page-header">
                        <h1><?=$model->ta_news_name ?></h1>

                    </header>
                <!-- Image News-->
                    <div class="panel-body">
                  <div>
                      <center>
                      <?= Html::img($model->photoViewer,['class'=>'img-thumbnail','style'=>'max-width:400px;'])?>
                      </center>
                  </div>
                        <br>
                        <div>
                            <?php
                            $images = $model->ta_news_imgs? @explode(',',$model->ta_news_imgs) : [];
                            $img = '';
                            foreach ($images as $image){
                                echo $img.=' '.Html::img(Yii::getAlias('@web').'/web_ta/images/upload/'
                                        .$image,['class'=>'img-thumbnail','style'=>'max-width:200px;']);
                                ?>
                            <?php }?>
                        </div>
                <!-- Image News-->
                        <hr />
                        <p>
                            <span class="text-black size-15">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$model->ta_news_detail?></span>
                        </p>

                    </div>
                    <span class=" pull-right">
                          <a class="size-13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-time"></i><?= Yii::$app->formatter->format($model->crtime, 'relativeTime') ?></a>
                        </span>
                        <hr/>
                        <div class="tab-content">

                            <!-- Overview -->
                            <div id="overview" class="tab-pane active">
                            <!-- COMMENT -->
                        <ul class="comment list-unstyled">
                            <li class="comment">

                            <li class="comment comment-reply">

                            <!-- avatar -->
                            <img class="avatar" src="assets/images/demo/thumb/small2.jpg" width="35" height="35" alt="avatar" />

                            <!-- comment body -->
                            <div class="comment-body">
                                <a href="#" class="comment-author">
                                    <small class="text-muted pull-right"> a moment ago </small>
                                    <span>Simona Doe</span>
                                </a>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy! <i class="fa fa-smile-o green"></i>
                                </p>
                            </div><!-- /comment body -->

                            <!-- options -->
                            <ul class="list-inline size-11">
                                <li>
                                    <a href="#" class="text-success"><i class="fa fa-thumbs-up"></i> Like</a>
                                </li>
                                <li class="pull-right">
                                    <a href="#" class="text-danger">Delete</a>
                                </li>
                                <li class="pull-right">
                                    <a href="#" class="text-primary">Edit</a>
                                </li>
                                <hr/>
                                <li>
                                    <div class="input-group">
                                        <input id="btn-input" type="text" class="form-control" placeholder="Type your message...">
                                        <span class="input-group-btn">
															<button class="btn btn-primary" id="btn-chat">
																<i class="fa fa-reply"></i> Reply
															</button>
														</span>
                                    </div>
                                </li>
                            </ul><!-- /options -->
                        </ul>
                           </div></div>
                </div></div>
            <div class="col-md-3">
                <!-- projects -->
                <section class="panel panel-default">
                    <header class="panel-heading">
                        <h2 class="panel-title elipsis">
                            <i class="glyphicon glyphicon-briefcase"></i>&nbsp;&nbsp;ข้อมูล
                        </h2>
                    </header>
                    <div class="panel-body noradius padding-10">
                            <ul class="portfolio-detail-list list-unstyled nomargin">
                                <li><span><i class="fa fa-user"></i>&nbsp;&nbsp;ผู้ประกาศ:</span><?= $model->crby?></li>
                                <li><span><i class="fa fa-calendar"></i>&nbsp;&nbsp;ประกาศเมื่อ:</span> <?= Yii::$app->formatter->format($model->crtime, 'relativeTime') ?></li>

                            </ul>
                    </div>
                </section>
            </div>
        </div>
            </div>
        </div>
    </div>

    <!-- content news-->


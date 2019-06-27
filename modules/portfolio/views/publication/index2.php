<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\PublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\modules\portfolio\models\Publication */

$this->title = 'Publications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Publication', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <section id="middle">


        <!-- page title -->
        <header id="page-header">
            <h1>ผลงานตีพิมพ์</h1>
            <ol class="breadcrumb">
                <li><a href="#">ผลงานตีพิมพ์</a></li>
                <li class="active"></li>
            </ol>
        </header>
        <!-- /page title -->

        <div id="content" class="padding-20">



            <div id="panel-1" class="panel panel-default">

                <div class="panel-heading">
							<span class="title elipsis">
								<strong></strong> <!-- panel title -->
							</span>

                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                        <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
                    </ul>
                    <!-- /right options -->

                </div>

                <!-- panel content -->
                <div class="panel-body">

                    <center>	<!-- Large Modal -->
                        <a href="#" class="btn btn-3d btn-reveal btn-blue" data-toggle="modal" data-target="#modal1"><i class="fa fa-university"></i><span>เพิ่มผลงานตีพิมพ์</span></a>
                        <a href="add-type-public.html" class="btn btn-3d btn-reveal btn-blue"><i class="fa fa-university"></i><span>เพิ่มประเภทผลงานตีพิมพ์</span></a>

                        <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- header modal -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel">แก้ไขผลงานตีพิมพ์</h4>
                                    </div>

                                    <!-- body modal -->
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-heading panel-heading-transparent">
                                                <strong>International Journal</strong>
                                            </div>

                                            <div class="panel-body">

                                                <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                    <fieldset>
                                                        <!-- required [php action request] -->
                                                        <input type="hidden" name="action" value="contact_send" />

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ภาษาที่แสดงผล</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="eng">ภาษาอังกฤษ</option>
                                                                        <option value="thai">ภาษาไทย</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่อบทความ(ไทย)</label>
                                                                    <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ชื่ออบทความ(อังกฤษ)</label>
                                                                    <input type="text" name="contact[last_name]" value="" class="form-control2 required">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ระดับการเผยแพร่</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- เลือก ---</option>
                                                                        <option value="Marketing">ระดับชาติ</option>
                                                                        <option value="Developer">ระดับนานาชาติ</option>

                                                                    </select>
                                                                </div>

                                                                <div class="col-md-4 col-sm-8">


                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-8">
                                                                <label>ประเภทวารสาร</label>
                                                                <select name="contact[position]" class="form-control2 pointer required">
                                                                    <option value="">--- เลือก ---</option>
                                                                    <option value="Marketing">PR &amp; Marketing</option>
                                                                    <option value="Developer">Web Developer</option>
                                                                    <option value="php">PHP Programmer</option>
                                                                    <option value="Javascript">Javascript Programmer</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>เดือน และ วันที่</label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 datepicker required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ปี พ.ศ. ที่พิมพ์</label>
                                                                    <select name="contact[position]" class="form-control2 pointer required">
                                                                        <option value="">--- Select ---</option>
                                                                        <option value="Marketing">2017</option>
                                                                        <option value="Developer">2016</option>

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>จำนวนปี</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ฉบับที่ </label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2  required" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>เมือง</label>
                                                                    <input type="text" name="contact[start_date]" value="" class="form-control2 required" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ประเทศ</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>จำนวนหน้าที่พิมพ์</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                                <div class="col-md-3 col-sm-9">
                                                                    <label>ค่าใช้จ่าย</label>
                                                                    <input type="text" name="contact[expected_salary]" value="" class="form-control2 required">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">
                                                                    <label>ผู้เขียน</label>

                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="ชื่อ" class="form-control2">
                                                                </div>
                                                                <div class="col-md-4 col-sm-8">
                                                                    <label></label>

                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2"><br>
                                                                    <input type="text" name="contact[website]" placeholder="นามสกุล" class="form-control2">
                                                                </div>

                                                            </div>


                                                            <div class="col-md-4 col-sm-8">
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">เลือก <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><i class="fa fa-edit" data-target="#modal2"></i> อาจารย์ภายใน</li>

                                                                        <li><a href="#"><i class="fa fa-question-circle"></i> นักศึกษา</a></li>

                                                                    </ul>
                                                                </div>
                                                                <a href="#" class="btn btn-3d btn-red"><i class="et-megaphone"></i>ลบ</a><br/>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">

                                                                <div class="col-md-4 col-sm-8">


                                                                    <a href="#" class="btn btn-3d btn-blue"><i class="et-strategy"></i>เพิ่มสมาชิก</a>

                                                                </div><br><br>

                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <div class="col-md-12 col-sm-12">
                                                                            <label>keyword</label>
                                                                            <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label>
                                                                            ไฟล์บทคคัดย่อ
                                                                            <small class="text-muted">(text)</small>
                                                                        </label>

                                                                        <!-- custom file upload -->
                                                                        <div class="fancy-file-upload fancy-file-primary">
                                                                            <i class="fa fa-upload"></i>
                                                                            <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                            <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                            <span class="button">Choose File</span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label>
                                                                            ไฟล์บทความ
                                                                            <small class="text-muted">(Full text)</small>
                                                                        </label>

                                                                        <!-- custom file upload -->
                                                                        <div class="fancy-file-upload fancy-file-primary">
                                                                            <i class="fa fa-upload"></i>
                                                                            <input type="file" class="form-control2" name="contact[attachment]" onchange="jQuery(this).next('input').val(this.value);" />
                                                                            <input type="text" class="form-control2" placeholder="no file selected" readonly="" />
                                                                            <span class="button">Choose File</span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <label>รายละเอียดอื่นๆ</label>
                                                                        <textarea name="contact[experience]" rows="4" class="form-control required"  ></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <label>อยู่ภายใต้โครงการวิจัย</label>
                                                                        <select name="contact[position]" class="form-control2 pointer required">
                                                                            <option value="">อยู่ภายนอกโครงการวิจัย</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </fieldset>




                                                    <br><br>



                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="#" class="btn btn-3d btn-reveal btn-green" data-toggle="modal" data-target="#modal1"></i><span>บันทึก</span></a>
                                                            <a href="#" class="btn btn-3d btn-reveal btn-red" ><span>ยกเลิก</span></a>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div></center><br>

                    <table class="table table-striped table-bordered table-hover" id="datatable_sample">
                        <thead>
                        <tr>
                            <th class="table-checkbox">
                                <input type="checkbox" class="group-checkable" data-set="#datatable_sample .checkboxes"/>
                            </th>
                            <th>ปีที่ตีพิมพ์</th>
                            <th><center>ผลงานวิจัย</center></th>
                            <th>ค่านํ้าหนักฐานข้อมูล</th>
                            <th>แก้ไข</th>
                            <th>ดาวน์โหลดเอกสาร</th>
                        </tr>
                        </thead>
                        <?php foreach ($sql2 as $row) {?>
                        <tbody>
                        <tr class="odd gradeX">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/>
                            </td>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2016&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td>
                                <a href="Expenses-namepublic.html">
                                    Kokaew U., Wattana M., Tamviset W., Faungfoo S. and Aottiwech N.	,
                                    Augmented Reality Enhanced Learning in Phylum/Division Basidiomycota.,
                                    The 4th International Conference for Science educators and teachers (ISET2016) ,
                                    June, 2016, Khon Kaen, Thailand, pp.9. </a>
                            </td>
                            <td>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td class="center">
                                <!-- Large Modal -->
                                <a href="#" class="btn btn-3d btn-reveal btn-yellow" data-toggle="modal" data-target="#modal1"><i class="fa fa-pencil"></i><span>แก้ไข</span></a>
                                <a href="#" class="btn btn-3d btn-reveal btn-red" ><i class="fa fa-trash"></i><span>ลบ</span></a>

                                <div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- header modal -->
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel">แก้ไขเพิ่มเติม</h4>
                                            </div>

                                            <!-- body modal -->
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading panel-heading-transparent">
                                                        <strong>International Journal</strong>
                                                    </div>

                                                    <div class="panel-body">

                                                        <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                                            <fieldset>
                                                                <!-- required [php action request] -->
                                                                <input type="hidden" name="action" value="contact_send" />

                                                                <?= $this->render('_form', [
                                                                    'model' => $model,
                                                                ]) ?>

                                                            </fieldset>








                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
                                                                        SEND APPLICATION
                                                                        <span class="block font-lato">We'll get back to you within 48 hours</span>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                            </td>
                            <td>

                            </td>


                        </tbody>
                        <?php }?>
                    </table>

                </div>
                <!-- /panel content -->

            </div>

        </div>

    </section>
    //GridView::widget([
        //'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // 'pub_id',
          //  'pub_name_thai',
          //  'pub_name_eng',
          //  'book_name',
           // 'date',
            // 'acticle_detail',
            // 'page_number',
            // 'abstract',
            // 'press',
            // 'publisher',
            // 'ISBN',
            // 'compt_cities',
            // 'compt_counties',
            // 'auth_level_id',
            // 'issn',
            // 'doi',
            // 'article',
            // 'number',
            // 'issuance',
            // 'dataindex',
            // 'impact_factor',


           // [//'class' => 'yii\grid\ActionColumn'],
        //],
   // ]);
</div>

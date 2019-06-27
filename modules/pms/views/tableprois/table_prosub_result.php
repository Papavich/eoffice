<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 7/3/2561
 * Time: 15:08
 */
?>


<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->registerJsFile('@web/web_pms/js/budget.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/web_pms/js/table_status.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?=HTML::csrfMetaTags()?>

<header id="page-header">
    <h1>โครงการที่อยู่ในปีงบประมาณ</h1>
    <?php
    function DateThai($strDate)
    {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        return "$strYear/$strMonth/$strDay";
    }

    ?>
</header>
<style>
    nav.pagination-container {
        text-align: center;
        padding-top: 2px;
    }
</style>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>เพิ่มเอกสารขออนุมัติใช้งบประมาณ</strong>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(['action'=>'../addprosubresult/resultadd','method'=>'get']);?>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <label>เลือกโครงการย่อย</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <label>เลือกรอบวันที่ขออนุมัติจัด</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <select class="form-control" id="prosub_id" name="id">
                                echo "<option value=''>เลือกโครงการย่อย</option>";
                                <?php
                                foreach ($listProsub as $row){
                                    $name = \app\modules\pms\models\PmsProjectSub::findOne($row->pms_project_sub_prosub_code);
                                    echo "<option value='".$row->pms_project_sub_prosub_code."'>".$name->prosub_name."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select class="form-control" id="show_budget" name="id_compact">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus"> เพิ่ม</i></button>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>แบบสรุปโครงการที่รอตรวจสอบ</strong>
                </div>
                <div class="panel-body">
                    <div class="col-md-12" style="margin-top: 20px">
                        <table id="table_compact_place" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="15%">วันที่จัดโครงการ</th>
                                <th width="35%">ชื่อโครงการ</th>
                                <th width="15%">สถานะโครงการ</th>
                                <th width="10%">หมายเหตุ</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($prosub as $key => $rows){
                                $i = $key +1;
                                if($rows['status_finance'] == "อนุมัติสำเร็จ" && $rows['status_place'] == "อนุมัติสำเร็จ"){

                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        $stg ="".$rows['time_start'];
                                        $date = substr($stg, 0, 10);
                                        echo "รอบที่ ".$rows['round']." ".$date;
                                        ?>
                                    </td>
                                    <td class="center">
                                        <a href="../detailcompactbudget/detail?id=<?=$rows['prosub_code']?>&compact=<?=$rows['id']?>"><?=$rows['prosub_name']?></a>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" class="get_status_budget" data="<?=$rows['prosub_code']."_".$rows['id']?>" data-target="#showstatus">
                                            <?php
                                            echo $rows['status_result'];
                                            ?>
                                        </a>
                                    </td>
                                    <td>
                                            <span>
                                            </span>
                                    </td>

                                    <td>
                                        <a href="../compact/editcompactbudget?id=<?= $rows['prosub_code'];?>&compact=<?=$rows['id']?>"><i class="glyphicon glyphicon-pencil"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }}
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="showsavedate" role="dialog" hidden="">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="40%">ผู้บันทึกโครงการ</th>
                                    <th width="30%">วันที่บันทึกโครงการ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>ฝ่ายพัฒนานักศึกษาอนุมัติ</td>
                                    <td>2560/11/20</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="showstatus" role="dialog" hidden="">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="40%">สถานะโครงการ</th>
                                    <th width="30%">วันที่อนุมัติ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>ฝ่ายพัฒนานักศึกษาอนุมัติ</td>
                                    <td>10/10/2560</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!--============================start script next page table ====================================================== -->
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

    $(document).ready(function ($) {
        for (var i = 1; i <= 150; i++) {
            $('.list-group').append('<li class="list-group-item"> Item ' + i + '</li>');
        }

        $('.list-group').paginathing({
            perPage: 5,
            limitPagination: 9,
            containerClass: 'panel-footer'
        })

        $('#table1 tbody').paginathing({
            perPage: 10,
            insertAfter: '#table1'
        });
    });

    (function ($, window, document) {
        var Paginator = function (element, options) {
            this.el = $(element);
            this.options = $.extend({}, $.fn.paginathing.defaults, options);

            this.startPage = 1;
            this.currentPage = 1;
            this.totalItems = this.el.children().length;
            this.totalPages = Math.ceil(this.totalItems / this.options.perPage);
            this.container = $('<nav></nav>').addClass(this.options.containerClass);
            this.ul = $('<ul></ul>').addClass(this.options.ulClass);

            this.show(this.startPage);

            return this;
        }

        Paginator.prototype = {

            pagination: function (type, page) {
                var _self = this;
                var li = $('<li></li>');
                var a = $('<a></a>').attr('href', '#');
                var cssClass = type === 'number' ? _self.options.liClass : type;
                var text = type === 'number' ? page : _self.paginationText(type);

                li.addClass(cssClass);
                li.data('pagination-type', type);
                li.data('page', page);
                li.append(a.html(text));

                return li;
            },

            paginationText: function (type) {
                return this.options[type + 'Text'];
            },

            buildPagination: function () {
                var _self = this;
                var pagination = [];
                var prev = _self.currentPage - 1 < _self.startPage ? _self.startPage : _self.currentPage - 1;
                var next = _self.currentPage + 1 > _self.totalPages ? _self.totalPages : _self.currentPage + 1;

                var start, end;
                var limit = _self.options.limitPagination;
                var interval = 2;

                if (limit) {
                    if (_self.currentPage <= Math.ceil(limit / 2) + 1) {
                        start = 1;
                        end = limit;
                    } else if (_self.currentPage + Math.floor(limit / 2) >= _self.totalPages) {
                        start = _self.totalPages - limit;
                        end = _self.totalPages;
                    } else {
                        start = _self.currentPage - Math.ceil(limit / 2);
                        end = _self.currentPage + Math.floor(limit / 2);
                    }
                } else {
                    start = _self.startPage;
                    end = _self.totalPages;
                }

                // "First" button
                if (_self.options.firstLast) {
                    pagination.push(_self.pagination('first', _self.startPage));
                }

                // "Prev" button
                if (_self.options.prevNext) {
                    pagination.push(_self.pagination('prev', prev));
                }

                // Pagination
                for (var i = start; i <= end; i++) {
                    pagination.push(_self.pagination('number', i));
                }

                // "Next" button
                if (_self.options.prevNext) {
                    pagination.push(_self.pagination('next', next));
                }

                // "Last" button
                if (_self.options.firstLast) {
                    pagination.push(_self.pagination('last', _self.totalPages));
                }

                return pagination;
            },

            render: function (page) {
                var _self = this;
                var options = _self.options;
                var pagination = _self.buildPagination();

                // Remove children before re-render (prevent duplicate)
                _self.ul.children().remove();
                _self.ul.append(pagination);

                // Manage active DOM
                var startAt = page === 1 ? 0 : (page - 1) * options.perPage;
                var endAt = page * options.perPage;

                _self.el.children().hide();
                _self.el.children().slice(startAt, endAt).show();

                // Manage active state
                _self.ul.children().each(function () {
                    var _li = $(this);
                    var type = _li.data('pagination-type');

                    switch (type) {
                        case 'number':
                            if (_li.data('page') === page) {
                                _li.addClass(options.activeClass);
                            }
                            break;
                        case 'first':
                            page === _self.startPage && _li.toggleClass(options.disabledClass);
                            break;
                        case 'last':
                            page === _self.totalPages && _li.toggleClass(options.disabledClass);
                            break;
                        case 'prev':
                            (page - 1) < _self.startPage && _li.toggleClass(options.disabledClass);
                            break;
                        case 'next':
                            (page + 1) > _self.totalPages && _li.toggleClass(options.disabledClass);
                            break;
                        default:
                            break;
                    }
                });

                // If insertAfter is defined
                if (options.insertAfter) {
                    _self.container
                        .append(_self.ul)
                        .insertAfter($(options.insertAfter));
                } else {
                    _self.el
                        .after(_self.container.append(_self.ul));
                }
            },

            handle: function () {
                var _self = this;
                _self.container.find('li').each(function () {
                    var _li = $(this);

                    _li.click(function (e) {
                        e.preventDefault();
                        var page = _li.data('page');

                        _self.currentPage = page;
                        _self.show(page);
                    });
                });
            },

            show: function (page) {
                var _self = this;

                _self.render(page);
                _self.handle();
            }
        }

        $.fn.paginathing = function (options) {
            var _self = this;
            var settings = (typeof options === 'object') ? options : {};

            return _self.each(function () {
                var paginate = new Paginator(this, options);
                return paginate;
            });
        };

        $.fn.paginathing.defaults = {
            perPage: 10,
            limitPagination: false,
            prevNext: true,
            firstLast: true,
            prevText: '&laquo;',
            nextText: '&raquo;',
            firstText: 'First',
            lastText: 'Last',
            containerClass: 'pagination-container',
            ulClass: 'pagination',
            liClass: 'page',
            activeClass: 'active',
            disabledClass: 'disabled',
            insertAfter: null,
        }

    }(jQuery, window, document));

</script>


<!--============================end script next page table ====================================================== -->

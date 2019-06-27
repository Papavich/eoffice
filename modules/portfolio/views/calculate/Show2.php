




<!-- page title -->
<header id="page-header">
    <h1>Managed Datatables</h1>
    <ol class="breadcrumb">
        <li><a href="#">Tables</a></li>
        <li class="label label-sm label-success">Managed Datatables</li>
    </ol>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <!--
        PANEL CLASSES:
            panel-default
            panel-danger
            panel-warning
            panel-info
            panel-success

        INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                All pannels should have an unique ID or the panel collapse status will not be stored!
    -->
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>การประชุมวิชาการ</strong> <!-- panel title -->
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


            <form name="frm">
                <p><input type="checkbox" value="1" onclick="tick(frm , this)" /> 1</p>
                <p><input type="checkbox" value="2" onclick="tick(frm , this)" checked="checked" /> 2</p>
                <p><input type="checkbox" value="3" onclick="tick(frm , this)" /> 3</p>
                <p><input type="checkbox" value="4" onclick="tick(frm , this)" checked="checked"  /> 4</p>
                <input type="text" name="sum" value="100" />
            </form>
            <script type="text/javascript">
                function tick( frm , chk )
                {
                    // คำนวณบวกหรือลบจากค่าเริ่มต้น
                    var sum = parseFloat( frm.sum.value );
                    frm.sum.value = chk.checked ? sum + parseFloat(  chk.value ) : sum - parseFloat( chk.value );
                }
            </script>

        </div>
        <!-- /panel content -->

        <!-- panel footer -->
        <div class="panel-footer">



        </div>
        <!-- /panel footer -->

    </div>
    <!-- /PANEL -->

</div>
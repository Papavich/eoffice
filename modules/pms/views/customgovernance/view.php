<?php
?>
    <div id="content" class="padding-20 well">
        <a href="../customgovernance/governance-add" class="btn btn-sm btn-success btn-3d"><i class="glyphicon glyphicon-plus">เพิ่มข้อมูล</i></a>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="20%">ลำดับ</th>
                <th width="60%">ชื่อ</th>
                <th width="20%">options</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($model as $key => $governance) :?>
                <tr>
                    <td><?= $key+1?></td>
                    <td><?= $governance->first_name?></td>
                    <td><?= $governance->last_name?></td>
                    <td>
                        <a href="../customgovernance/update?id=<?= $governance->id?>"><i class="glyphicon glyphicon-pencil"></i></a> |
                    </td>

                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
<?php
$this->registerJS("$('.delete').click(function(){
        if(!confirm('ต้องการลบข้อมูลหรือไม่')){
            return false;
        }
    });
");
?>
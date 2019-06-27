<?php
if ($approve == "approve"){
    $approve = "อนุมัติแล้ว";
}else{
    $approve = "ไม่อนุมัติ";
}
?>
<h4>เรื่อง <?php echo $subject; ?></h4>
<p>จากหนังสือที่ส่งถึงหัวหน้าภาคที่มีการพิจาราณาขออนุมัติ หัวหน้าภาคได้ <?= $approve?></p>
<p>ท่านสามารถดูรายละเอียดได้ที่ลิงค์ด้านล่างนี้
    <a href="http://10.199.66.53/cs-e-office/web/correspondence/mail/read-mail?id=<?=$doc_id?>">ได้ที่นี่</a>
</p>
<!doctype html>
<html lang="en-US">
<head>
    <link rel="shortcut icon" href="picture/book.ico"/>
    <meta charset="utf-8"/>
</head>
<body>
<?php
require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
ob_start(); // ทำการเก็บค่า html นะครับ
?>

<?php
$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html
ob_end_clean();
$pdf = new mPDF('th', 'A4-L', '0', '');   //การตั้งค่ากระดาษถ้าต้องการแนวตั้ง ก็ A4 เฉยๆครับ ถ้าต้องการแนวนอนเท่ากับ A4-L
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output("picture/pdf.pdf");         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
?>
ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>
</body>
</html>

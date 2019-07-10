<?php 

use Da\QrCode\QrCode;

$qrCode = (new QrCode('http://localhost/eoffice/web/eoffice_asset/asset-detail/view?id=201'))
    ->setSize(250)
    ->setMargin(5)
    ->useForegroundColor(51, 153, 255);

// now we can display the qrcode in many ways
// saving the result to a file:

$qrCode->writeFile(__DIR__ . '/temp/Asset.png'); // writer defaults to PNG when none is specified

// display directly to the browser 
header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();

?> 

<?php 
// or even as data:uri url
echo '<img src="' . $qrCode->writeDataUri('') . '">';
?>
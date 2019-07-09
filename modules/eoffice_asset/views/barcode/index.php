<?php
    include_once './vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf([
        ['tempDir' => __DIR__ .'/temp']
    ]);
    $url = 'http://localhost/eoffice/web/eoffice_asset/barcode?asset_detail_id=$asset_detail_id';
    $html = '<barcode code="'.$url.'" type="QR" size="0.3" error="M" disableborder = "1"/>';
    try {
        $mpdf->WriteHTML($html);
    } catch (\Mpdf\MpdfException $e) {
        die ($e->getMessage());
    }

    $mpdf->Output();
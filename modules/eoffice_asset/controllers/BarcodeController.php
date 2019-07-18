<?php

namespace app\modules\eoffice_asset\controllers;

use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\AssetDetail;

use yii\helpers\Html;
use yii\helpers\Url;

use yii\web\Controller;
use kartik\mpdf\Pdf;

class BarcodeController extends Controller
{
    public function actionIndex()
    {
        $content = $this->renderPartial('index', [
        //    'model' => $asset_detail_id,
        ]);

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            //'format' => Pdf::FORMAT_A4,
            'format' => [25, 20],//Pdf::FORMAT_A4,
            'marginLeft' => 1,
            'marginRight' => 1,
            'marginTop' => 1,
            'marginBottom' => false,
            'marginHeader' => false,
            'marginFooter' => false,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            // 'cssFile' => '@frontend/web/css/kv-mpdf-bootstrap.css',
            // any css to be embedded if required
            'cssInline' => 'body{font-size:11px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Sticker'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>false,
                'SetFooter'=>false,
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}
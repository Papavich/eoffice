<?php

namespace app\modules\eoffice_asset\controllers;

use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\AssetDetail;

use yii\web\Controller;
use kartik\mpdf\Pdf;

class BarcodeController extends Controller
{
    public function actionIndex($asset_detail_id)
    {


        $model = AssetDetail::findOne($asset_detail_id);
        $content = $this->renderPartial('index', [
            'model' => $model
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => [30, 30],//กำหนดขนาด
            'marginLeft' => false,
            'marginRight' => false,
            'marginTop' => 3,
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
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
            // any css to be embedded if required
            'cssInline' => 'body{font-size:11px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Print Sticker', ],
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
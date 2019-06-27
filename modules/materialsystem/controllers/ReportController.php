<?php
namespace app\modules\materialsystem\controllers;

use app\modules\materialsystem\models\MatsysBillDetail;
use app\modules\materialsystem\models\MatsysDetail;
use app\modules\materialsystem\models\MatsysOrderDetail;
use yii\data\Pagination;
use yii\web\Controller;

class ReportController extends Controller
{
    /*public function actionIndex()
    {
        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'index';
        return $this->render('index');
    }*/

    public function actionMaterial_report()
    {
        $query = MatsysBillDetail::find();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'material_report';
        return $this->render('material_report' ,['models' => $models, 'pages' => $pages]);
    }

    public function actionAnnual_budget_report()
    {
        $query = MatsysOrderDetail::find();
        $detail = MatsysDetail::find()->all();
        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'annual_budget_report';
        return $this->render('annual_budget_report', ['models' => $models, 'pages' => $pages , 'detail' => $detail]);
    }

    public function actionSearch_report()
    {
        return $this->render('material_report');
    }
}

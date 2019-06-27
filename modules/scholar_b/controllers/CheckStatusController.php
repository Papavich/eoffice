<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 16/5/2561
 * Time: 21:35
 */

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\Listport;
use app\modules\scholar_b\models\Listproject;
use app\modules\scholar_b\models\model_main\EofficeCentralViewPisUser;
use app\modules\scholar_b\models\ScbPortfolio;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use app\modules\scholar_b\models\ScbProject;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class CheckStatusController extends Controller
{
    const ACT_PAGE_SIZE = 10;
    const STATUS_ENABLED = 1;   //อนุมัติแล้ว
    const STATUS_DISABLED = 0;  //ยังไม่อนุมัติ

    /* การอนุมัติการแก้ไขโครงงานและผลงาน*/
    public function actionCheckstatus()
    {
        $this->layout = "main_module";
        $personId = EofficeCentralViewPisUser::findOne(\Yii::$app->user->identity->getId())->username;

        $project = Listproject::find()
            ->where(['teacher_id_card' => $personId ])
            ->all();

        $portfolio = Listport::find()
            ->where(['teacher_id_card' => $personId ])
            ->all();

        return $this->render('checkstatus',[
            'project' => $project,
            'portfolio' => $portfolio,
        ]);

    }

    public function actionCheckproject($project_code)
    {
        $this->layout = "main_module";

        $checkproject = $this->findModel($project_code);

        if ($checkproject->pro_status = $this::STATUS_ENABLED) {
            $checkproject->save();

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('อนุมัติคำร้องขอสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }
        return $this->redirect('checkstatus#jtab1_nobg');

    }

    public function actionCheckport($id_portfolio)
    {
        $this->layout = "main_module";

        $checkport = $this->findModel2($id_portfolio);

        if ($checkport->port_status = $this::STATUS_ENABLED) {
            $checkport->save();

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app', Html::encode('อนุมัติคำร้องขอสำเร็จ')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }
        return $this->redirect('checkstatus#jtab2_nobg');

    }

    protected function findModel($project_code)
    {
        if (($model = ScbProject::findOne(['project_code' => $project_code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel2($id_portfolio)
    {
        if (($model = ScbPortfolio::findOne($id_portfolio)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
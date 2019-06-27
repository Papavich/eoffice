<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 4/3/2561
 * Time: 21:35
 */

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\controllers;
use yii\web\Controller;

class MockupController extends Controller
{
    public function actionGrantchart()
    {
        $this->layout = "main_module";
        return $this->render('grantchart');
    }

    public function actionAddGrantchart()
    {
        $this->layout = "main_module";
        return $this->render('add-grantchart');
    }

    public function actionManageProject()
    {
        $this->layout = "main_module";
        return $this->render('manage-project');
    }

    public function actionProgress()
    {
        $this->layout = "main_module";
        return $this->render('progress');
    }

    public function actionComment()
    {
        $this->layout = "main_module";
        return $this->render('comment');
    }

    public function actionProgressTeacher()
    {
        $this->layout = "main_module";
        return $this->render('progress-teacher');
    }

    public function actionViewComment()
    {
        $this->layout = "main_module";
        return $this->render('view-comment');
    }

    public function actionReportProgress()
    {
        $this->layout = "main_module";
        return $this->render('report-progress');
    }

    public function actionPlan()
    {
        $this->layout = "main_module";
        return $this->render('plan');
    }

}
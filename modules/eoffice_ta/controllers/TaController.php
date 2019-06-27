<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 31/7/2560
 * Time: 0:27
 */

namespace app\modules\eoffice_ta\controllers;
use yii\web\Controller;


class TaController extends controller
{
    public function actionIndex(){
        $this->view->params['status'] = 'u';
        $this->layout = "main_modules";
        return $this->render('news');
    }
    public function actionTaRegister(){
        $this->view->params['status'] = 'ta-register';
        $this->layout = "main_modules";
        return $this->render('//ta-register/index');
    }
    public function actionTaDocuments(){
        $this->view->params['status'] = 'ta-documents';
        $this->layout = "main_modules";
        return $this->render('//ta-documents/index');
    }
    public function actionTaNews(){
        $this->view->params['status'] = 'news';
        $this->layout = "main_modules";
        return $this->render('//ta-news/index');
    }
    public function actionTaRatio(){
        $this->view->params['status'] = 'ta-ratio/';
        $this->layout = "main_modules";
        return $this->render('//ta-ratio/index');
    }
    public function actionTaRuleGrade(){
        $this->view->params['status'] = 'ta-rule-grade';
        $this->layout = "main_modules";
        return $this->render('//ta-rule-grade/index');
    }
    public function actionWorkLoad(){
        $this->view->params['status'] = 'work-load';
        $this->layout = "main_modules";
        return $this->render('work-load');
    }
    public function actionWorkLoadView(){
        $this->view->params['status'] = 'work-load-view';
        $this->layout = "main_modules";
        return $this->render('//ta-work-load/work-load-view');
    }
    public function actionCheckWorkLoad(){
        $this->view->params['status'] = 'ta-check-work-load';
        $this->layout = "main_modules";
        return $this->render('check-work-load');
    }
    public function actionListViewTaPay(){
        $this->view->params['status'] = 'list-view-ta-pay';
        $this->layout = "main_modules";
        return $this->render('list-view-ta-pay');
    }
    public function actionListTaPayBySubject(){
        $this->view->params['status'] = 'list-ta-pay-by-subject';
        $this->layout = "main_modules";
        return $this->render('list-ta-pay-by-subject');
    }


}
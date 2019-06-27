<?php

namespace app\modules\consulting\controllers;

//use Yii;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use app\modules\consulting\models\ConsultTopic;

class SiteController extends Controller
{
    public function actionChat()
    {
        $this->layout = "main_modules";
        return $this->render('chat');
    }

    public function actionChatforteacher()
    {
        $this->layout = "main_modules";
        return $this->render('chatforteacher');
    }
    public function actionChatforstudent()
    {
        $this->layout = "main_modules";
        return $this->render('chatforstudent');
    }
    public function actionChatforparent()
    {
        $this->layout = "main_modules";
        return $this->render('chatforparent');
    }
    public function actionChatforstaff()
    {
        $this->layout = "main_modules";
        return $this->render('chatforstaff');
    }
    public function actionSentproblem()
    {
        $this->layout = "main_modules";
        return $this->render('sendproblem');
    }
    public function actionShowanswer()
    {
        $this->layout = "main_modules";
        return $this->render('showanswer');
    }



    public function actionSatisfaction()
    {
        $this->layout = "main_modules";
        return $this->render('satisfaction');
    }
    public function actionProfile()
    {
        $this->layout = "main_modules";
        return $this->render('profile');
    }

    public function actionCalender()
    {
        $this->layout = "main_modules";
        return $this->render('calender');
    }



    public function actionFaq()    //insertลูกครถภัณฑ์
    {

        $this->layout = "main_modules";
        $model = new ConsultTopic;


            return $this->render('faq', [
                'model' => $model,
            ]);

    }



    public function actionFaq2()
    {



        $model = new ConsultTopic;
        $this->layout = "main_modules";
        return $this->render('faq');
    }







    public function actionCalendar()
    {
        $this->layout = "main_modules";
        return $this->render('calendar');
    }
    public function actionBurden()
    {
        $this->layout = "main_modules";
        return $this->render('burden');
    }
    public function actionManagefaq()
    {
        $this->layout = "main_modules";
        return $this->render('managefaq');
    }
    public function actionSendanswer()
    {
        $this->layout = "main_modules";
        return $this->render('sendanswer');
    }
    public function actionShowproblem()
    {
        $this->layout = "main_modules";
        return $this->render('showproblem');
    }
    public function actionAnswer()
    {
        $this->layout = "main_modules";
        return $this->render('answer');
    }
    public function actionForward()
    {
        $this->layout = "main_modules";
        return $this->render('forward');
    }
    public function actionShowfaq()
    {
        $this->layout = "main_modules";
        return $this->render('showfaq');
    }

}

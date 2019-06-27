<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 20/1/2561
 * Time: 21:34
 */

namespace app\modules\scholar_b\controllers;

use app\modules\scholar_b\models\ScbCandidate;
use yii\web\Controller;
use Yii;


class LoginController extends Controller
{
    public function actionLogin()
    {

        $this->layout = "main_guest";
        return $this->render('login');

    }

    public function actionCheckLogin()
    {

        $id = Yii::$app->request->post('id_card');
        $password = Yii::$app->request->post('password');

        $model_candidate = ScbCandidate::find()
            ->where(['id_card' => $id, 'password' => $password])
            ->one();
        if ($model_candidate != null) {
            $session = Yii::$app->session;
            $session->open();

            $session['id_card'] = $model_candidate->id_card;
            $session['password'] = $model_candidate->password;
            $str = md5($password);
            $session['prefix'] = $model_candidate->prefix;
            $session['firstname'] = $model_candidate->firstname;
            $session['lastname'] = $model_candidate->lastname;

            return $this->redirect('insystem');

        } else {
            return $this->redirect('login');
        }

    }

    public function actionInsystem()
    {
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['id_card']) && isset($session['password'])) {

            return $this->redirect('login-success');
        } else {
            return $this->redirect('login-fail');
        }
    }

    public function actionLoginSuccess()
    {
        $session = Yii::$app->session;
        $session->open();
        if (isset($session['id_card']) && isset($session['password'])) {
            $this->layout = "main_user";
            return $this->render('login-success');
        }else{
            return $this->redirect('login-fail');
        }
    }

    public function actionLoginFail()
    {
            $this->layout = "main_guest";
            return $this->render('login-fail');

    }
}
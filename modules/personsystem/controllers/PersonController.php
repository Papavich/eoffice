<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 24/7/2560
 * Time: 10:32
 */

namespace app\modules\personsystem\controllers;

use app\modules\personsystem\models\AuthAssignment;
use app\modules\personsystem\models\Expertise;
use app\modules\personsystem\models\ExpertiseSearch;
use app\modules\personsystem\models\HistorySearch;
use app\modules\personsystem\models\Importsql;
use app\modules\personsystem\models\Person;
use app\modules\personsystem\models\PersonSearch;
use dektrium\user\models\RegistrationForm;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii;
use dektrium\user\Finder;
use dektrium\user\models\ResendForm;
use dektrium\user\models\User;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


class PersonController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionTeacherCreate()
    {
        $model = new Person();
        $model2 = new User();
        $modelAssignment = new AuthAssignment();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $model2->username = $model->person_card_id;
            $model2->email = $model->person_email;
            $model2->password = $model->person_citizen_id;
            $model->person_img = $model->upload($model, 'person_img');
            $model->save();
            if ($model2->save()) {
                    $modelUser = User::findOne($model2->id);
                    $modelUser->person_id = $model->person_id;
                    $modelUser->type = "1";
                    if($modelUser->save()){
                        $modelAssignment->user_id = (string)$modelUser->id;
                        $modelAssignment->item_name = "Staﬀ-General";
                        $modelAssignment->save();
                    }
                    if($modelAssignment->errors){
                        \Yii::$app->getSession()->setFlash('alert2', [
                            'type' => 'warning',
                            'duration' => 12000,
                            'icon' => 'fa fa-users',
                            'title' => \Yii::t('app', yii\helpers\Html::encode('Error')),
                            'message' => \Yii::t('app', yii\helpers\Html::encode('ไม่สามารถ Assignment Role Teacher ให้แก่ User ได้')),
                            'positonY' => 'top',
                            'positonX' => 'right'
                        ]);
                    }
                    \Yii::$app->getSession()->setFlash('alert1', [
                        'type' => 'success',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'title' => \Yii::t('app', yii\helpers\Html::encode('Submission')),
                        'message' => \Yii::t('app', yii\helpers\Html::encode('เพิ่มข้อมูลเสร็จเรียบร้อย')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);

            }
            return $this->redirect(['teacher/admin-view-teacher', 'id' => $model->person_id]);

        }
        $this->layout = "main_modules";
        return $this->render('teacher_create', ['model' => $model,]);
    }

    public function actionStaffCreate()
    {
        $model = new Person();
        $model2 = new User();
        $modelAssignment = new AuthAssignment();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $model2->username = $model->person_card_id;
            $model2->email = $model->person_email;
            $model2->password = $model->person_citizen_id;
            $model->person_img = $model->upload($model, 'person_img');
            $model->save();
            if ($model2->save()) {
                $modelUser = User::findOne($model2->id);
                $modelUser->person_id = $model->person_id;
                $modelUser->type = "2";
                if($modelUser->save()){
                    $modelAssignment->user_id = (string)$modelUser->id;
                    $modelAssignment->item_name = "Teacher";
                    $modelAssignment->save();
                }
                if($modelAssignment->errors){
                    \Yii::$app->getSession()->setFlash('alert2', [
                        'type' => 'warning',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'title' => \Yii::t('app', yii\helpers\Html::encode('Error')),
                        'message' => \Yii::t('app', yii\helpers\Html::encode('ไม่สามารถ Assignment Role Teacher ให้แก่ User ได้')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                }
                \Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => \Yii::t('app', yii\helpers\Html::encode('Submission')),
                    'message' => \Yii::t('app', yii\helpers\Html::encode('เพิ่มข้อมูลเสร็จเรียบร้อย')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }

            return $this->redirect(['staff/admin-view-staff', 'id' => $model->person_id]);
        }
        $this->layout = "main_modules";
        return $this->render('staff_create', [
            'model' => $model,
        ]);
    }

    public function actionTestCreate()
    {
        $model = new Importsql();
        $model2 = new User();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model2->username = $model->name;
            $model2->email = $model->last_name;
            $model2->password = $model->age;
            $model->img = $model->upload($model, 'img');
            if ($model->save() && $model2->save()) {
                $modelPerson = User::findOne($model2->id);
                $modelPerson->person_id = "69";
                $modelPerson->save();
                \Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => \Yii::t('app', yii\helpers\Html::encode('Submission')),
                    'message' => \Yii::t('app', yii\helpers\Html::encode('เพิ่มข้อมูลเสร็จเรียบร้อย')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['create', 'id' => $model->id]);
            }
        }
        $this->layout = "main_modules";
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionTest()
    {
        $model2 = new User();
        $model2->username = "katezung";
        $model2->email = "katezung@gmail.com";
        $model2->password = "1234";
        $model2->save();
        //  $customer = new \app\modules\personsystem\models\User();
//        $customer =  User::findOne(58);
//
//        $customer->person_id = "123";
//        $customer->save();

    }


}
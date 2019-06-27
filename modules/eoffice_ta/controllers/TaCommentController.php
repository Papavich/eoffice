<?php

namespace app\modules\eoffice_ta\controllers;

use app\modules\eoffice_ta\models\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\TaRegister;
use app\modules\eoffice_ta\models\TaRequest;
use app\modules\eoffice_ta\models\TaStatus;
use Yii;
//use app\modules\eoffice_ta\models\ViewPisEnroll;
use app\modules\eoffice_ta\models\model_central\ViewPisEnroll;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_central\ViewPisUser;
use app\modules\eoffice_ta\models\TaComment;
use app\modules\eoffice_ta\models\TaCommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\timeago\TimeAgo;
use yii\data\Pagination;
use app\modules\eoffice_ta\models\model_central\EofficeCentralRegClass;
use app\modules\eoffice_ta\models\Kku30Subject;

/**
 * TaCommentController implements the CRUD actions for TaComment model.
 */
class TaCommentController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all TaComment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $per = Yii::$app->formatter->asNtext($user->person_id);
         // if $u คือเอาไปหาว่าเป็นทีเอมั้ย  ถ้าเป็ยก็ให้ โชว์เม้นล่าสุดเอา ของวิชาที่ตัวเองเป็บTA  ถ้าไม่เป็นTA -->
        //if $u ViewPisEnroll ถ้ามีวิชาที่ลงทะเบียนเรียน ให้โชว !empty

        /*$person = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);  */
        //$per = Yii::$app->formatter->asNtext($person->person_id);


        $modelSecTeacher = ViewPisOfficerClass::find()->where(['OFFICERNAME'=>$user->person_fname_th,
            'OFFICERSURNAME'=>$user->person_lname_th])->all();
        //$modelSecTeacher = Kku30SectionTeacher::find()->where(['teacher_no'=>$per])->all();
        //$modelTeacher2 = Kku30SectionTeacher::findOne(['teacher_no'=>$per]);
        $modelTeacher2 = ViewPisOfficerClass::findOne(['OFFICERNAME'=>$user->person_fname_th,
            'OFFICERSURNAME'=>$user->person_lname_th]);
        //$modelTeacher2->OFFICERNAME;$modelTeacher2->OFFICERSURNAME;

        $modelTA = TaRegister::find()->where(['person_id'=>$per,'ta_status_id'=>TaStatus::CHOOSE_TA])->all();
        $modelTA2 =  TaRegisterSection::findOne(['person_id'=>$per,'ta_status'=>TaStatus::CHOOSE_TA]);

        $model = ViewPisEnroll::find()->where(['STUDENTID'=>$user->person_id])->all();
       /* $class = EofficeCentralRegClass::findOne(['CLASSID'=>$row->CLASSID]);
        $subject = Kku30Subject::find(['subject_id'=>$class->CLASSCOURSECODE])->all();
       */
        $modelEnroll = ViewPisEnroll::findOne(['STUDENTID'=>$user->person_id]);

        if (!empty($modelSecTeacher) ) {  // เป็นทั้ง TA + ลงทะเบียนเรียน จะเข้าเงื่อนไขนี้
            if(!empty($modelTeacher2)) {
                $query = TaComment::find()->where(['subject_id' => $modelTeacher2->COURSECODE,
                 /* 'section'=>$modelTeacher2->section_no*/])->orderBy(['crtime' => SORT_DESC]);
                if (!empty($query)) {
                    $countQuery = clone $query;
                    $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                    $Comment = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();

                $this->layout = "main_modules";
                return $this->render('index', [
                    'model' => $model,
                    'modelTA' => $modelTA,
                    'pages'=>$pages,
                    'Comment' => $Comment,
                    'modelSecTeacher' => $modelSecTeacher,
                ]);
            }}
            else{ // อันนี้ของ FindOne

                $this->layout = "main_modules";
                echo "คุณไม่ลงทะเบียนเรียน1";

            }
        }

        else if (!empty($modelTA) ) {  // เป็นทั้ง TA  จะเข้าเงื่อนไขนี้
            if(!empty($modelTA2)) {
                $query = TaComment::find()->where(['subject_id' => $modelTA2->subject_id,
                    'section'=>$modelTA2->section])->orderBy(['crtime' => SORT_DESC]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $Comment = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();

                $this->layout = "main_modules";
                return $this->render('index', [
                    'model' => $model,
                    'modelTA' => $modelTA,
                    'pages'=>$pages,
                    'Comment' => $Comment,
                ]);
            }
           else{ // อันนี้ของ FindOne

                $this->layout = "main_modules";
               echo "คุณไม่ลงทะเบียนเรียน1";

            }
        }

        elseif (!empty($modelTA) AND !empty($model)) {  // เป็นทั้ง TA + ลงทะเบียนเรียน จะเข้าเงื่อนไขนี้
            if(!empty($modelTA2)) {

                $query = TaComment::find()->where(['subject_id' => $modelTA2->subject_id,
                    'section'=>$modelTA2->section])->orderBy(['crtime' => SORT_DESC]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
                $Comment = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();

                $this->layout = "main_modules";
                return $this->render('index', [
                    'model' => $model,
                    'modelTA' => $modelTA,
                    'pages'=>$pages,
                    'Comment' => $Comment,
                    'modelSecTeacher' => $modelSecTeacher,
                ]);
            }
            else{ // อันนี้ของ FindOne

                $this->layout = "main_modules";
                echo "คุณไม่ลงทะเบียนเรียน2";

            }
        }

        elseif (!empty($model)){  // ถ้าลงทะเบียนเรียน อย่างเดียว(ไม่เป็น TA) จะเข้าเงื่อนไขนี้
        if(!empty($modelEnroll)) {
            $query = TaComment::find()->where(['subject_id' => $modelEnroll->COURSEID,
                'section'=>$modelEnroll->SECTION])->orderBy(['crtime' => SORT_DESC]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
            $Comment = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        $this->layout = "main_modules";
        return $this->render('index', [

            'model' => $model,
            'modelTA' => $modelTA,
            'pages'=>$pages,
            'Comment' => $Comment,
            'modelSecTeacher' => $modelSecTeacher,
        ]);
    }
        else{ // อันนี้ของ FindOne

            $this->layout = "main_modules";
            echo "คุณไม่ลงทะเบียนเรียน3";

        }
        }
         else{ // อันนี้ของ FindOne

            $this->layout = "main_modules";
            echo "คุณไม่ลงทะเบียนเรียน4";
            return $this->render('index', [
            ]);
        }


    }



    /**
     * Displays a single TaComment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionTaList($sec,$s,$t,$y)
    {
        $user = ViewPisUser::findOne(['id' => Yii::$app->user->id]);
        $u = Yii::$app->formatter->asNtext($user->user_id);

        $RegisSec = TaRegisterSection::find()->where(['section'=>'0'.$sec,'subject_id'=>$s,
                   'term'=>$t,'year'=>$y])->all();
        $model = ViewPisEnroll::find()->where(['STUDENTID'=>$user->person_id])->all();
        $this->layout = "main_modules";
        return $this->render('ta-list', [
            'model' => $model,
            'RegisSec' => $RegisSec,
            's'=>$s,'sec'=>$sec,'t'=>$t,'y'=>$y,
        ]);
    }

    /**
     * Creates a new TaComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($sec,$s,$t,$y,$ta)
    {
        $model = new TaComment();
        $tas = TaRegister::findOne(['person_id'=>$ta,'subject_id' =>$s,
            'term'=>$t,'ta_status_id'=>TaStatus::CHOOSE_TA]);

        $query = TaComment::find()->where(['subject_id' =>$tas->subject_id,
            'ta_id'=>$tas->person_id,'term'=>$tas->term])->orderBy(['crtime' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 4]);
        $comment = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if ($model->load(Yii::$app->request->post()) ) {
            $model->section = $sec;
            $model->subject_id = $s;
            $model->term = $t;
            $model->year = $y;
            $model->ta_id = $ta;
            $model->crby = Yii::$app->user->id;
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_comment_id]);
        }

        $this->layout = "main_modules";
        return $this->render('comment-ta', [
            'Comment'=>$comment,
            'pages'=>$pages,
            'model' => $model,  's'=>$s,'sec'=>$sec,'t'=>$t,'y'=>$y,'ta'=>$ta
        ]);
    }

    /**
     * Updates an existing TaComment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            //$model->udtime = date('Y-m-d H:i:s');
            $model->udby = Yii::$app->user->id;
            $model->save();
            $this->layout = "main_modules";
            return $this->redirect(['view', 'id' => $model->ta_comment_id]);
        }

        $this->layout = "main_modules";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCommentTa($sec,$s,$t,$y,$ta){

        $tas = TaRegister::findOne(['person_id'=>$ta,'subject_id' =>$s,
            'term'=>$t,'ta_status_id'=>TaStatus::CHOOSE_TA]);

        $query = TaComment::find()->where(['subject_id' =>$tas->subject_id,
            'ta_id'=>$tas->person_id,'term'=>$tas->term])->orderBy(['crtime' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 4]);
        $comment = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->layout = "main_modules";
        return $this->render('comment-ta',[
            'Comment'=>$comment,
            'pages'=>$pages,
            'ta'=>$ta,'s'=>$s,'t'=>$t,'y'=>$y,
        ]);
    }
    /**
     * Deletes an existing TaComment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $this->layout = "main_modules";
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaComment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/9/2017
 * Time: 5:57 AM
 */

namespace app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\Kku30Subject;
use app\modules\eoffice_ta\models\model_central\ViewPisOfficerClass;
use app\modules\eoffice_ta\models\SubjectOpen;

use app\modules\eoffice_ta\models\SectionTeacher;
//use app\models\Person;
use app\modules\eoffice_ta\models\Kku30SectionTeacher;
//use app\modules\eoffice_ta\models\model_kku30\Kku30SectionTeacher;
use app\modules\eoffice_ta\models\Kku30SubjectOpen;
//use app\modules\eoffice_ta\models\model_kku30\Kku30SubjectOpen;
use app\modules\eoffice_ta\models\model_main\PersonView;
use app\modules\eoffice_ta\models\model_main\EofficeMainUser;
use app\modules\eoffice_ta\models\model_main\ViewPisUser2;
use app\modules\eoffice_ta\models\model_central\ViewPisPerson;
use app\modules\eoffice_ta\models\TaComment;
use app\modules\eoffice_ta\models\TaStatus;
use app\modules\eoffice_ta\models\TaWorking;
use app\modules\eoffice_ta\models\Term;
use app\modules\eoffice_ta\models\TaRegister;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;


class TeacherController extends controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
/*
    public function actionRequestTa(){
    $u = Person::findOne(['user_id' => Yii::$app->user->id]);
    $per = $u->person_citizen_id;
    $secTs = SectionTeacher::find()->where(['teacher_id'=>$per])->all();
    foreach ( $secTs as $secT){
        $subj[] =  $secT->subject_id;

        $model = SubjectOpen::find()->where(['subject_id'=>$subj])->all();
    }
    $this->layout = "main_modules";
    return $this->render('request-ta',[
        'model' => $model,
        // 'subj'=>$subj,
    ]);
}
*/
    public function actionRequestTa(){
    $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
    $per = $u->person_id;
    // $u = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
    // $u = ViewPisUser2::findOne(['id' => Yii::$app->user->id]);
    //$per = Yii::$app->formatter->asNtext($u->person_id);

    /* $model = null;
     if (Yii::$app->request->get( 'term' ) != null) {*/
    $term_id = Yii::$app->request->get( 'term' );
    $year = Yii::$app->request->get( 'year' );
    $this->layout = "main_modules";
    return $this->render('request-ta',[
        //  'term'=>$term,
        //'model' => $model,
        //'secTs' =>$secTs,
        // 'subj'=>$subj,
    ]);
}
    //check-working-ta.php
    public function actionCheckWorkingTa(){
        $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        $per = $u->person_id;
        $term_id = Yii::$app->request->get( 'term' );
        $year = Yii::$app->request->get( 'year' );
        $this->layout = "main_modules";
        return $this->render('check-working-ta',[

        ]);
    }
    public function actionCheckWorkingTa2($s,$ver,$t,$y){
        $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        $per = $u->person_id;
        $query = TaRegister::find()->where([
            'subject_id'=>$s,'subject_version'=>$ver,
            'term'=>$t,'year'=>$y,'ta_status_id'=>TaStatus::CHOOSE_TA]);

       // $query = TaRegister::find()->where(['person_id'=>$u]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->layout = "main_modules";
        return $this->render('check-working-ta2',[
       // 'Registers' =>$Registers,
            'model'=> $model,
            'pages' => $pages,
            's'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y
        ]);
    }
    //check-working-by-ta

    public function actionCheckWorkingByTa($ta,$s,/*$sec,*/$ver,$t,$y){
        $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        $per = $u->person_id;
        $query = TaWorking::find()->where([
            'person_id'=>$ta, 'subject_id'=>$s,//'section'=>$sec,
            'subject_version'=>$ver,'term_id'=>$t,'year_id'=>$y,
            'active_status'=> TaWorking::STATUS_NEW])->orderBy(['working_date'=>SORT_ASC]);

        // $query = TaRegister::find()->where(['person_id'=>$u]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->layout = "main_modules";
        return $this->render('check-working-by-ta',[
            // 'Registers' =>$Registers,
            'model'=> $model,
            'pages' => $pages,
            'ta'=>$ta,/*'sec'=>$sec,*/'s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y
        ]);
    }
    public function actionCheckWorkingByConfirm($ta,$s,$ver,$t,$y){
        $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        $per = $u->person_id;
        $query = TaWorking::find()->where([
            'person_id'=>$ta, 'subject_id'=>$s,//'section'=>$sec,
            'subject_version'=>$ver,'term_id'=>$t,'year_id'=>$y,
            'active_status'=> TaWorking::STATUS_CONFIRM_Hr])->orderBy(['working_date'=>SORT_ASC]);

        // $query = TaRegister::find()->where(['person_id'=>$u]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->layout = "main_modules";
        return $this->render('check-working-by-confirm',[
            // 'Registers' =>$Registers,
            'model'=> $model,
            'pages' => $pages,
            'ta'=>$ta,/*'sec'=>$sec,*/'s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y
        ]);
    }
    public function actionCheckWorkingByNonconfirm($ta,$s,$ver,$t,$y){
        $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        $per = $u->person_id;
        $query = TaWorking::find()->where([
            'person_id'=>$ta, 'subject_id'=>$s,//'section'=>$sec,
            'subject_version'=>$ver,'term_id'=>$t,'year_id'=>$y,
            'active_status'=> TaWorking::STATUS_NON_CONFIRM_Hr])->orderBy(['working_date'=>SORT_ASC]);

        // $query = TaRegister::find()->where(['person_id'=>$u]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->layout = "main_modules";
        return $this->render('check-working-by-nonconfirm',[
            // 'Registers' =>$Registers,
            'model'=> $model,
            'pages' => $pages,
            'ta'=>$ta,/*'sec'=>$sec,*/'s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y
        ]);
    }
    public function actionConfirmHr($id,$ta,$s,$sec,$ver,$t,$y)
    {
        $query = TaWorking::find()->where([
            'person_id'=>$ta, 'subject_id'=>$s,'section'=>$sec,
            'subject_version'=>$ver,'term_id'=>$t,'year_id'=>$y]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $model2 = TaWorking::findOne(['ta_work_plan_id'=>$id]);
        if ($model2->save()) {
            $model2->update($model2->active_status = TaWorking::STATUS_CONFIRM_Hr);
        }
            $this->layout = "main_modules";
            return $this->redirect(['check-working-by-ta',
                'model'=> $model,
                'pages' => $pages,
                'ta'=>$ta,'s'=>$s,'sec'=>$sec,'ver'=>$ver,'t'=>$t,'y'=>$y
            ]);

    }

    public function actionNonConfirmHr($id,$ta,$s,$sec,$ver,$t,$y)
    {
        $query = TaWorking::find()->where([
            'person_id'=>$ta, 'subject_id'=>$s,'section'=>$sec,
            'subject_version'=>$ver,'term_id'=>$t,'year_id'=>$y]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize' => 5]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $model2 = TaWorking::findOne(['ta_work_plan_id'=>$id]);
        if ($model2->save()) {
            $model2->update($model2->active_status = TaWorking::STATUS_NON_CONFIRM_Hr);
        }
            $this->layout = "main_modules";
            return $this->redirect(['check-working-by-ta',
                'model'=> $model,
                'pages' => $pages,
                'ta'=>$ta,'s'=>$s,'sec'=>$sec,'ver'=>$ver,'t'=>$t,'y'=>$y
            ]);

    }



    public function actionChooseTa(){
        $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        $per = $u->person_id;
        //$u = PersonView::findOne(['id' => Yii::$app->user->id]);
        //$u = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
       // $per = $u->person_id;
       // $secTs = SectionTeacher::find()->where(['teacher_id'=>$per])->all();
        $secTs = Kku30SectionTeacher::find()->where(['teacher_no'=>$per])->all();
        foreach ( $secTs as $secT){
            $subj[] =  $secT->subject_id;
            $model = Kku30SubjectOpen::find()
                ->andWhere( ['subject_id'=>$subj] )
                ->all();
        }
        $this->layout = "main_modules";
        return $this->render('choose-ta',[
           //'model' => $model,
            // 'subj'=>$subj,

        ]);
    }  //choose-ta.php

    public function actionRead($t,$s,$y)
    { //Update Multiple record
        $model1 = TaRegister::find()->where(['subject_id'=>$s,'term'=>$t,'year'=>$y,
            'ta_status_id'=>TaStatus::START_REGISTER_TA])->all();
        if (!empty($model1)){
            foreach ($model1  as $key => $row){
           $model = TaRegister::findOne(['subject_id'=>$s,'term'=>$t,
               'year'=>$y,
               'ta_status_id'=>TaStatus::START_REGISTER_TA]);
           $model->ta_status_id = TaStatus::REGISTER_TA_READ;
           $model->save();
            // $model->updateAll([ 'ta_status_id'=>TaStatus::REGISTER_TA_READ], $model);
            // $model->updateAll(array('ta_status_id'=>TaStatus::REGISTER_TA_READ));
            // $model->update(['ta_status_id'=>TaStatus::REGISTER_TA_READ]);
        }
            $this->layout = "main_modules";
            return $this->redirect(['choose-ta2',
                's' => $s, 't' => $t,'y'=>$y
            ]);
        } else{
            $this->layout = "main_modules";
            return $this->redirect(['choose-ta2',
                's' => $s, 't' => $t,'y'=>$y
            ]);
        }
    }

    public function actionChooseTa2($s,$t,$y)
    {
        $model = TaRegister::find()->where([
            'subject_id'=>$s,
            'term'=>$t,'year'=>$y,
            'ta_status_id'=>[
                TaStatus::REGISTER_TA_READ ,
                TaStatus::CHOOSE_TA,
            ]
        ])->all();
        $model_STDfail = TaRegister::find()->where([
            'subject_id'=>$s,
            'term'=>$t,'year'=>$y,
            'ta_status_id'=> TaStatus::FAIL_CHOOSE_TA
        ])->all();
        $this->layout = "main_modules";
        return $this->render('choose-ta2', [
            'model' => $model,
            'std_fail'=>$model_STDfail,
            't' => $t, 's'=>$s,'y'=>$y
        ]);
    }

    public function actionChooseActive($id,$t,$s,$y)
    {
        $std_list = TaRegister::find()->where([
            'subject_id' => $s,
            'term' => $t,
            'ta_status_id' => [
                TaStatus::REGISTER_TA_READ,
                TaStatus::CHOOSE_TA,
                TaStatus::FAIL_CHOOSE_TA
            ]])->all();
        $model2 = TaRegister::findOne(['person_id'=>$id,'subject_id'=>$s,'term'=>$t
            ,'year'=>$y,]);
        //$term = Term::findOne(['term_id' => $t]);
       // $y = $term->year;
        if ($model2->save()) {
            $model2->update($model2->ta_status_id = TaStatus::CHOOSE_TA);

            $this->layout = "main_modules";
            return $this->redirect(['choose-ta2',
                'model'=>$std_list,
                's' => $s, 't' => $t,'y'=>$y
            ]);
        }
    }
    public function actionNonChoose($id,$t,$s,$y)
    {
        $std_list = TaRegister::find()->where([
            'subject_id' => $s,
            'term' => $t,'year'=>$y,
            'ta_status_id' => [
                TaStatus::REGISTER_TA_READ,
                TaStatus::CHOOSE_TA,
                TaStatus::FAIL_CHOOSE_TA
            ]])->all();
        $model = TaRegister::findOne(['person_id'=>$id,'subject_id'=>$s,'term'=>$t,
            'year'=>$y,]);
        if ($model->save()) {
            $model->update($model->ta_status_id = TaStatus::FAIL_CHOOSE_TA);
            $this->layout = "main_modules";
            return $this->redirect(['choose-ta2',
                'model'=>$std_list,
                's' => $s, 't' => $t,'y'=>$y
            ]);
        }
    }
    public function actionCancelChoose($id,$t,$s,$y)
    {
        $std_list = TaRegister::find()->where([
            'subject_id' => $s,
            'term' => $t,'year'=>$y,
            'ta_status_id' => [
                TaStatus::REGISTER_TA_READ,
                TaStatus::CHOOSE_TA,
                TaStatus::FAIL_CHOOSE_TA
            ]])->all();
        $model2 = TaRegister::findOne(['person_id'=>$id,'subject_id'=>$s,'term'=>$t
            ,'year'=>$y,]);
        //$term = Term::findOne(['term_id' => $t]);
        //$y = $term->year;
        //  $model = $this->findModel($id, $s, $t, $y);
        if ($model2->save()) {
            $model2->update($model2->ta_status_id = TaStatus::REGISTER_TA_READ);
            $this->layout = "main_modules";
            return $this->redirect(['choose-ta2',
                'model'=>$std_list,
                's' => $s, 't' => $t,'y'=>$y
            ]);
        }
    }
    public function actionCommentTa(){
        $u = ViewPisPerson::findOne(['id' => Yii::$app->user->id]);
        //$u = EofficeMainUser::findOne(['id' => Yii::$app->user->id]);
        $per = $u->person_id;
        $secTs = ViewPisOfficerClass::find()->where(['OFFICERNAME'=>$u->person_name,'OFFICERSURNAME'=>$u->person_surname])->all();
        //foreach ( $secTs as $secT){
          //  $subj[] =  $secT->COURSECODE;
            //$model1 = SubjectOpen::find()->where(['subject_id'=>$subj])->all();
           /* $query = Kku30SubjectOpen::find()->where(['subject_id' =>  $subj
               ]);*/
        $query = ViewPisOfficerClass::find()->where(['OFFICERNAME'=>$u->person_name,'OFFICERSURNAME'=>$u->person_surname]);
        $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
            $model = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        $this->layout = "main_modules";
        return $this->render('comment-ta',[
             'model'=>$model,
             'pages'=>$pages,
        ]);
    }

    public function actionCommentTa2($s,$ver,$t,$y){
            $query = TaRegister::find()->where(['subject_id' =>$s,'subject_version'=>$ver,
                'term'=>$t,'ta_status_id'=>TaStatus::CHOOSE_TA]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
            $model = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        $this->layout = "main_modules";
        return $this->render('comment-ta2',[
            'model'=>$model,
            'pages'=>$pages,
            's'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y
        ]);
    }

    public function actionCommentTa3($ta,$s,$ver,$t,$y){

        $tas = TaRegister::findOne(['person_id'=>$ta,'subject_id' =>$s,'subject_version'=>$ver,
            'term'=>$t,'year'=>$y,'ta_status_id'=>TaStatus::CHOOSE_TA]);

            $query = TaComment::find()->where(['subject_id' =>$tas->subject_id,
                'ta_id'=>$tas->person_id,'term'=>$tas->term,'year'=>$tas->year])->orderBy(['crtime' => SORT_DESC]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 4]);
            $comment = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        $this->layout = "main_modules";
        return $this->render('comment-ta3',[
            'Comment'=>$comment,
            'pages'=>$pages,
           'ta'=>$ta,'s'=>$s,'ver'=>$ver,'t'=>$t,'y'=>$y
        ]);
    }
}

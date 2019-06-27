<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/19/2018
 * Time: 4:49 PM
 */

namespace app\modules\personsystem\controllers;
use app\modules\personsystem\models\BoardOfDirectors;
use app\modules\personsystem\models\BoardSearch;
use app\modules\personsystem\models\BranchHasLevel;
use app\modules\personsystem\models\BranchHasLevelSearch;
use app\modules\personsystem\models\Major;
use app\modules\personsystem\models\MajorHasProgram;
use app\modules\personsystem\models\MajorProgramSearch;
use app\modules\personsystem\models\MajorSearch;
use app\modules\personsystem\models\Period;
use app\modules\personsystem\models\PeriodSearch;
use app\modules\personsystem\models\Person;
use app\modules\personsystem\models\PositionDirectors;
use app\modules\personsystem\models\PositionSearch;
use app\modules\personsystem\models\RegProgram;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class AddInformationController extends Controller
{

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
     * Lists all BoardOfDirectors models.
     * @return mixed
     */
    public function actionAddProgramMajor(){

        $model = new MajorHasProgram();
        if( $model->load(Yii::$app->request->post()) ){
            if( $model->save() ){
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Submission')),
                    'message' => Yii::t('app',Html::encode('บันทึกข้อมูลหลักสูตร เสร็จเรียบร้อย')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect('add-program-major');
            }
        }
        $model2 = new Major();
        $modelMajor = Major::find()->all();
        $searchModel = new MajorProgramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel2 = new MajorSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        $model4 = new BranchHasLevel();
        $searchModel4 = new BranchHasLevelSearch();
        $dataProvider4 = $searchModel4->search(\Yii::$app->request->queryParams);
        $this->layout = "main_modules";
        $modelProgram = MajorHasProgram::find()->select('PROGRAMID')->all();
        $programNotHave = RegProgram::find()->where(['NOT IN', 'PROGRAMID', $modelProgram])->andWhere(['DEPARTMENTID' => ['2320','2322'],'FACULTYID'=>'2'])->select(['PROGRAMID','PROGRAMNAME'])->all();
        return $this->render('add-program-major',[
            'program'=> $programNotHave,
            'model'=> $model,
            'model2'=>$model2,
            'modelMajor'=>$modelMajor,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
            'model4'=> $model4,
            'searchModel4' => $searchModel4,
            'dataProvider4' => $dataProvider4,
        ]);
    }
    public function actionMajorCreate(){
        $model2 = new Major();
        $this->layout = "main_modules";
        if ($model2->load(Yii::$app->request->post()) && $model2->save()) {

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app',Html::encode('บันทึกข้อมูลสาขา เสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect('add-program-major?active=2');
        }else{
            return $this->redirect('add-program-major?active=2');
        }
    }
    public function actionMajorView($id){
        $this->layout = "main_modules";
        return $this->render('major_view', [
            'model' => $this->findModelMajor($id),
        ]);
    }
    public function actionMajorUpdate($id)
    {
        $model = $this->findModelMajor($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Update Complete')),
                'message' => Yii::t('app',Html::encode('แก้ไขข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['major-view', 'id' => $model->major_id]);
        }else{
            $this->layout = "main_modules";
            return $this->render('major_update', [
            'model' => $model,
        ]);
        }
    }
    public function actionMajorDelete($id)
    {
        if(!MajorHasProgram::find()->where(['major_id'=>$id])->all()) {
            $this->findModelMajor($id)->delete();
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Delete Complete')),
                'message' => Yii::t('app', Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['add-program-major?active=2']);
        }else{
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'warning',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Cannot Delete')),
                'message' => Yii::t('app', Html::encode('ไม่สามารถลบข้อมูลนี้ได้ เนื่องจากมีการใช้ข้อมูลนี้อยู่')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['add-program-major?active=2']);
        }
    }
    protected function findModelMajor($id)
    {
        if (($model = Major::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionProgramView($major_id, $PROGRAMID)
    {
        $modelMajor = Major::find()->all();
        $this->layout = "main_modules";
        return $this->render('Program_view', [
            'model' => $this->findModelProgram($major_id, $PROGRAMID),
            'modelMajor'=>$modelMajor,
        ]);
    }
    public function actionProgramUpdate($major_id, $PROGRAMID)
    {
        $modelMajor = Major::find()->all();
        $model = $this->findModelProgram($major_id, $PROGRAMID);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Update Complete')),
                'message' => Yii::t('app',Html::encode('แก้ไขข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['program-view', 'major_id' => $model->major_id, 'PROGRAMID' => $model->PROGRAMID]);
        }else {
            $this->layout = "main_modules";
            return $this->render('program_update', [
                'model' => $model,
                'modelMajor' => $modelMajor,
            ]);
        }
    }
    public function actionProgramDelete($major_id, $PROGRAMID)
    {
        $this->findModelProgram($major_id, $PROGRAMID)->delete();
        Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Delete Complete')),
            'message' => Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['add-program-major']);
    }

    protected function findModelProgram($major_id, $PROGRAMID)
    {
        if (($model = MajorHasProgram::findOne(['major_id' => $major_id, 'PROGRAMID' => $PROGRAMID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddDirectors(){
        $model2 = new PositionDirectors();
        $model3 = new Period();
        $model = new BoardOfDirectors();
        if( $model->load(Yii::$app->request->post()) ){
            if(!BoardOfDirectors::find()->where(['person_id'=>$model->person_id,'director_id'=>$model->director_id,'period_id'=>$model->period_id])->all()) {
                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('alert1', [
                        'type' => 'success',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'title' => Yii::t('app', Html::encode('Submission')),
                        'message' => Yii::t('app', Html::encode('บันทึกข้อมูลตำแหน่งบุคคลากร เสร็จเรียบร้อย')),
                        'positonY' => 'top',
                        'positonX' => 'right'
                    ]);
                    return $this->redirect('add-directors');
                }
            }else{
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'warning',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Duplicate')),
                    'message' => Yii::t('app', Html::encode('บันทึกข้อมูลซ้ำ')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
            }
        }
        $searchModel = new BoardSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $searchModel2 = new PositionSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        $searchModel3 = new PeriodSearch();
        $dataProvider3 = $searchModel3->search(Yii::$app->request->queryParams);

        $modelPerson = Person::find()->all();
        $modelDirector = PositionDirectors::find()->all();
        $modelPeriod = Period::find()->all();
        $modelPosition = PositionDirectors::find()->all();

        $this->layout = "main_modules_for_extenkrajee";
        return $this->render('add-directors', [
            'modelPerson' => $modelPerson,
            'modelPeriod' => $modelPeriod,
            'modelPosition' => $modelPosition,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelDirector'=> $modelDirector,
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
            'searchModel3' => $searchModel3,
            'dataProvider3' => $dataProvider3,

        ]);
    }
    public function actionView($board_id, $person_id, $director_id, $period_id)
    {
        $this->layout = "main_modules";
        return $this->render('directors_view', [
            'model' => $this->findModel($board_id, $person_id, $director_id, $period_id),
        ]);
    }

    public function actionUpdate($board_id, $person_id, $director_id, $period_id)
    {
        $model = $this->findModel($board_id, $person_id, $director_id, $period_id);
        $this->layout = "main_modules";
        $modelPerson = Person::find()->all();
        $modelPeriod = Period::find()->all();
        $modelDirector = PositionDirectors::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Update Complete')),
                'message' => Yii::t('app',Html::encode('แก้ไขข้อมูลตำแหน่งบุคคลากรเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(
                [
                    'view', 'board_id' => $model->board_id,
                    'person_id' => $model->person_id,
                    'director_id' => $model->director_id,
                    'period_id' => $model->period_id
                ]);
        } else {
            return $this->render('directors_update', [
                'model' => $model,
                'modelPerson' => $modelPerson,
                'modelDirector'=> $modelDirector,
                'modelPeriod' =>$modelPeriod,
            ]);
        }
    }
    public function actionSearch($search){
        $modelEdit = "";
        $request = \Yii::$app->request;
        if ($request->isGet && $search != null) {
            $modelBoard = BoardOfDirectors::find()
                ->leftJoin(Person::tableName(), BoardOfDirectors::tableName() . '.person_id = ' . Person::tableName() . '.person_id')
                ->leftJoin(PositionDirectors::tableName(), BoardOfDirectors::tableName() . '.director_id = ' . PositionDirectors::tableName() . '.director_id')
                ->leftJoin(Period::tableName(), BoardOfDirectors::tableName() . '.period_id = ' . Period::tableName() . '.period_id')
                ->where(Person::tableName() . '.person_name LIKE' . "'%" . $search . "%'")
                ->orWhere(Period::tableName().'.period_describe Like'."'%" . $search. "%'")
                ->orWhere(PositionDirectors::tableName().'.position_name Like'."'%" . $search. "%'")
                ->all();
        }else{
            $modelBoard = BoardOfDirectors::find()
                ->leftJoin(Person::tableName(), BoardOfDirectors::tableName() . '.person_id = ' . Person::tableName() . '.person_id')
                ->leftJoin(PositionDirectors::tableName(), BoardOfDirectors::tableName() . '.director_id = ' . PositionDirectors::tableName() . '.director_id')
                ->leftJoin(Period::tableName(), BoardOfDirectors::tableName() . '.period_id = ' . Period::tableName() . '.period_id')
                ->all();
        }
        $modelPosition = PositionDirectors::find()->all();
        $modelPerson = Person::find()->select(['person_id','person_name','person_surname'])->all();
        $modelPeriod = Period::find()->all();

        $this->layout = "main_modules";
        return $this->render('add-directors',
            [
                'modelPosition' => $modelPosition,
                'modelPerson' => $modelPerson,
                'modelPeriod' => $modelPeriod,
                'modelBoard' => $modelBoard,
                'modelEdit' => ""

            ]);

    }

    public function actionDeletedirec($board_id, $person_id, $director_id, $period_id)
    {
        $this->findModel($board_id, $person_id, $director_id, $period_id)->delete();
        Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Delete Complete')),
            'message' => Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['add-directors']);
    }

    protected function findModel($board_id, $person_id, $director_id, $period_id)
    {
        if (($model = BoardOfDirectors::findOne(['board_id' => $board_id, 'person_id' => $person_id, 'director_id' => $director_id, 'period_id' => $period_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
//------------------------------------
    public function actionAddPosition(){
        $model2 = new PositionDirectors();
        $this->layout = "main_modules";
        if ($model2->load(Yii::$app->request->post()) && $model2->save()) {
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app',Html::encode('บันทึกข้อมูลตำแหน่งบริหาร เสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect('add-directors?active=2');
        }else{
            return $this->redirect('add-directors');
        }
    }
    public function actionPositionView($id)
    {
        $this->layout = "main_modules";
        return $this->render('position_view', [
            'model' => $this->findModelPosition($id),
        ]);
    }
    public function actionPositionUpdate($id)
    {
        $model = $this->findModelPosition($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['position-view', 'id' => $model->director_id]);
        }
        $this->layout = "main_modules";
        return $this->render('position_update', [
            'model' => $model,
        ]);
    }
    public function actionPositionDelete($id)
    {

        if(!BoardOfDirectors::find()->where(['director_id'=>$id])->all()){
            $this->findModelPosition($id)->delete();
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Delete Complete')),
                'message' => Yii::t('app', Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['add-directors?active=2&#table']);
        }else{
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'warning',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Cannot Delete')),
                'message' => Yii::t('app', Html::encode('ไม่สามารถลบข้อมูลนี้ได้ เนื่องจากมีการใช้งานข้อมูลนี้อยู่')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['add-directors?active=2&#table']);

        }
    }

    protected function findModelPosition($id)
    {
        if (($model = PositionDirectors::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//------------------------------------
    public function actionAddPeriod(){
        $model3 = new Period();
        $this->layout = "main_modules";
        if ($model3->load(Yii::$app->request->post()) && $model3->save()) {

            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app',Html::encode('บันทึกข้อมูลสมัยการดำรงตำแหน่ง เสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect('add-directors?active=3');
        }else{
            return $this->redirect('add-directors?active=3');
        }
    }

    public function actionPeriodView($id)
    {
        $this->layout = "main_modules";
        return $this->render('period_view', [
            'model' => $this->findModelPeriod($id),
        ]);
    }

    public function actionPeriodUpdate($id)
    {
        $model = $this->findModelPeriod($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'success',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Submission')),
                'message' => Yii::t('app',Html::encode('แก้ไขข้อมูลสมัยการดำรงตำแหน่ง เสร็จเรียบร้อย')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['period-view', 'id' => $model->period_id]);
        }
        $this->layout = "main_modules";
        return $this->render('period_update', [
            'model' => $model,
        ]);
    }

    public function actionPeriodDelete($id)
    {
        if(!BoardOfDirectors::find()->where(['period_id'=>$id])->all()){
            $this->findModelPeriod($id)->delete();
        Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Delete Complete')),
            'message' => Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['add-directors?active=3&#table']);
        }else{
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'warning',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Cannot Delete')),
                'message' => Yii::t('app',Html::encode('ไม่สามารถลบข้อมูลนี้ได้ เนื่องจากมีการใช้งานข้อมูลนี้อยู่')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
            return $this->redirect(['add-directors?active=3&#table']);

    }
    }
    protected function findModelPeriod($id)
    {
        if (($model = Period::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreateLevelBachelor()
    {

        $model = new BranchHasLevel();

            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('alert1', [
                    'type' => 'success',
                    'duration' => 12000,
                    'icon' => 'fa fa-users',
                    'title' => Yii::t('app', Html::encode('Submission')),
                    'message' => Yii::t('app', Html::encode('บันทึกข้อมูล เสร็จเรียบร้อย')),
                    'positonY' => 'top',
                    'positonX' => 'right'
                ]);
                return $this->redirect(['add-program-major', 'active' => 3]);

        }else{
            Yii::$app->getSession()->setFlash('alert1', [
                'type' => 'warning',
                'duration' => 12000,
                'icon' => 'fa fa-users',
                'title' => Yii::t('app', Html::encode('Cannot Create')),
                'message' => Yii::t('app',Html::encode('ไม่สามารถเพิ่มระดับการศึกษาซ้ำได้')),
                'positonY' => 'top',
                'positonX' => 'right'
            ]);
        }
        return $this->redirect(['add-program-major','active'=>3]);
    }
    public function actionDeleteLevel($id)
    {
        $this->findModelLevel($id)->delete();
        Yii::$app->getSession()->setFlash('alert1', [
            'type' => 'success',
            'duration' => 12000,
            'icon' => 'fa fa-users',
            'title' => Yii::t('app', Html::encode('Delete Complete')),
            'message' => Yii::t('app',Html::encode('ลบข้อมูลเสร็จเรียบร้อย')),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
        return $this->redirect(['add-program-major','active'=>3]);
    }

    protected function findModelLevel($id)
    {
        if (($model = BranchHasLevel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
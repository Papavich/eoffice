<?php

namespace app\modules\portfolio\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\db\Query;

/**
 * Site controller.
 * It is responsible for displaying static pages, and logging users in and out.
 */
class DepartmentController extends BackendController {

    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */

    /**
     * Declares external actions for the controller.
     *
     * @return array
     */
    /*public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }*/

    public function actionIndex() {
        
        $query = new Query();
        $department = $query->select(['department_id','department_name'])
                    ->from('department')
                    ->all();
        
         $id = 30;
         $department = $query->select(['department_id','department_name'])
                 ->from('department')->where(['department_id' => $id])->all();
        
        $search = 'สาขา';
        $department = $query->from('department')
                ->where([
                    'like','department_name',$search
                ])->all();
        
        //order by
        //$department = $query->from('department')->orderBy('department_id DESC')->all();
        $department = $query->from('department')
                ->orderBy([
                   'department_name' => SORT_ASC,
                ])->all();
        
        $count = $query->from('department')->count();
        //$department = $query->from('department')->all(); //SELECT * FROM department
        
        //$max = $query->from('department')->max('department_id');
        //$sum = $query->from('person')->max('salary');
        
        $sql = $query->from('department')
                ->orderBy([
                   'department_name' => SORT_ASC,
                ])->createCommand();
        
        
    return $this->render('index', [
                    'departments' => $department,
                    'count' => $count,
                    'sql' => $sql,
        ]);
    }

    public function actionDelete($id) {
        Yii::$app->db->createCommand()->delete('department', ['department_id' => $id])->execute();
        return $this->redirect(['index']);
    }

   /*/ public function actionGrid() {
        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM position')->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => 'SELECT * FROM position',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }*/

}

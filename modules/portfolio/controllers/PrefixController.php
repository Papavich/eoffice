<?php

namespace app\modules\portfolio\controllers;

use Yii;
use app\modules\portfolio\models\Prefix;
use app\modules\portfolio\models\PrefixSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\caching\DbCache;

/**
 * PrefixController implements the CRUD actions for Prefix model.
 */
class PrefixController extends BackendController
{

    /**
     * Lists all Prefix models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cache = new DbCache();
        $key = 'demo';
        $data = $cache->get($key);
        if ($data === false) {
            $searchModel = new PrefixSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $cache->set($key, $data, 100, null);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prefix model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prefix model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prefix();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->prefix_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Prefix model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->prefix_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Prefix model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prefix model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Prefix the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prefix::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionExcel() {
        
        $model = Prefix::find()->all();
        
        return \moonland\phpexcel\Excel::widget([
                'models' => $model,
                'mode' => 'export', //default value as 'export'
                'fileName' => time(),
                'format' => 'Excel2007',
               // 'columns' => ['prefix_id','prefix_name'], //without header working, because the header will be get label from attribute label. 
               // 'header' => ['prefix_id' => 'รหัสคำนำหน้า','prefix_name' => 'รายละเอียด'], 
            ]);
    }
    
    public function actionImport() {
        //C:\xampp\htdocs\yiiexpert\uploads\data.xlsx
        $data = \moonland\phpexcel\Excel::widget([
            'mode' => 'import', 
            'fileName' => 'C:\xampp\htdocs\yiiexpert\uploads\data.xlsx', 
            //'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
           // 'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
            'getOnlySheet' => 'Sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
        ]);
        
        //echo print_r($data);
        //insert data array to table        
        foreach ($data as $key => $value) {
            Yii::$app->db->createCommand()->insert('prefix', [
                'prefix_id' => $value['prefix_id'],
                'prefix_name' => $value['prefix_name'],
            ])->execute();
        }
        
        return $this->redirect(['index']);
    }
}

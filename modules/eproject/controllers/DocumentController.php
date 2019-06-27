<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 5/7/2560
 * Time: 16:48
 */

namespace app\modules\eproject\controllers;


use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use app\modules\eproject\models\Download;
use Yii;
use yii\base\Exception;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class DocumentController extends Controller
{
    const DOCUMENT_PAGE_SIZE =10;
    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Download::find()->orderBy( 'crtime DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>self::DOCUMENT_PAGE_SIZE]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'data' => $models,
            'pages' => $pages,
        ]);
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Download();
        if($model->load(Yii::$app->request->post())){
            try{
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file = $model->uploadFile(); //method return ชื่อไฟล์
                $model->save();//บันทึกข้อมูล
                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );

                return $this->redirect(['index']);
            }catch(Exception $e){
                Yii::$app->session->setFlash( 'warning', controllers::t('label','Something Went Wrong') );
                return $this->redirect(['index']);
            }
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }


    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post())){
            try{
                $model->file = UploadedFile::getInstance($model, 'file');//upload หลายไฟล์ getInstances (เติม s)
                $model->file = $model->uploadFile();//method return ชื่อไฟล์ aaaa.aaa, bbbb.bbb,
                $model->save();//บันทึกข้อมูล
                Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
                return $this->redirect(['index']);
            }catch(Exception $e){
                Yii::$app->session->setFlash( 'warning', controllers::t('label','Something Went Wrong') );
                return $this->redirect(['index']);
            }
        }else{
            return $this->render('update', [
                'model' => $model
            ]);
        }

    }


    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id); //โหลด record ที่ต้องการมา
        try {
            if(!is_dir(Yii::getAlias('@webroot').'/' .$model->filePath)&&file_exists(Yii::getAlias('@webroot').'/' .$model->filePath)){
                unlink(Yii::getAlias('@webroot').'/' .$model->filePath); //ลบไฟล์ออก
            }
            $model->delete();//บันทึกข้อมูลใหม่
            Yii::$app->session->setFlash( 'success', controllers::t('label','Data Saved Successful') );
            return $this->redirect(['index']);
        } catch (Exception $e) {
            Yii::$app->session->setFlash( 'warning', controllers::t('label','Something Went Wrong') );
            return $this->redirect(['index']);
        }
    }


    /**
     * @param $id
     * @return static
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Download::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
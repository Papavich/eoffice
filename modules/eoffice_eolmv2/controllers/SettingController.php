<?php

namespace app\modules\eoffice_eolmv2\controllers;


use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\eoffice_eolmv2\components\ModelHelper;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_eolmv2\models\EolmSigner;
use app\modules\eoffice_eolmv2\models\EolmRateCost;
use app\modules\eoffice_eolmv2\models\EolmVehicleCost;

class SettingController extends Controller
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
    public function actionDownload(){
        $url= $_GET["url"];
        $path = \Yii::getAlias('@webroot') . "/$url";

        $file = $path;

        if (file_exists($file)) {

            \Yii::$app->response->SendFile($file);
        }
    }

    public function actionIndex()
    {
        $this->layout = "main_modules";
        $model1 = EolmSigner::find()->where(['eolm_signer_type_id' => 1])->one();
        $model2 = new EolmRateCost();
        $model1->person_ids = EolmSigner::find()->where(['eolm_signer_type_id' => 2])->one();

        $model=EolmVehicleCost::find()->where(['eolm_vehicle_cost_id'=>1])->one();
        $m=EolmVehicleCost::find()->where(['eolm_vehicle_cost_id'=>2])->one();

        $model->vehicle2=$m->getAttribute('eolm_vehicle_cost');
        if ($model1->load(Yii::$app->request->post())) {
            $model1->eolm_signer_type_id = 1;
            $model1->save();
            EolmSigner::deleteAll('eolm_signer_type_id = 2');
            $post = Yii::$app->request->post();
            $postModel = $post['EolmSigner'];
            $postModelMulti=  $postModel['person_ids'];
            if ( !empty( $postModelMulti) ){
                foreach ($postModelMulti as $key => $value) {
                    $newModel = new EolmSigner();
                    $newModel->eolm_signer_type_id = 2;
                    $newModel->person_id = $value;
                    $newModel->save();
                }
            }
            Yii::$app->session->setFlash( 'success', "แก้ไขผู้ลงนามสำเร็จ" );
            return $this->redirect('index');

        }elseif($model2->load(Yii::$app->request->post())) {
            $post=EolmRateCost::find()->where(['academic_positions_id'=>$model2->academic_positions_id])->one();
            if (empty($post)){
                $model2->save();
                Yii::$app->session->setFlash( 'success', "บันทึกอัตราเบี้ยเลี้ยงสำเร็จ" );
                return $this->redirect('index');
            }else{
                Yii::$app->db_eolm->createCommand()
                    ->update('eolm_rate_cost', [
                        'eolm_pos_singlebed_rate' => $model2->eolm_pos_singlebed_rate,
                        'eolm_pos_twinbeds_rate'=> $model2->eolm_pos_twinbeds_rate,
                        'eolm_pos_allowance_rate'=>$model2->eolm_pos_allowance_rate,
                        'eolm_pos_twinbeds_rate2'=> $model2->eolm_pos_twinbeds_rate2,
                        'eolm_pos_singlebed_rate2' => $model2->eolm_pos_singlebed_rate2,],
                        'academic_positions_id='.$model2->academic_positions_id)
                    ->execute();
                Yii::$app->session->setFlash( 'success', "แก้ไขอัตราเบี้ยเลี้ยงสำเร็จ" );
                return $this->redirect('index');
            }


        }elseif($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->db_eolm->createCommand()
                ->update('eolm_vehicle_cost', ['eolm_vehicle_cost' => $model->vehicle2], 'eolm_vehicle_cost_id =2')
                ->execute();
            Yii::$app->session->setFlash( 'success', "แก้ไขค่ายานพาหนะสำเร็จ" );
            return $this->redirect('index');

        }elseif (!\Yii::$app->request->isPost){
            $model1->load(Yii::$app->request->get());
            $model1->person_ids = ArrayHelper::map(EolmSigner::find()->where(['eolm_signer_type_id' => 2])->all(), 'person_id', 'person_id');
            $model2->load(Yii::$app->request->get());
            $model->load(Yii::$app->request->get());
        }
        return $this->render('index', [
            'model1' => $model1,
            'model2' => $model2,
            'model' =>$model,
        ]);



    }
    public function actionGetRate($positionId){
    $position = EolmRateCost::findOne($positionId);
    echo Json::encode($position);

}
}
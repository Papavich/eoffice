<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/5/2018
 * Time: 11:50 PM
 */

namespace app\modules\personsystem\controllers;



use app\modules\personsystem\models\Amphur;
use app\modules\personsystem\models\District;
use yii\helpers\Json;
use yii\web\Controller;

class AddressController extends Controller
{
    public function actionGetAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
                $data = $this->getDistrict($amphur_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    protected function getAmphur($id){
        $datas = Amphur::find()->where(['PROVINCE_ID'=>$id])->all();
        return $this->MapData($datas,'AMPHUR_ID','AMPHUR_NAME');
    }
    protected function getDistrict($id){
        $datas = District::find()->where(['AMPHUR_ID'=>$id])->all();
        return $this->MapData($datas,'DISTRICT_ID','DISTRICT_NAME');
    }
    protected function MapData($datas,$fieldId,$fieldName){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
        }
        return $obj;
    }


}
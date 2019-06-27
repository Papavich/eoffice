<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30/4/2561
 * Time: 2:50
 */

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use app\modules\eoffice_materialsys\models\MatsysOrderSearch;
use app\modules\eoffice_materialsys\models\User;
use yii\db\Exception;
use yii\web\Controller;

class ListwidenController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['list']);
    }

    public function actionList()
    {
        $searchModel = new MatsysOrderSearch();
        $modelMaterial = new MatsysOrder();
        $url_params = \Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, ['pagination' => ['pageSize' => 5]]);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelMateril' => $modelMaterial,
        ]);
    }

    public function actionGetdetailuser()
    {
        header('Content-Type: application/json');
        $user_id = \Yii::$app->request->post('user_id');
        $order_id = \Yii::$app->request->post('order_id');
        $user = [];
        $userFind = User::find()
            ->where('id = :id', [':id' => $user_id])
            ->one();
        $order = MatsysOrder::find()
            ->where('order_id = :order_id', [':order_id' => $order_id])
            ->one();
        if ($order->orderDetail->detail->detail_id == 'D001') {
            $detail = $order->orderDetail->detail->detail_name . " รายละเอียด :  รหัสโครงการ " . $order->orderDetail->order_detail_name_id . " ชื่อโครงการ " . $order->orderDetail->order_detail_name . " " . $order->orderDetail->order_detail;
        } elseif ($order->orderDetail->detail->detail_id == 'D002') {
            $detail = $order->orderDetail->detail->detail_name . " รายละเอียด :  รหัสวิชาเรียน " . $order->orderDetail->order_detail_name_id . " ชื่อวิชาเรียน " . $order->orderDetail->order_detail_name . " " . $order->orderDetail->order_detail;
        } elseif ($order->orderDetail->detail->detail_id == 'D003') {
            $detail = $order->orderDetail->detail->detail_name . " รายละเอียด :  กิจกรรม " . $order->orderDetail->order_detail_name . " " . $order->orderDetail->order_detail;
        } elseif ($order->orderDetail->detail->detail_id == 'D004') {
            $detail = $order->orderDetail->detail->detail_name . " รายละเอียด : " . $order->orderDetail->order_detail;
        }
        array_push($user, ['name' => User::getFullnameobj($userFind)]);
        array_push($user, ['email' => $userFind->email]);
        array_push($user, ['phone' => $userFind->person_mobile]);
        array_push($user, ['detail' => $detail]);
        echo json_encode($user);
    }

    public function actionGetorderlist()
    {
        $order_id = \Yii::$app->request->post('order_id');
        $items = MatsysOrderHasMaterial::find()
            ->where('order_id = :order_id', [':order_id' => $order_id])
            ->all();
        foreach ($items as $key => $value) {
            echo "<tr>
                                <td name='ta-material'>".$value->material_id."</td>
                                <td>".$value->materialdetail->material_name."</td>
                                <td>".$value->material_amount." ".$value->materialdetail->material_unit_name."</td>
                                <td><input name='bill_master' type='hidden' value='".$value->bill_master_id."'><input name='ta-amount' class=\"form-control\" style=\"width: 60% !important;display: inline-block\" type=\"number\" max=\"".$value->material_amount."\" min=\"0\" value=\"".$value->material_amount."\">/".$value->material_amount." ".$value->materialdetail->material_unit_name."</td>
                            </tr>";
        }
    }

    public function actionConfirm(){
        $order_id = \Yii::$app->request->post('order_id');
        $items = \Yii::$app->request->post('items');
        $detail = \Yii::$app->request->post('detail');
        try{
            date_default_timezone_set("Asia/Bangkok");
            $date = date('Y-m-d G:i:s');
            $person_id = \Yii::$app->user->identity->getId();
            $order = MatsysOrder::findOne($order_id);
            $order->order_date_accept = $date;
            $order->order_status = '1';
            $order->order_staff = $person_id;
            $order->order_cancel_description = $detail;
            $order->save(false);
            foreach ($items as $key => $value){
                $material_id = $value['material_id'];
                $amount = $value['material_amount'];
                $bill_master = $value['bill_master'];
                $order_material = MatsysOrderHasMaterial::find()
                    ->where('order_id = :order_id',[':order_id'=>$order_id])
                    ->andwhere('material_id = :material_id',[':material_id'=>$material_id])
                    ->andWhere('bill_master_id = :bill_master',[':bill_master'=>$bill_master])
                    ->one();
                if($amount == $order_material->material_amount) {
                    $order_material->material_amount_receive = $amount;
                    $order_material->save(false);
                }else{
                    $amount_left = $order_material->material_amount-$amount;
                    $order_material->material_amount_receive = $amount;
                    $order_material->save(false);
                    $bill_detail = MatsysBillDetail::find()
                        ->where('material_id = :material_id',[':material_id'=>$material_id])
                        ->andWhere('bill_master_id = :bill_master_id',[':bill_master_id'=>$order_material->bill_master_id])
                        ->one();
                    $bill_detail->bill_detail_use_amount += $amount_left;
                    $bill_detail->save(false);
                }
            }
            echo "pass";
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function actionCancel(){
        $order_id = \Yii::$app->request->post('order_id');
        $items = \Yii::$app->request->post('items');
        $detail = \Yii::$app->request->post('detail');
        try{
            $person_id = \Yii::$app->user->identity->getId();
            $order = MatsysOrder::findOne($order_id);
            $order->order_status = '2';
            $order->order_cancel_description = $detail;
            $order->order_staff = $person_id;
            $order->save(false);
            foreach ($items as $key => $value){
                $material_id = $value['material_id'];
                $bill_master = $value['bill_master'];
                $order_material = MatsysOrderHasMaterial::find()
                    ->where('order_id = :order_id',[':order_id'=>$order_id])
                    ->andwhere('material_id = :material_id',[':material_id'=>$material_id])
                    ->andWhere('bill_master_id = :bill_master',[':bill_master'=>$bill_master])
                    ->one();
                $order_material->material_amount_receive = 0;
                $order_material->save(false);
                $bill_detail = MatsysBillDetail::find()
                    ->where('material_id = :material_id',[':material_id'=>$material_id])
                    ->andWhere('bill_master_id = :bill_master_id',[':bill_master_id'=>$order_material->bill_master_id])
                    ->one();
                $bill_detail->bill_detail_use_amount += $order_material->material_amount;
                $bill_detail->save(false);
            }
            echo "pass";
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
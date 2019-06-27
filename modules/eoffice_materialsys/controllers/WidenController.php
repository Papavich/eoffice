<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/3/2561
 * Time: 10:20
 */

namespace app\modules\eoffice_materialsys\controllers;

use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysBillMaster;
use app\modules\eoffice_materialsys\models\MatsysLocation;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysMaterialType;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\MatsysOrderDetail;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;

use app\modules\eoffice_materialsys\models\Person;
use app\modules\eoffice_materialsys\models\User;
use app\modules\eoffice_materialsys\models\FunDate;


class WidenController extends Controller
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

    public function actionIndex()
    {
        if (Yii::$app->user->identity->getId()) {
            return $this->redirect(['widen/widenlist']);
        } else {
            return $this->redirect(Yii::$app->homeUrl);
        }
    }

    public function actionWidenlist()
    {
        $model = "";

        $person_id = Yii::$app->user->identity->getId();
        $user = User::find()->where('id = :id', [':id' => $person_id])->one();
        $person = Person::find()->where('id = :id', [':id' => $user->id])->one();

        if (MatsysOrder::searchConfirmbill($person_id) != 'false') {
            $bill = MatsysOrder::searchConfirmbill($person_id);
            $items = MatsysOrderHasMaterial::getMainmaterial($bill->order_id);
        } else {
            $bill = null;
            $items = null;
        }

        return $this->render('index', [
            'id' => $person_id,
            'model' => $model,
            'user' => $user,
            'person' => $person,
            'bill' => $bill,
            'items' => $items
        ]);
    }

    public function actionCreateordermaster()
    {
        $person_id = Yii::$app->user->identity->getId();
        $model_detail_order = new MatsysOrderDetail();
        $model_detail_order->order_detail_id = FunDate::genOrderdetailid($person_id);
        $model_detail_order->order_detail = Yii::$app->request->post('order_detail');
        $model_detail_order->order_detail_name = Yii::$app->request->post('order_detail_name');
        $model_detail_order->order_detail_name_id = Yii::$app->request->post('order_detail_name_id');
        $model_detail_order->detail_id = Yii::$app->request->post('detail_id');
        $model_detail_order->save(false);

        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d G:i:s');

        $model_order = new MatsysOrder();
        $model_order->order_id = FunDate::genBillId($person_id);
        $model_order->person_id = $person_id;
        $model_order->order_date = $date;
        $model_order->order_staff = 'not';
        $model_order->order_status = '0';
        $model_order->order_status_confirm = 'unconfirm';
        $model_order->order_status_notification = 'notread';
        $model_order->order_status_return = '0';
        $model_order->order_budget_per_year = FunDate::getBudgetyear();
        $model_order->order_cancel_description = '-';
        $model_order->order_detail_id = $model_detail_order->order_detail_id;
        $model_order->save(false);

        echo "pass";

    }

    public function actionSearchproductjson()
    {
        if (\Yii::$app->request->get()) {
            $value = \Yii::$app->request->get("value");
            if (!isset($value)) {
                $value = "------";
            }
            $ajaxresulall = [];
            $resultnot = $value;
            $value = "%" . $value . "%";
            $result = MatsysMaterial::find()
                ->where('material_name LIKE :value', [':value' => $value])
                ->orWhere('material_id LIKE :value2',[':value2' => $value])
                ->limit(10)
                ->all();


            //JSON
            if ($result) {
                foreach ($result as $obj) {
                    $type = MatsysMaterialType::findOne($obj["material_type_id"]);
                    $location = MatsysLocation::findOne($obj["location_id"]);
                    $json_location = [
                        'location_id' => $location['location_id'],
                        'location_name' => $location['location_name']
                    ];
                    $json_type = [
                        'material_type_id' => $type["material_type_id"],
                        'material_type_name' => $type["material_type_name"]
                    ];
                    $ajaxresul_obj = [
                        'id' => $obj["material_id"],
                        'material_name' => $obj["material_name"],
                        'material_amount_check' => $obj["material_amount_check"],
                        'material_order_count' => $obj["material_order_count"],
                        'material_unit_name' => $obj["material_unit_name"],
                        'material_image' => $obj["material_image"],
                        'material_amount_all' => MatsysMaterial::amountAll($obj["material_id"]),
                        'location' => $json_location,
                        'material_type' => $json_type,
                    ];
                    array_push($ajaxresulall, $ajaxresul_obj);
                }
                $ajaxresult = ['resultajax' => $ajaxresulall];
                return json_encode($ajaxresult, JSON_UNESCAPED_UNICODE);
            } else {
                echo "<option id=\"notFound\" class='option' value=\"ไม่พบข้อมูล'" . $resultnot . "'\" />";
            }

        } else {
            return "false method not post";
        }
    }

    public function actionAdditem()
    {
        try {
            $amount = Yii::$app->request->post('amount');
            $material_id = Yii::$app->request->post('material_id');
            $this->cutStock($material_id, $amount);

            $person_id = Yii::$app->user->identity->getId();
            $material = MatsysMaterial::findOne($material_id);
            $allAmount = MatsysMaterial::amountAll($material_id);
            $bill = MatsysOrder::searchConfirmbill($person_id);
            $items = MatsysOrderHasMaterial::find()
                ->where('order_id = :order_id', [':order_id' => $bill->order_id])
                ->andWhere('material_id = :material_id', [':material_id' => $material_id])
                ->all();

            echo "<tr id='mat-" . $material->material_id . "'>
                    <td>1</td>
                    <td data-id='tb-material_id''>" . $material->material_id . "</td>
                    <td style='text-align: center'><img src=\"" . Yii::getAlias('@web') . "/web_mat/images/" . $material->material_image . "\" style='width: 50px' class=\"cs-image-table\"></td>
                    <td data-id='tb-material_name'>" . $material->material_name . "</td>
                    <td><input type=\"number\" data-id='" . $amount . "' value=\"" . $amount . "\" min=\"0\" max=\"" . ($allAmount + $amount) . "\" class=\"cs-amount-table\">/" . ($allAmount + $amount) . " <span>" . $material->material_unit_name . "</span></td>
                    <td>";
            $allPrice = 0;
            foreach ($items as $key => $value) {
                $allPrice += ($value->material->bill_detail_price_per_unit * $value->material_amount);
                echo "
                        <div><span style=\"display: inline-block;width: 50px\">" . number_format($value->material->bill_detail_price_per_unit, 2) . "</span> บาท <span class=\"pull-right\">จำนวน " . $value->material_amount . " " . $material->material_unit_name . "</span></div>";
            }
            echo "</td>
                    <td  name='allprice-material'>" . number_format($allPrice, 2) . "</td>
                    <td>
                        <div align=\"center\">
                            <button type=\"button\"
                                    class=\"btn btn-danger btn-sm glyphicon glyphicon-trash\" data-toggle=\"modal\"
                                                                   data-target=\"#ModalConfrimdelete\"></button>
                        </div>
                    </td>
                </tr>";
        } catch (Exception $e) {
            echo "false";
        }
    }

    public function cutStock($material_id, $amount)
    {

        $person_id = Yii::$app->user->identity->getId();
        $bill = MatsysOrder::searchConfirmbill($person_id);

        do {
            $item_stock = MatsysBillDetail::find()->joinWith('billMaster')
                ->where('matsys_bill_detail.material_id = :material_id', [':material_id' => $material_id])
                ->andWhere('matsys_bill_detail.bill_detail_use_amount != 0')
                ->orderBy('matsys_bill_master.bill_master_date')
                ->one();

            $item = new MatsysOrderHasMaterial();
            if ($item_stock->bill_detail_use_amount > $amount) {

                $item_stock->bill_detail_use_amount -= $amount;

                $item_stock->save(false);

                $item->material_amount = $amount;
                $item->material_amount_receive = null;
                $item->order_id_ai = $bill->order_id_ai;
                $item->order_id = $bill->order_id;
                $item->material_id = $material_id;
                $item->bill_master_id = $item_stock->bill_master_id;
                $item->save(false);

                $amount = 0;
            } else {
                $amount -= $item_stock->bill_detail_use_amount;

                $item->material_amount = $item_stock->bill_detail_use_amount;
                $item->material_amount_receive = null;
                $item->order_id_ai = $bill->order_id_ai;
                $item->order_id = $bill->order_id;
                $item->material_id = $material_id;
                $item->bill_master_id = $item_stock->bill_master_id;
                $item->save(false);

                $item_stock->bill_detail_use_amount = 0;
                $item_stock->save(false);
            }
        } while ($amount > 0);
    }

    public function actionCheckmaterialinorder()
    {
        $mat_id = Yii::$app->request->post("material_id");
        $order_id = Yii::$app->request->post("order_id");
        $result = MatsysOrderHasMaterial::find()
            ->where('material_id = :material_id', [':material_id' => $mat_id])
            ->andWhere('order_id = :order_id', [':order_id' => $order_id])
            ->all();
        if ($result == null) {
            echo "pass";
        } else {
            echo "false";
        }
    }

    public function actionEditamount()
    {
        $material_id = Yii::$app->request->post('material_id');
        $amount = Yii::$app->request->post('new_amount');
        $order_id = Yii::$app->request->post('order_id');
        $this->deleteOrderMaterial($material_id, $order_id);
        $this->cutStock($material_id, $amount);
    }

    public function actionDeletelist()
    {
        $material_id = Yii::$app->request->post("delete-material_id");
        $order_id = Yii::$app->request->post("delete-bill_id");
        $this->deleteOrderMaterial($material_id, $order_id);

    }

    public function deleteOrderMaterial($material_id, $order_id)
    {
        try {
            $item = MatsysOrderHasMaterial::find()
                ->where('order_id = :order_id', [':order_id' => $order_id])
                ->andWhere('material_id = :material_id', [':material_id' => $material_id])
                ->all();
            foreach ($item as $key => $value) {
                $material = MatsysBillDetail::find()
                    ->where('material_id = :material_id', [':material_id' => $value->material_id])
                    ->andWhere('bill_master_id = :bill_master_id', [':bill_master_id' => $value->bill_master_id])
                    ->one();
                $material->bill_detail_use_amount += $value->material_amount;
                $material->save(false);
                $item[$key]->delete();
            }
            echo "pass";
        } catch (Exception $e) {
            echo "false : " . $e->getMessage();
        }
    }

    public function actionConfirmorder()
    {
        try {
            $order_id = Yii::$app->request->post('order_id');
            $detail_id = Yii::$app->request->post('detail_id');
            $order_detail = Yii::$app->request->post('order_detail');
            $order_detail_name = Yii::$app->request->post('order_detail_name');
            $order_detail_name_id = Yii::$app->request->post('order_detail_name_id');


            $item = MatsysOrder::findOne($order_id);

            //Update Order Count
            $orderhasmat = MatsysOrderHasMaterial::find()
                ->where('order_id = :order_id',[':order_id'=>$item->order_id])
                ->all();
            foreach ($orderhasmat as $key => $value){
                $material = MatsysMaterial::findOne($value->material_id);
                if($material->material_order_count == null){
                    $material->material_order_count = 1;
                }else{
                    $material->material_order_count++;
                }
                $material->save(false);
            }

            $orderDetail = MatsysOrderDetail::findOne($item->order_detail_id);
            $detail_id_res = explode('D2',$detail_id);
            $orderDetail->detail_id = "D".$detail_id_res[1];
            $orderDetail->order_detail = $order_detail;
            $orderDetail->order_detail_name = $order_detail_name;
            $orderDetail->order_detail_name_id = $order_detail_name_id;
            $orderDetail->save(false);
            $item->order_status_confirm = "confirm";
            $item->save(false);
            echo "pass";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionCancelorder(){
        try{
            $order_id = Yii::$app->request->post('order_id');
            $order_has_mat = MatsysOrderHasMaterial::find()
                ->where('order_id = :order_id',[':order_id'=>$order_id])
                ->all();
            foreach ($order_has_mat as $key => $value){
                $this->deleteOrderMaterial($value->material_id,$order_id);
            }
            $order = MatsysOrder::findOne($order_id);
            $order_detail = MatsysOrderDetail::findOne($order->order_detail_id);
            $order->delete();
            $order_detail->delete();
            echo "pass";
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}
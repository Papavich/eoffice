<?php

namespace app\modules\materialsystem\controllers;

use app\modules\materialsystem\models\MatsysBillDetail;
use app\modules\materialsystem\models\MatsysDetail;
use app\modules\materialsystem\models\MatsysMaterial;
use app\modules\materialsystem\models\MatsysMaterialType;
use app\modules\materialsystem\models\MatsysOrder;
use app\modules\materialsystem\models\MatsysOrderHasMaterial;
use app\modules\materialsystem\models\MatsysOrderReturn;
use app\modules\materialsystem\models\MatsysBillMaster;
use app\modules\materialsystem\models\Person;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;


/**
 * Default controller for the `material` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'index';
        return $this->render('index');
    }

    public function actionInsert()
    {
        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'insert';
        return $this->render('insert');
    }

    public function actionKkufmis()
    {
        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'kkufmis';
        return $this->render('kkufmis');
    }

    public function actionList()
    {
        $query = MatsysMaterial::find();
        $mat_type = MatsysMaterialType::find()->all();
        $bill_detail = MatsysBillDetail::find()->all();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'list';
        return $this->render('list', ['mat' => $models, 'pages' => $pages, 'mat_type' => $mat_type, 'bill_detail' => $bill_detail]);
    }

    public function actionEditlist()
    {
        foreach ($_POST['mat_id'] as $value1) {
            $item1 = MatsysBillDetail::findOne($value1);
//            $item1->bill_detail_use_amount = $_POST['mat_use'];
            $item1->bill_detail_price_per_unit = $_POST['mat_price_per_unit'];
            $item1->save();
        }
        foreach ($_POST['mat_id'] as $value2) {
            $item2 = MatsysMaterial::findOne($value2);
            $item2->material_amount_check = $_POST['mat_min'];
            $item2->material_name = $_POST['mat_name'];
            $item2->material_detail = $_POST['mat_detail'];
            $item2->material_unit_name = $_POST['mat_name_price'];
            $item2->save();
        }
        \Yii::$app->session->setFlash( 'success', "บันทึกข้อมูลสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect('@web/materialsystem/default/list');
    }

    public function actionWiden_admin()
    {
        $query = MatsysOrder::find();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'widen';
        return $this->render('widen_admin', ['order' => $models, 'pages' => $pages]);
    }

    public function actionSaveitem()
    {

        foreach ($_POST['material_id'] as $key => $item) {
            $order_mat = MatsysOrderHasMaterial::find()->where(['material_id' =>$item])->one();
            if ($_POST['order_has_material_amount'][$key] == null) {
                $order_mat->material_amount_receive = $_POST['material_amount'][$key];
            } else {
                $order_mat->material_amount_receive = $_POST['order_has_material_amount'][$key];
            }
            $order_mat->save();
//            if (!$order_mat->save()) return print_r($order_mat->errors);
        }
        /*
            $model = MatsysBillDetail::findOne($item);

            echo "order_id";
            echo" ".($_POST['order_id'][$key]);
            echo "<br>";

            echo "material_id";
            echo" ".($_POST['material_id'][$key]);
            echo "<br>";

            echo "order_has_material_amount";
            if($_POST['order_has_material_amount'][$key] == null) {
                echo " wow";
            }else {
                echo " " . ($_POST['order_has_material_amount'][$key]);
            }
            echo "<br>";
            echo "<br>";
        }
        exit();*/
        /*
            $value = $_POST['order_has_material_amount'][$key];
            $model->bill_detail_use_amount = $model->bill_detail_use_amount - $value;
            $model->save();
        }*/
        /*
        foreach ($_POST['order_id'] as $orkey) {
            date_default_timezone_set("Asia/Bangkok");
            $order = MatsysOrder::findOne($orkey);
            $order->order_status = "2";
            $order->order_date_accept = date("Y-m-d");
            $order->order_staff = $_POST['name_admin'];
            $order->order_status_return = "1";
            $order->order_budget_per_year = "2560";
            //$order->order_date = date("Y-m-d H:i:s");
            echo $order->order_status;
            $order->save();
        }*/


        \Yii::$app->session->setFlash( 'success', "ทำรายการสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็จ
        return $this->redirect('@web/materialsystem/default/widen_admin');
    }

    public function actionCancelwiden()
    {
        foreach ($_POST['order_id_list'] as $value) {
            date_default_timezone_set("Asia/Bangkok");
            $order = MatsysOrder::findOne($value);
            $order->order_staff = $_POST['name_admin'];
            $order->order_status = '3';
            $order->order_budget_per_year = "2560";
            $order->order_cancel_description = $_POST['order_cancel_widen'];
            $order->order_date_accept = date("Y-m-d");
            $order->save();
        }
        \Yii::$app->session->setFlash( 'success', "ทำรายการสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็จ
        return $this->redirect('@web/materialsystem/default/widen_admin');
    }

    public function actionReturnmaterial()
    {
        $query = MatsysOrder::find();
        $order_return = MatsysOrderReturn::find()->all();

        $countQuery = clone $query;         //คำสั่งสร้าง Page แบ่งหน้า
        $pages = new Pagination( ['totalCount' => $countQuery->count(), 'pageSize' => 10] );
        $models = $query->offset( $pages->offset )
            ->limit( $pages->limit )
            ->all();

        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'returnmaterial';
        return $this->render('returnmaterial', ['order' => $models, 'pages' => $pages, 'order_return' => $order_return]);
    }

    public function actionSubmit_return()
    {
        foreach ($_POST['material_id_list'] as $key => $item) {
            date_default_timezone_set("Asia/Bangkok");
            $return_item = new MatsysOrderReturn();
            $return_amount = $_POST['order_return_amount_use'][$key];
            $return_item->order_return_amount_use += $return_item->order_return_amount - $return_amount;
            $return_item->order_return_date_accept = date('Y-m-d H:i:s');
            $return_item->save();
        }

        foreach ($_POST['order_id_list'] as $key => $item) {
            $order = MatsysOrder::findOne($item);
            $order->order_status_return = '3';
            $order->save();
        }
        \Yii::$app->session->setFlash( 'success', "ตรวจสอบวัสดุเรียบร้อย" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect('@web/materialsystem/default/returnmaterial');
    }


    public function actionSummary()
    {
        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'summary';
        return $this->render('summary');
    }

    public function actionGetmaterial()
    {
        $mat_stock = MatsysStockMaterial::find()->all();
        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'getmaterial';
        return $this->render('getmaterial', ['mat_stock' => $mat_stock]);
    }

    public function actionWiden()
    {
        $mat = MatsysMaterial::find()->limit(8)->all();
        $mat_type = MatsysMaterialType::find()->all();
        $mat_detail = MatsysDetail::find()->all();
        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'widen_user';
        $arr = \Yii::$app->session->get("cart");
        if (!\Yii::$app->session->has("cart"))  //ถ้าคลาสไม่ถูกเซตใน session จะเซตให้เป็น array ว่าง
            $arr = [];
        return $this->render('widen', ['mat' => $mat, 'mat_type' => $mat_type, 'mat_detail' => $mat_detail, 'arr' => $arr]);
    }

    public function actionAdd()
    {
        /* @var $mat \app\modules\materialsystem\models\MatsysMaterial */

//        $mat = MatsysMaterialHasStock::find()->where(['material_id' => $_POST['item_select']])->one();
//        return Json::encode($aa->material_has_image);

        $session = \Yii::$app->session;
        if (!isset($_SESSION["cart"])) {
            $session->set("cart", []);
        }
        $found = false;
        $temp = $session->get("cart");
        foreach ($temp as $key => $cart) {
            if ($cart["mat_id"] == \Yii::$app->request->post("item_select")) { //เชคว่า material_id ซ่้ากันหรือไม่ ถ้าใช่
                $cart["mat_amount"] += $_POST["num_select"]; //เอา amount ใหม่เพิ่มจำนวน amount เดิม
                $temp[$key] = $cart;    //ชี้ให้ temp ไปที่ $cart
                $session->set("cart", $temp); //เซท cart เก่า ให้เป็น cart ใหม่
                $found = true;
            }
        }
        if (!$found) {
            $cart = $session->get("cart");
            $mat = MatsysMaterial::find()->where(['material_id' => $_POST['item_select']])->one();
            $arr = [
                "mat_id" => $mat->material_id,
                "mat_name" => $mat->material_name,
                "mat_pic" => $mat->material_image,
                "mat_per_unit" => $mat->matsysBillDetails[0]->bill_detail_price_per_unit,
                "mat_name_unit" => $mat->material_unit_name,
                "mat_amount" => \Yii::$app->request->post("num_select"),
                "mat_price" => $mat->matsysBillDetails[0]->bill_detail_use_amount,
            //"order_date" => \Yii::$app->request->post(""),
            ];
            array_push($cart, $arr);
            $session->set("cart", $cart);
        }
        $session->get("cart");
        $this->redirect("@web/materialsystem/default/widen");
    }
    public function actionAdd_type(){
//        echo $_POST['type_selected']; echo "<br>";
//        echo $_POST['item_selected']; echo "<br>";
//        echo $_POST['num_selected']; echo "<br>";
//        echo $_POST['detail_selected']; echo "<br>"; exit();
        /* @var $mat \app\modules\materialsystem\models\MatsysMaterial */

        $session = \Yii::$app->session;
        if (!isset($_SESSION["cart"])) {
            $session->set("cart", []);
        }
        $found = false;
        $temp = $session->get("cart");
        foreach ($temp as $key => $cart) {
            if ($cart["mat_id"] == \Yii::$app->request->post("item_selected")) { //เชคว่า material_id ซ่้ากันหรือไม่ ถ้าใช่
                $cart["mat_amount"] += $_POST["num_selected"]; //เอา amount ใหม่เพิ่มจำนวน amount เดิม
                $temp[$key] = $cart;    //ชี้ให้ temp ไปที่ $cart
                $session->set("cart", $temp); //เซท cart เก่า ให้เป็น cart ใหม่
                $found = true;
            }
        }
        if (!$found) {
            $cart = $session->get("cart");
            $mat = MatsysMaterial::find()->where(['material_id' => $_POST['item_selected']])->one();
            $arr = [
                "mat_id" => $mat->material_id,
                "mat_name" => $mat->material_name,
                "mat_pic" => $mat->material_image,
                "mat_per_unit" => $mat->matsysBillDetails[0]->bill_detail_price_per_unit,
                "mat_name_unit" => $mat->material_unit_name,
                "mat_amount" => \Yii::$app->request->post("num_select"),
                "mat_price" => $mat->matsysBillDetails[0]->bill_detail_use_amount,
                //"mat_type" => $mat->material_type_id,
                //"order_date" => \Yii::$app->request->post(""),
            ];
            array_push($cart, $arr);
            $session->set("cart", $cart);
        }
        $session->get("cart");
        $this->redirect("@web/materialsystem/default/widen");
    }
}

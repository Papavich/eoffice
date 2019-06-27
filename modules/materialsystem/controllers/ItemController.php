<?php

namespace app\modules\materialsystem\controllers;

use app\modules\materialsystem\models\MatsysDetail;
use app\modules\materialsystem\models\MatsysOrder;
use app\modules\materialsystem\models\MatsysOrderDetail;
use app\modules\materialsystem\models\MatsysOrderHasMaterial;
use yii\helpers\Json;
use yii\web\Controller;

class ItemController extends Controller
{
    public function init()
    {
        \Yii::setAlias('@mat_assets', '@web/../modules/material_management/assets');
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function actionTest()
    {
        \Yii::$app->session->destroy();
    }

    public function actionAddcart()
    {
        $session = \Yii::$app->session;
        if (!isset($_SESSION["cart"])) {
            $session->set("cart", []);
        }
        $found = false;
        $temp = $session->get("cart");
        foreach ($temp as $key => $cart) {
            if ($cart["mat_id"] == \Yii::$app->request->post("mat_id")) { //เชคว่า material_id ซ่้ากันหรือไม่ ถ้าใช่
                $cart["mat_amount"] += $_POST["mat_amount"]; //เอา amount ใหม่เพิ่มจำนวน amount เดิม
                $temp[$key] = $cart;    //ชี้ให้ temp ไปที่ $cart
                $session->set("cart", $temp); //เซท cart เก่า ให้เป็น cart ใหม่
                $found = true;
            }
        }
        if (!$found) {
            $cart = $session->get("cart");
            $arr = [
                "mat_id" => \Yii::$app->request->post("mat_id"),
                "mat_name" => \Yii::$app->request->post("mat_name"),
                "mat_pic" => \Yii::$app->request->post("mat_pic"),
                "mat_per_unit" => \Yii::$app->request->post("mat_per_unit"),
                "mat_name_unit" => \Yii::$app->request->post("mat_name_unit"),
                "mat_detail" => \Yii::$app->request->post("mat_detail"),
                "mat_amount" => \Yii::$app->request->post("mat_amount"),
                "mat_price" => \Yii::$app->request->post("mat_price"),
                "order_date" => \Yii::$app->request->post("order_date"),
            ];
            array_push($cart, $arr);
            $session->set("cart", $cart);
        }


        $session->get("cart");
//
//        return $this->render('addcart', array('arr'=>$arr));

        $this->redirect("@web/materialsystem/default/widen");

        //return Json::encode($session->get("cart"));


//        $session->set("mat_id", \Yii::$app->request->post("mat_id"));
//        $session->set("mat_name", \Yii::$app->request->post("mat_name"));
//        $session->set("mat_detail", \Yii::$app->request->post("mat_detail"));
//        $session->set("mat_amount", \Yii::$app->request->post("mat_amount"));
//        print_r($session->get("mat_name"));
//        //print_r(\Yii::$app->request->post());
    }

    public function actionViewcart()
    {
//        return Json::encode(\Yii::$app->session->get("cart"));

        $this->layout = 'main_material';
        $this->view->params['statuspage'] = 'index';
        $mat_detail = MatsysDetail::find()->all();
        $arr = \Yii::$app->session->get("cart");
        if (!\Yii::$app->session->has("cart"))  //ถ้าคลาสไม่ถูกเซตใน session จะเซตให้เป็น array ว่าง
            $arr = [];
        return $this->render('addcart', array('arr' => $arr, 'mat_detail' => $mat_detail,));
    }

    public function actionDeletecart()
    {
        $index = $_POST['id_del'];
        $temp = [];
        $arr = \Yii::$app->session->get("cart");
        foreach ($arr as $key => $item) {
            if ($key != $index) {
                array_push($temp, $item);
            }
            \Yii::$app->session->set('cart', $temp);
        }
        if ($temp == []) {
            \Yii::$app->session->remove('cart');
        }
        return $this->redirect("@web/materialsystem/default/widen");
    }

    public function actionSubmit()
    {
//        echo "id :  "; echo $_POST['id_user']; echo "<br>";
//        echo "name :  "; echo $_POST['name_user']; echo "<br>";
//        echo "id_detail : ";echo $_POST['list_detail']; echo "<br>";
//
//        echo "code_de :  "; echo $_POST['detail_code']; echo "<br>";
//        echo "name_de :  "; echo $_POST['detail_name']; echo "<br>";
//        echo "description :  "; echo $_POST['detail_desc']; echo "<br>";
//
//        exit();
//        $ran_id_1 = (substr(md5(time()), 0, 5));
//        $ran_id_2 = (substr(md5(time()), 0, 3));
//        $ran_id = $ran_id_1.$ran_id_2;


        $order_detail = new MatsysOrderDetail();
        $order_detail->detail_id = $_POST['list_detail'];
        $order_detail->order_detail_id = "D".date("U");
        $order_detail->order_detail = $_POST['detail_desc'];
        $order_detail->order_detail_name = $_POST['detail_name'];
        $order_detail->order_detail_name_id = $_POST['detail_code'];
        if (!$order_detail->save()) return print_r($order_detail->errors);

        $order = new MatsysOrder();
        date_default_timezone_set("Asia/Bangkok");
        $order->order_id = "CS".date("U");
        $order->person_id = $_POST['id_user'];
        //$order->order_date = date("Y-m-d"); //กำหนดวันที่ในการเบิก
        $order->order_date = date('Y-m-d H:i:s'); //กำหนดวันที่ในการเบิก
        $order->order_budget_per_year = "2560";
        $order->order_status = '1'; //กำหนดสถานะเป็น 1 เพื่อรอการอนุมัติ
        $order->order_detail_id = $order_detail->order_detail_id;
//        var_dump($order);
//        die();
        if (!$order->save()) return print_r($order->errors);

        $arr1 = \Yii::$app->session->get('cart');
        foreach ($arr1 as $key => $item) {
            $order_mat = new MatsysOrderHasMaterial();
            $order_mat->order_id = $order->order_id;
            $order_mat->material_id = $item['mat_id'];
//            $order_mat->stock_id = '1';
//            $order_mat->order_detail_id = '1';
            $order_mat->material_amount = $item['mat_amount'];
            if (!$order_mat->save()) return print_r($order_mat->errors);
        }

        \Yii::$app->session->remove('cart');

        \Yii::$app->session->setFlash( 'success', "ทำรายการสำเร็จ" ); //คำสั่ง alert แจ้งเตือน ทำสำเร็๗
        return $this->redirect("@web/materialsystem/default/widen");
    }

    public function actionResetcart()
    {
        \Yii::$app->session->remove('cart');
        return $this->redirect("@web/materialsystem/default/widen");
    }
}

?>
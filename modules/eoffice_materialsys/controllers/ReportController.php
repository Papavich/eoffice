<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 25/4/2561
 * Time: 22:34
 */

namespace app\modules\eoffice_materialsys\controllers;


use app\modules\eoffice_materialsys\models\FunDate;
use app\modules\eoffice_materialsys\models\Major;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use yii\web\Controller;
use yii\db\Expression;
use yii\db\Query;

class ReportController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['list']);
    }

    public function actionList()
    {
        $major = Major::find()->all();
        return $this->render('index',
            [
                'major' => $major,
            ]
        );
    }

    public function actionRenderchart()
    {
        header('Content-Type: application/json');
        $budget = FunDate::getBudgetyear();
        $budgetTemp = $budget . '-%';
        $order = MatsysOrder::find()
            ->where("order_id LIKE :order_id", [':order_id' => $budgetTemp])
            ->orderBy(['order_date' => SORT_ASC])
            ->all();
        $result = [];
        $list_order = [
            "01" => 0,
            "02" => 0,
            "03" => 0,
            "04" => 0,
            "05" => 0,
            "06" => 0,
            "07" => 0,
            "08" => 0,
            "09" => 0,
            "10" => 0,
            "11" => 0,
            "12" => 0,
        ];
        foreach ($order as $key => $value) {
            $dateTemp = explode(' ', $value->order_date);
            $month = explode('-', $dateTemp[0]);
            switch ($month[1]) {
                case "01":
                    $list_order["01"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "02":
                    $list_order["02"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "03":
                    $list_order["03"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "04":
                    $list_order["04"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "05":
                    $list_order["05"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "06":
                    $list_order["06"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "07":
                    $list_order["07"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "08":
                    $list_order["08"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "09":
                    $list_order["09"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "10":
                    $list_order["10"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "11":
                    $list_order["11"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "12":
                    $list_order["12"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
            }
        }
        $query = new Query();
        $items = $query->select('SUM(matsys_order_has_material.material_amount) AS material_amount_result,matsys_material.material_name')
            ->from('matsys_order_has_material')
            ->innerJoin('matsys_order', 'matsys_order_has_material.order_id = matsys_order.order_id')
            ->innerJoin('matsys_material', 'matsys_order_has_material.material_id = matsys_material.material_id')
            ->Where('matsys_order.order_status_confirm = "confirm"')
            ->andWhere('matsys_order.order_status = "1"')
            ->andWhere('matsys_order_has_material.order_id LIKE :order_id', [':order_id' => $budgetTemp])
            ->groupBy('matsys_order_has_material.material_id')
            ->orderBy(['material_amount_result' => SORT_DESC])
            ->limit('6')
            ->all(\Yii::$app->db_mat);
        $major = Major::find()->all();
        $price = [];
        foreach ($major as $key => $value) {
            $majorTemp = "%-" . $value->major_id . "-%";
            $order = MatsysOrderHasMaterial::find()
                ->where("matsys_order_has_material.order_id LIKE :order_id", [':order_id' => $budgetTemp])
                ->innerJoin('matsys_order', 'matsys_order_has_material.order_id = matsys_order.order_id')
                ->andWhere("matsys_order.order_status_confirm = 'confirm'")
                ->andWhere('matsys_order.order_status = "1"')
                ->andWhere("matsys_order_has_material.order_id LIKE :major", [':major' => $majorTemp])
                ->all();
            $allprice = 0;
            foreach ($order as $key2 => $value2) {
                $allprice += ($value2->material_amount_receive * $value2->material->bill_detail_price_per_unit);
            };
            $itemTemp = [
                "major" => "สาขา" . $value->major_name,
                "price" => $allprice
            ];
            array_push($price, $itemTemp);
        }
        array_push($result, ['order' => $list_order]);
        array_push($result, ['items' => $items]);
        array_push($result, ['major' => $price]);
        echo json_encode($result);
    }

    public function actionRenderchartbudget()
    {
        header('Content-Type: application/json');
        $budgetTemp = \Yii::$app->request->post('budget');
        $budget = substr((string)$budgetTemp, -2);
        $budgetTemp = $budget . '-%';
        $order = MatsysOrder::find()
            ->where("order_id LIKE :order_id", [':order_id' => $budgetTemp])
            ->orderBy(['order_date' => SORT_ASC])
            ->all();
        $result = [];
        $list_order = [
            "01" => 0,
            "02" => 0,
            "03" => 0,
            "04" => 0,
            "05" => 0,
            "06" => 0,
            "07" => 0,
            "08" => 0,
            "09" => 0,
            "10" => 0,
            "11" => 0,
            "12" => 0,
        ];
        foreach ($order as $key => $value) {
            $dateTemp = explode(' ', $value->order_date);
            $month = explode('-', $dateTemp[0]);
            switch ($month[1]) {
                case "01":
                    $list_order["01"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "02":
                    $list_order["02"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "03":
                    $list_order["03"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "04":
                    $list_order["04"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "05":
                    $list_order["05"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "06":
                    $list_order["06"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "07":
                    $list_order["07"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "08":
                    $list_order["08"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "09":
                    $list_order["09"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "10":
                    $list_order["10"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "11":
                    $list_order["11"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
                case "12":
                    $list_order["12"] += MatsysOrderHasMaterial::getAllPriceOrder($value->order_id);
                    break;
            }
        }
        $query = new Query();
        $items = $query->select('SUM(matsys_order_has_material.material_amount) AS material_amount_result,matsys_material.material_name')
            ->from('matsys_order_has_material')
            ->innerJoin('matsys_order', 'matsys_order_has_material.order_id = matsys_order.order_id')
            ->innerJoin('matsys_material', 'matsys_order_has_material.material_id = matsys_material.material_id')
            ->Where('matsys_order.order_status_confirm = "confirm"')
            ->andWhere('matsys_order.order_status = "1"')
            ->andWhere('matsys_order_has_material.order_id LIKE :order_id', [':order_id' => $budgetTemp])
            ->groupBy('matsys_order_has_material.material_id')
            ->orderBy(['material_amount_result' => SORT_DESC])
            ->limit('10')
            ->all(\Yii::$app->db_mat);
        $major = Major::find()->all();
        $price = [];
        foreach ($major as $key => $value) {
            $majorTemp = "%-" . $value->major_id . "-%";
            $order = MatsysOrderHasMaterial::find()
                ->where("matsys_order_has_material.order_id LIKE :order_id", [':order_id' => $budgetTemp])
                ->innerJoin('matsys_order', 'matsys_order_has_material.order_id = matsys_order.order_id')
                ->andWhere("matsys_order.order_status_confirm = 'confirm'")
                ->andWhere('matsys_order.order_status = "1"')
                ->andWhere("matsys_order_has_material.order_id LIKE :major", [':major' => $majorTemp])
                ->all();
            $allprice = 0;
            foreach ($order as $key2 => $value2) {
                $allprice += ($value2->material_amount_receive * $value2->material->bill_detail_price_per_unit);
            };
            $itemTemp = [
                "major" => "สาขา" . $value->major_name,
                "price" => $allprice
            ];
            array_push($price, $itemTemp);
        }
        array_push($result, ['order' => $list_order]);
        array_push($result, ['items' => $items]);
        array_push($result, ['major' => $price]);
        echo json_encode($result);
    }

    public function actionRenderchartdate()
    {
        header('Content-Type: application/json');
        //LINE
        $dateFirst = \Yii::$app->request->post('dateFirst');
        $dateSecond = \Yii::$app->request->post('dateSecond');
        $dateFirstTemp = explode('-', $dateFirst);
        $dateSecondTemp = explode('-', $dateSecond);
        $monthFirst = (int)$dateFirstTemp[1];
        $yearFirst = (int)$dateFirstTemp[0];
        $monthSecond = (int)$dateSecondTemp[1];
        $yearSecond = (int)$dateSecondTemp[0];
        $month = [];
        $result_line = [];
        $result = [];
        if ($yearFirst == $yearSecond) {
            do {
                $list_month = [
                    'budget' => FunDate::getBudget($yearFirst . "-" . $monthFirst),
                    'month_name' => FunDate::getMonthName($monthFirst),
                    'month' => sprintf('%02d', $monthFirst)
                ];
                array_push($month, $list_month);
                $monthFirst++;
            } while ($monthFirst <= $monthSecond);
        } elseif ($yearFirst < $yearSecond) {
            while ($yearFirst <= $yearSecond) {
                if ($yearFirst != $yearSecond) {
                    for ($x = $monthFirst; $x <= 12; $x++) {
                        $list_month = [
                            'budget' => FunDate::getBudget($yearFirst . "-" . $x),
                            'month_name' => FunDate::getMonthName($x),
                            'month' => sprintf('%02d', $x)
                        ];
                        array_push($month, $list_month);
                    }
                    $monthFirst = 1;
                } else {
                    for ($x = 1; $x <= $monthSecond; $x++) {
                        $list_month = [
                            'budget' => FunDate::getBudget($yearFirst . "-" . $x),
                            'month_name' => FunDate::getMonthName($x),
                            'month' => sprintf('%02d', $x)
                        ];
                        array_push($month, $list_month);
                    }
                }
                $yearFirst++;
            };
        }
        $B_dateFirst = $dateFirst . " 00:00:00";
        $B_dateSecond = $dateSecond . " 23:59:59";
        foreach ($month as $key => $value) {
            $order_id = $value['budget'] . "-%";
            $order_date = "%-" . $value['month'] . "-%";
            $all_price = 0;
            $price_month = MatsysOrderHasMaterial::find()
                ->innerJoin('matsys_order', 'matsys_order.order_id = matsys_order_has_material.order_id')
                ->where('matsys_order_has_material.order_id LIKE :order_id', [':order_id' => $order_id])
                ->andWhere('matsys_order.order_date LIKE :order_date', [':order_date' => $order_date])
                ->andWhere('matsys_order.order_status_confirm = "confirm"')
                ->andWhere('matsys_order.order_status = "1"')
                ->andWhere('matsys_order.order_date Between :datefirst AND :datesecond', [':datefirst' => $B_dateFirst, ':datesecond' => $B_dateSecond])
                ->all();
            foreach ($price_month as $key2 => $value2) {
                $all_price += ($value2->material_amount_receive * $value2->material->bill_detail_price_per_unit);
            }
            $result_item = [
                'month' => $value['month_name'],
                'price' => $all_price
            ];
            array_push($result_line, $result_item);

        }


//Bar
        $query = new Query();
        $items = $query->select('SUM(matsys_order_has_material.material_amount) AS material_amount_result,matsys_material.material_name')
            ->from('matsys_order_has_material')
            ->innerJoin('matsys_order', 'matsys_order_has_material.order_id = matsys_order.order_id')
            ->innerJoin('matsys_material', 'matsys_order_has_material.material_id = matsys_material.material_id')
            ->Where('matsys_order.order_status_confirm = "confirm"')
            ->andWhere('matsys_order.order_status = "1"')
            ->andWhere('matsys_order.order_date BETWEEN :dateFirst AND :dateSecond', [':dateFirst' => $B_dateFirst, ':dateSecond' => $B_dateSecond])
            ->groupBy('matsys_order_has_material.material_id')
            ->orderBy(['material_amount_result' => SORT_DESC])
            ->limit('10')
            ->all(\Yii::$app->db_mat);
        //Pie
        $major = Major::find()->all();
        $price = [];
        foreach ($major as $key => $value) {
            $majorTemp = "%-" . $value->major_id . "-%";
            $order = MatsysOrderHasMaterial::find()
                ->innerJoin('matsys_order', 'matsys_order_has_material.order_id = matsys_order.order_id')
                ->where("matsys_order.order_status_confirm = 'confirm'")
                ->andWhere('matsys_order.order_status = "1"')
                ->andWhere("matsys_order_has_material.order_id LIKE :major", [':major' => $majorTemp])
                ->andWhere('matsys_order.order_date BETWEEN :dateFirst AND :dateSecond', [':dateFirst' => $B_dateFirst, ':dateSecond' => $B_dateSecond])
                ->all();
            $allprice = 0;
            foreach ($order as $key2 => $value2) {
                $allprice += ($value2->material_amount_receive * $value2->material->bill_detail_price_per_unit);
            };
            $itemTemp = [
                "major" => "สาขา" . $value->major_name,
                "price" => $allprice
            ];
            array_push($price, $itemTemp);
        }

        array_push($result, ['line' => $result_line]);
        array_push($result, ['bar' => $items]);
        array_push($result, ['pie' => $price]);

        echo json_encode($result);
    }

    public function actionRendertable()
    {
        $budget = FunDate::getBudgetyear();
        $budgetTemp = $budget . '-%';
        $mainMat = MatsysOrderHasMaterial::find()
            ->innerJoin('matsys_order', 'matsys_order.order_id = matsys_order_has_material.order_id')
            ->innerJoin('matsys_material', 'matsys_material.material_id = matsys_order_has_material.material_id')
            ->where('matsys_order.order_id LIKE :order_id', [':order_id' => $budgetTemp])
            ->andWhere('matsys_order.order_status_confirm = "confirm"')
            ->andWhere('matsys_order.order_status = "1"')
            ->groupBy(['matsys_order_has_material.bill_master_id', 'matsys_order_has_material.material_id'])
            ->orderBy(['matsys_material.material_name' => SORT_ASC])
            ->all();
        $items = [];
        foreach ($mainMat as $key => $value) {
            $allamount = MatsysOrderHasMaterial::find()
                ->innerJoin('matsys_order', 'matsys_order.order_id = matsys_order_has_material.order_id')
                ->where('matsys_order_has_material.material_id = :material_id', [':material_id' => $value->materialdetail->material_id])
                ->andWhere('matsys_order_has_material.bill_master_id = :bill_master_id', [':bill_master_id' => $value->bill_master_id])
                ->andwhere('matsys_order.order_id LIKE :order_id', [':order_id' => $budgetTemp])
                ->andWhere('matsys_order.order_status_confirm = "confirm"')
                ->andWhere('matsys_order.order_status = "1"')
                ->sum('matsys_order_has_material.material_amount_receive');
            $item = [
                'material_name' => $value->materialdetail->material_name,
                'amount'=>number_format($allamount, 2) . " " . $value->materialdetail->material_unit_name,
                'priceper'=>number_format($value->material->bill_detail_price_per_unit, 2),
                'allprice'=>number_format(($allamount * $value->material->bill_detail_price_per_unit)),
                'company'=>$value->billMasters->company->company_name
            ];
            array_push($items,$item);
        }
        $this->layout = false;
        return $this->render('_item',[
            'items'=>$items
        ]);
    }

    public function actionRendertablebudget()
    {
        $this->layout = false;
        $budgetTemp = \Yii::$app->request->post('budget');
        $budget = substr((string)$budgetTemp, -2);
        $budgetTemp = $budget . '-%';
        $mainMat = MatsysOrderHasMaterial::find()
            ->innerJoin('matsys_order', 'matsys_order.order_id = matsys_order_has_material.order_id')
            ->innerJoin('matsys_material', 'matsys_material.material_id = matsys_order_has_material.material_id')
            ->where('matsys_order.order_id LIKE :order_id', [':order_id' => $budgetTemp])
            ->andWhere('matsys_order.order_status_confirm = "confirm"')
            ->andWhere('matsys_order.order_status = "1"')
            ->groupBy(['matsys_order_has_material.bill_master_id', 'matsys_order_has_material.material_id'])
            ->orderBy(['matsys_material.material_name' => SORT_ASC])
            ->all();
        $items = [];
        foreach ($mainMat as $key => $value) {
            $allamount = MatsysOrderHasMaterial::find()
                ->innerJoin('matsys_order', 'matsys_order.order_id = matsys_order_has_material.order_id')
                ->where('matsys_order_has_material.material_id = :material_id', [':material_id' => $value->materialdetail->material_id])
                ->andWhere('matsys_order_has_material.bill_master_id = :bill_master_id', [':bill_master_id' => $value->bill_master_id])
                ->andwhere('matsys_order.order_id LIKE :order_id', [':order_id' => $budgetTemp])
                ->andWhere('matsys_order.order_status_confirm = "confirm"')
                ->andWhere('matsys_order.order_status = "1"')
                ->sum('matsys_order_has_material.material_amount_receive');
            $item = [
                'material_name' => $value->materialdetail->material_name,
                'amount'=>number_format($allamount, 2) . " " . $value->materialdetail->material_unit_name,
                'priceper'=>number_format($value->material->bill_detail_price_per_unit, 2),
                'allprice'=>number_format(($allamount * $value->material->bill_detail_price_per_unit)),
                'company'=>$value->billMasters->company->company_name
            ];
            array_push($items,$item);
        }
        $this->layout = false;
        return $this->render('_item',[
            'items'=>$items
        ]);
    }

    public function actionRendertabledate()
    {
        $dateFirst = \Yii::$app->request->post('dateFirst');
        $dateSecond = \Yii::$app->request->post('dateSecond');
        $B_dateFirst = $dateFirst . " 00:00:00";
        $B_dateSecond = $dateSecond . " 23:59:59";

        $mainMat = MatsysOrderHasMaterial::find()
            ->innerJoin('matsys_order', 'matsys_order.order_id = matsys_order_has_material.order_id')
            ->innerJoin('matsys_material', 'matsys_material.material_id = matsys_order_has_material.material_id')
            ->where('matsys_order.order_status_confirm = "confirm"')
            ->andWhere('matsys_order.order_status = "1"')
            ->andWhere('matsys_order.order_date BETWEEN :dateFirst AND :dateSecond', [':dateFirst' => $B_dateFirst, ':dateSecond' => $B_dateSecond])
            ->groupBy(['matsys_order_has_material.bill_master_id', 'matsys_order_has_material.material_id'])
            ->orderBy(['matsys_material.material_name' => SORT_ASC])
            ->all();

        $items = [];
        foreach ($mainMat as $key => $value) {
            $allamount = MatsysOrderHasMaterial::find()
                ->innerJoin('matsys_order', 'matsys_order.order_id = matsys_order_has_material.order_id')
                ->where('matsys_order_has_material.material_id = :material_id', [':material_id' => $value->materialdetail->material_id])
                ->andWhere('matsys_order_has_material.bill_master_id = :bill_master_id', [':bill_master_id' => $value->bill_master_id])
                ->andWhere('matsys_order.order_date BETWEEN :dateFirst AND :dateSecond', [':dateFirst' => $B_dateFirst, ':dateSecond' => $B_dateSecond])
                ->andWhere('matsys_order.order_status_confirm = "confirm"')
                ->andWhere('matsys_order.order_status = "1"')
                ->sum('matsys_order_has_material.material_amount_receive');
            $item = [
                'material_name' => $value->materialdetail->material_name,
                'amount'=>number_format($allamount, 2) . " " . $value->materialdetail->material_unit_name,
                'priceper'=>number_format($value->material->bill_detail_price_per_unit, 2),
                'allprice'=>number_format(($allamount * $value->material->bill_detail_price_per_unit)),
                'company'=>$value->billMasters->company->company_name
            ];
            array_push($items,$item);
        }
        $this->layout = false;
        return $this->render('_item',[
            'items'=>$items
        ]);
    }
}
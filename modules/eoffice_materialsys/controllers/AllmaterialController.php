<?php

namespace app\modules\eoffice_materialsys\controllers;


use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use app\modules\eoffice_materialsys\models\MatsysLocation;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysAllMaterialSearch;
use app\modules\eoffice_materialsys\models\MatsysMaterialType;
use app\modules\eoffice_materialsys\models\MatsysOrder;
use app\modules\eoffice_materialsys\models\MatsysOrderHasMaterial;
use yii\web\Controller;
use yii;
use yii\helpers\ArrayHelper;
use yii\db\Exception;

class AllmaterialController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['list']);
    }

    public function actionList()
    {
        $searchModel = new MatsysAllMaterialSearch();
        $modelMaterial = new MatsysMaterial();
        $modelLocation = ArrayHelper::map(MatsysLocation::find()->all(), 'location_id', 'location_name');
        $modelType = ArrayHelper::map(MatsysMaterialType::find()->all(), 'material_type_id', 'material_type_name');
        $url_params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (isset($url_params['view'])) {
            $dataProvider->pagination->pageSize = 25;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        $requeryParam = Yii::$app->request->queryParams;
        if (isset($requeryParam['type']) && $requeryParam['type'] != '0') {
            $type = MatsysMaterialType::findOne($requeryParam['type']);
        } else {
            $type = new MatsysMaterialType();
        }
        array_unshift($modelType, "หมวดหมู่ทั้งหมด");
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelMateril' => $modelMaterial,
            'modelLocation' => $modelLocation,
            'modelType' => $modelType,
            'type' => $type,
            'params' =>$requeryParam,
        ]);
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

    public function actionAdditem()
    {
        try {
            $material_id = Yii::$app->request->post('material_id');
            $amount = Yii::$app->request->post('amount');
        $this->cutStock($material_id,$amount);
            echo "pass";
        } catch (Exception $e) {
            echo $e->getMessage();
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

    public function actionUpdatecart()
    {
        header('Content-Type: application/json');
        $id = Yii::$app->user->identity->getId();
        $bill = MatsysOrder::searchConfirmbill($id);
        $bill_id = $bill->order_id;
        $item = MatsysOrderHasMaterial::getMainmaterial($bill_id);
        $resultItems = [];
        array_push($resultItems,['amount' => MatsysOrderHasMaterial::allAmountInOrder($bill_id)]);
        $items = [];
        foreach ($item as $key => $value) {
            $div = "<tr>
                       <td>".$value->materialdetail->material_name."</td>
                       <td>".$value->material_amount ." ". $value->materialdetail->material_unit_name ."</td>
                    </tr>";
            array_push($items,$div);
        }
        array_push($resultItems,['item'=>$items]);
        echo json_encode($resultItems);
    }
}
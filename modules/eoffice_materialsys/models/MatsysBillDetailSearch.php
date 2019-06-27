<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_materialsys\models\MatsysBillDetail;
use yii\db\Connection;
use yii\db\Query;
use yii\di\Instance;

/**
 * MatsysBillDetailSearch represents the model behind the search form of `app\modules\eoffice_materialsys\models\MatsysBillDetail`.
 */
class MatsysBillDetailSearch extends MatsysBillDetail
{
    public $db = 'db_mat';

    public function init()
    {
        parent::init();

        $this->db = Instance::ensure($this->db, Connection::className());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material_id', 'bill_master_id', 'bill_detail_use_amount'], 'safe'],
            [['bill_detail_price_per_unit', 'bill_detaill_amount', 'bill_detail_counter'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public static function getDb()
    {
        return Yii::$app->get('db_mat');
    }

    public function search($params)
    {
//        if (isset($params['sort'])) {
//            if ($params['sort'] == 'date') {
////                $query = new Query();
////                $query->select([
////                        'matsys_bill_detail.material_id AS material_id',
////                        'matsys_bill_detail.bill_master_id AS bill_master_id',
////                        'matsys_bill_detail.bill_detail_price_per_unit AS bill_detail_price_per_unit',
////                        'matsys_bill_detail.bill_detaill_amount AS bill_detaill_amount',
////                        'matsys_bill_detail.bill_detail_use_amount AS bill_detail_use_amount',
////                        'matsys_bill_detail.bill_detail_counter AS bill_detail_counter'
////                    ]
////                )
////                    ->from('matsys_bill_detail')
////                    ->join('INNER JOIN', 'matsys_bill_master',
////                        'matsys_bill_detail.bill_master_id =matsys_bill_master.bill_master_id')
////                    ->where(
////                        'matsys_bill_detail.bill_master_id = :material_id',
////                        [':material_id' => $params['id']]
////                    )->orderBy([
////                        'matsys_bill_master.bill_master_date' => SORT_DESC,
////                    ]);
////
////                $command = $query->createCommand();
////                $data = $command->queryAll();
//
//                $query = MatsysBillDetail::find()->joinWith('')
////                $query = MatsysBillDetail::find()->where('material_id = :material_id', [':material_id' => $params['id']]);
//                $dataProvider = new ActiveDataProvider([
//                    'query' => $query,
//                ]);
//
//                return $dataProvider;
//            } else {
//                $query = MatsysBillDetail::find()->where('material_id = :material_id', [':material_id' => $params['id']]);
//
//                // add conditions that should always apply here
//
//                $dataProvider = new ActiveDataProvider([
//                    'query' => $query,
//                ]);
//
//                $this->load($params);
//
//                if (!$this->validate()) {
//                    // uncomment the following line if you do not want to return any records when validation fails
//                    // $query->where('0=1');
//                    return $dataProvider;
//                }
//
//                // grid filtering conditions
//                $query->andFilterWhere([
//                    'bill_detail_price_per_unit' => $this->bill_detail_price_per_unit,
//                    'bill_detaill_amount' => $this->bill_detaill_amount,
//                    'bill_detail_counter' => $this->bill_detail_counter,
//                ]);
//
//                $query->andFilterWhere(['like', 'material_id', $this->material_id])
//                    ->andFilterWhere(['like', 'bill_master_id', $this->bill_master_id])
//                    ->andFilterWhere(['like', 'bill_detail_use_amount', $this->bill_detail_use_amount]);
//
//                return $dataProvider;
//            }
//        } else {
//            $query = MatsysBillDetail::find()->where('material_id = :material_id', [':material_id' => $params['id']]);
//
//            // add conditions that should always apply here
//
//            $dataProvider = new ActiveDataProvider([
//                'query' => $query,
//            ]);
//            return $dataProvider;
//        }
        if(isset($params['search'])){
            $date = explode("-",$params['search']);
            $dateSearch = ($date[2]-543)."-".$date[1]."-".$date[0];
            $query = MatsysBillDetail::find()->joinWith('billMaster')->where('matsys_bill_master.bill_master_date = :date', [':date' => $dateSearch])->andWhere('material_id = :material_id',[':material_id'=>$params['id']]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            return $dataProvider;
        }else {

            $query = MatsysBillDetail::find()->where('material_id = :material_id', [':material_id' => $params['id']])->joinWith(['billMaster']);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

            $dataProvider->sort->attributes['date'] = [
                // The tables are the ones our relation are configured to
                // in my case they are prefixed with "tbl_"
                'asc' => ['matsys_bill_master.bill_master_date' => SORT_ASC],
                'desc' => ['matsys_bill_master.bill_master_date' => SORT_DESC],
            ];
            $dataProvider->sort->attributes['price'] = [
                // The tables are the ones our relation are configured to
                // in my case they are prefixed with "tbl_"
                'asc' => ['(bill_detaill_amount*bill_detail_price_per_unit)' => SORT_ASC],
                'desc' => ['(bill_detaill_amount*bill_detail_price_per_unit)' => SORT_DESC],
            ];

            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                'bill_detail_price_per_unit' => $this->bill_detail_price_per_unit,
                'bill_detaill_amount' => $this->bill_detaill_amount,
                'bill_detail_counter' => $this->bill_detail_counter,
            ]);

            $query->andFilterWhere(['like', 'material_id', $this->material_id])
                ->andFilterWhere(['like', 'bill_master_id', $this->bill_master_id])
                ->andFilterWhere(['like', 'bill_detail_use_amount', $this->bill_detail_use_amount]);
            if (isset($params['sort'])) {
                if ($params['sort'] == '') {
                    $query->orderBy(['matsys_bill_master.bill_master_date' => SORT_DESC]);
                }
            }

            return $dataProvider;
        }

    }
}

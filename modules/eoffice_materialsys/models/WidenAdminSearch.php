<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_materialsys\models\MatsysOrder;

/**
 * WidenAdminSearch represents the model behind the search form of `app\modules\materialsystem\models\MatsysOrder`.
 */
class WidenAdminSearch extends MatsysOrder
{
    /**
     * @inheritdoc
     */
    public $widenSearch;

    public function rules()
    {
        return [
            [['order_id', 'person_id', 'order_date', 'order_date_accept', 'order_staff', 'order_status', 'order_status_confirm', 'order_status_notification', 'order_status_return', 'order_budget_per_year', 'order_cancel_description', 'order_detail_id', 'widenSearch'], 'safe'],
            [['order_id_ai'], 'integer'],
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
    public function search($params)
    {
        if (isset($params['budget'])) {
            $budget_temp = $params['budget'];
            $budget = substr((string)$budget_temp, -2);
            $query = MatsysOrder::find()
                ->where('order_status != "0"')
                ->andWhere('order_budget_per_year = :budget', [':budget' => $budget]);
        } elseif (isset($params['dateFirst']) && isset($params['dateSecond'])) {
            $B_dateFirst = $params['dateFirst'] . " 00:00:00";
            $B_dateSecond = $params['dateSecond'] . " 23:59:59";
            $query = MatsysOrder::find()
                ->where('order_status != "0"')
                ->andWhere('matsys_order.order_date Between :datefirst AND :datesecond', [':datefirst' => $B_dateFirst, ':datesecond' => $B_dateSecond]);
        } else {
            $query = MatsysOrder::find()
                ->where('order_status != "0"');
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->orFilterWhere([
            'order_date' => $this->widenSearch,
            'order_date_accept' => $this->widenSearch,
            'order_id_ai' => $this->widenSearch,
        ])->andWhere(['order_status_confirm' => 'confirm']);

        $query->orFilterWhere(['like', 'order_id', $this->widenSearch])
            ->orFilterWhere(['like', 'person_id', $this->widenSearch])
            ->orFilterWhere(['like', 'order_staff', $this->widenSearch])
            ->orFilterWhere(['like', 'order_status', $this->widenSearch])
            ->orFilterWhere(['like', 'order_status_confirm', $this->widenSearch])
            ->orFilterWhere(['like', 'order_status_notification', $this->widenSearch])
            ->orFilterWhere(['like', 'order_status_return', $this->widenSearch])
            ->orFilterWhere(['like', 'order_budget_per_year', $this->widenSearch])
            ->orFilterWhere(['like', 'order_cancel_description', $this->widenSearch])
            ->orFilterWhere(['like', 'order_detail_id', $this->widenSearch])
            ->andWhere(['order_status_confirm' => 'confirm']);

        return $dataProvider;
    }
}

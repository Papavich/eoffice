<?php

namespace app\modules\materialsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\materialsystem\models\MatsysOrder;

/**
 * HistorySearch represents the model behind the search form of `app\modules\materialsystem\models\MatsysOrder`.
 */
class HistorySearch extends MatsysOrder
{
    /**
     * @inheritdoc
     */
    public $hSearch;

    public function rules()
    {
        return [
            [['order_id', 'person_id', 'order_date', 'order_date_accept', 'order_staff', 'order_status', 'order_status_confirm', 'order_status_notification', 'order_status_return', 'order_budget_per_year', 'order_cancel_description', 'order_detail_id', 'hSearch'], 'safe'],
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
        $query = MatsysOrder::find();

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
            'order_date' => $this->hSearch,
            'order_date_accept' => $this->hSearch,
            'order_id_ai' => $this->hSearch,
        ])->andWhere(['order_status_confirm' => 'confirm']);

        $query->orFilterWhere(['like', 'order_id', $this->hSearch])
            ->orFilterWhere(['like', 'person_id', $this->hSearch])
            ->orFilterWhere(['like', 'order_staff', $this->hSearch])
            ->orFilterWhere(['like', 'order_status', $this->hSearch])
            ->orFilterWhere(['like', 'order_status_confirm', $this->hSearch])
            ->orFilterWhere(['like', 'order_status_notification', $this->hSearch])
            ->orFilterWhere(['like', 'order_status_return', $this->hSearch])
            ->orFilterWhere(['like', 'order_budget_per_year', $this->hSearch])
            ->orFilterWhere(['like', 'order_cancel_description', $this->hSearch])
            ->orFilterWhere(['like', 'order_detail_id', $this->hSearch])
            ->andWhere(['order_status_confirm' => 'confirm']);

        return $dataProvider;
    }
}

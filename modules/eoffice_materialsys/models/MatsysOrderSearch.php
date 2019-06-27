<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_materialsys\models\MatsysOrder;

/**
 * MatsysOrderSearch represents the model behind the search form of `app\modules\eoffice_materialsys\models\MatsysOrder`.
 */
class MatsysOrderSearch extends MatsysOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'person_id', 'order_date', 'order_date_accept', 'order_staff', 'order_status', 'order_status_confirm', 'order_status_notification', 'order_status_return', 'order_budget_per_year', 'order_cancel_description', 'order_detail_id'], 'safe'],
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
        $query = MatsysOrder::find()->where('order_status_confirm = "confirm"')->andWhere('order_status = "0"');

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
        $query->andFilterWhere([
            'order_date' => $this->order_date,
            'order_date_accept' => $this->order_date_accept,
            'order_id_ai' => $this->order_id_ai,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'person_id', $this->person_id])
            ->andFilterWhere(['like', 'order_staff', $this->order_staff])
            ->andFilterWhere(['like', 'order_status', $this->order_status])
            ->andFilterWhere(['like', 'order_status_confirm', $this->order_status_confirm])
            ->andFilterWhere(['like', 'order_status_notification', $this->order_status_notification])
            ->andFilterWhere(['like', 'order_status_return', $this->order_status_return])
            ->andFilterWhere(['like', 'order_budget_per_year', $this->order_budget_per_year])
            ->andFilterWhere(['like', 'order_cancel_description', $this->order_cancel_description])
            ->andFilterWhere(['like', 'order_detail_id', $this->order_detail_id]);

        return $dataProvider;
    }
}

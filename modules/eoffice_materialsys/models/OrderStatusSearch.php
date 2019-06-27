<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_materialsys\models\MatsysOrder;

/**
 * OrderStatusSearch represents the model behind the search form of `app\modules\materialsystem\models\MatsysOrder`.
 */
class OrderStatusSearch extends MatsysOrder
{
    /**
     * @inheritdoc
     */
    public $orSearch;

    public function rules()
    {
        return [
            [['order_id', 'person_id', 'order_date', 'order_date_accept', 'order_staff', 'order_status', 'order_status_confirm', 'order_status_notification', 'order_status_return', 'order_budget_per_year', 'order_cancel_description', 'order_detail_id', 'orSearch'], 'safe'],
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
        $person_id = Yii::$app->user->identity->getId();
        $query = MatsysOrder::find()
            ->where(['person_id' =>$person_id])
            ->andWhere('order_status_confirm = "confirm"')
            ->andWhere('order_status_notification = "notread"');

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
            'order_date' => $this->orSearch,
            'order_date_accept' => $this->orSearch,
            'order_id_ai' => $this->orSearch,
        ]);

        $query->orFilterWhere(['like', 'order_id', $this->orSearch])
            ->orFilterWhere(['like', 'person_id', $this->orSearch])
            ->orFilterWhere(['like', 'order_staff', $this->orSearch])
            ->orFilterWhere(['like', 'order_status', $this->orSearch])
            ->orFilterWhere(['like', 'order_status_confirm', $this->orSearch])
            ->orFilterWhere(['like', 'order_status_notification', $this->orSearch])
            ->orFilterWhere(['like', 'order_status_return', $this->orSearch])
            ->orFilterWhere(['like', 'order_budget_per_year', $this->orSearch])
            ->orFilterWhere(['like', 'order_cancel_description', $this->orSearch])
            ->orFilterWhere(['like', 'order_detail_id', $this->orSearch]);

        return $dataProvider;
    }
}

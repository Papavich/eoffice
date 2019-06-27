<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaPayment;

/**
 * TaPaymentSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaPayment`.
 */
class TaPaymentSearch extends TaPayment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'program_id', 'term', 'year', 'ta_status_id', 'crtime', 'udtime'], 'safe'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['workload_value', 'ta_payment', 'ta_payment_max'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TaPayment::find();

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
            'subject_version' => $this->subject_version,
            'workload_value' => $this->workload_value,
            'ta_payment' => $this->ta_payment,
            'ta_payment_max' => $this->ta_payment_max,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'program_id', $this->program_id])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id]);

        return $dataProvider;
    }
}

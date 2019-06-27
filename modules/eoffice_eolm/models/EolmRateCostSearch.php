<?php

namespace app\modules\eoffice_eolm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolm\models\EolmRateCost;

/**
 * EolmRateCostSearch represents the model behind the search form about `app\modules\eoffice_eolm\models\EolmRateCost`.
 */
class EolmRateCostSearch extends EolmRateCost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['academic_positions_id'], 'integer'],
            [['eolm_pos_singlebed_rate', 'eolm_pos_twinbeds_rate', 'eolm_pos_allowance_rate'], 'number'],
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
        $query = EolmRateCost::find();

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
            'academic_positions_id' => $this->academic_positions_id,
            'eolm_pos_singlebed_rate' => $this->eolm_pos_singlebed_rate,
            'eolm_pos_twinbeds_rate' => $this->eolm_pos_twinbeds_rate,
            'eolm_pos_allowance_rate' => $this->eolm_pos_allowance_rate,
        ]);

        return $dataProvider;
    }
}

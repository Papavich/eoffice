<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaWorkAtone;

/**
 * TaWorkAtoneSearch represents the model behind the search form about `app\modules\eoffice_ta\models\TaWorkAtone`.
 */
class TaWorkAtoneSearch extends TaWorkAtone
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_work_atone_id', 'ta_work_plan_id', 'crby', 'udby'], 'integer'],
            [['atone_date', 'atone_note', 'ta_status_id', 'crtime', 'udtime'], 'safe'],
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
        $query = TaWorkAtone::find();

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
            'ta_work_atone_id' => $this->ta_work_atone_id,
            'ta_work_plan_id' => $this->ta_work_plan_id,
            'atone_date' => $this->atone_date,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'atone_note', $this->atone_note])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id]);

        return $dataProvider;
    }
}

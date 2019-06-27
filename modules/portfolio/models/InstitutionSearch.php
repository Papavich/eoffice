<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Institution;

/**
 * InstitutionSearch represents the model behind the search form of `app\modules\portfolio\models\Institution`.
 */
class InstitutionSearch extends Institution
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ag_award_id'], 'integer'],
            [['ag_award_name'], 'safe'],
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
        $query = Institution::find();

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
            'ag_award_id' => $this->ag_award_id,
        ]);

        $query->andFilterWhere(['like', 'ag_award_name', $this->ag_award_name]);

        return $dataProvider;
    }
}

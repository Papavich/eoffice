<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Contributor;

/**
 * ContributorSearch represents the model behind the search form of `app\modules\portfolio\models\Contributor`.
 */
class ContributorSearch extends Contributor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contributor_id'], 'integer'],
            [['contributor_name'], 'safe'],
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
        $query = Contributor::find();

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
            'contributor_id' => $this->contributor_id,
        ]);

        $query->andFilterWhere(['like', 'contributor_name', $this->contributor_name]);

        return $dataProvider;
    }
}

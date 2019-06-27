<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\Publication;

/**
 * PublicationSearch represents the model behind the search form of `app\modules\portfolio\models\Publication`.
 */
class PublicationSearch extends Publication
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pub_id', 'auth_level_id', 'advisor_id', 'person_id', 'std_id', 'contributor_contributor_id', 'cities_id'], 'integer'],
            [['pub_name_thai', 'pub_name_eng', 'book_name', 'date', 'acticle_detail', 'page_number', 'abstract', 'press', 'publisher', 'ISBN', 'issn', 'dataval', 'article', 'number', 'issuance', 'dataindex', 'impact_factor', 'doi'], 'safe'],
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
        $query = Publication::find();

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
            'pub_id' => $this->pub_id,
            'date' => $this->date,
            'auth_level_id' => $this->auth_level_id,
            'advisor_id' => $this->advisor_id,
            'person_id' => $this->person_id,
            'std_id' => $this->std_id,
            'contributor_contributor_id' => $this->contributor_contributor_id,
            'cities_id' => $this->cities_id,
        ]);

        $query->andFilterWhere(['like', 'pub_name_thai', $this->pub_name_thai])
            ->andFilterWhere(['like', 'pub_name_eng', $this->pub_name_eng])
            ->andFilterWhere(['like', 'book_name', $this->book_name])
            ->andFilterWhere(['like', 'acticle_detail', $this->acticle_detail])
            ->andFilterWhere(['like', 'page_number', $this->page_number])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'press', $this->press])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'ISBN', $this->ISBN])
            ->andFilterWhere(['like', 'issn', $this->issn])
            ->andFilterWhere(['like', 'dataval', $this->dataval])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'issuance', $this->issuance])
            ->andFilterWhere(['like', 'dataindex', $this->dataindex])
            ->andFilterWhere(['like', 'impact_factor', $this->impact_factor])
            ->andFilterWhere(['like', 'doi', $this->doi]);

        return $dataProvider;
    }
}

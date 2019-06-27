<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaNews;

/**
 * TaNewsSearch represents the model behind the search form about `app\modules\eoffice_ta\models\TaNews`.
 */
class TaNewsSearch extends TaNews
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_news_id', 'ta_documents_id', 'crby', 'udby'], 'integer'],
            [['ta_news_name', 'ta_news_detail', 'ta_news_img', 'ta_news_imgs', 'ta_news_url', 'ta_status', 'crtime', 'udtime'], 'safe'],
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
        $query = TaNews::find();

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
            'ta_news_id' => $this->ta_news_id,
            'ta_documents_id' => $this->ta_documents_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_news_name', $this->ta_news_name])
            ->andFilterWhere(['like', 'ta_news_detail', $this->ta_news_detail])
            ->andFilterWhere(['like', 'ta_news_img', $this->ta_news_img])
            ->andFilterWhere(['like', 'ta_news_imgs', $this->ta_news_imgs])
            ->andFilterWhere(['like', 'ta_news_url', $this->ta_news_url])
            ->andFilterWhere(['like', 'ta_status', $this->ta_status]);

        return $dataProvider;
    }
}

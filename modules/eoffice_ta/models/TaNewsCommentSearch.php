<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaNewsComment;

/**
 * TaNewsCommentSearch represents the model behind the search form about `app\modules\eoffice_ta\models\TaNewsComment`.
 */
class TaNewsCommentSearch extends TaNewsComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_news_comment_id', 'ta_news_id', 'crby', 'udby'], 'integer'],
            [['ta_news_comment_text', 'ta_news_comment_img', 'ta_status', 'crtime', 'udtime'], 'safe'],
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
        $query = TaNewsComment::find();

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
            'ta_news_comment_id' => $this->ta_news_comment_id,
            'ta_news_id' => $this->ta_news_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'ta_news_comment_text', $this->ta_news_comment_text])
            ->andFilterWhere(['like', 'ta_news_comment_img', $this->ta_news_comment_img])
            ->andFilterWhere(['like', 'ta_status', $this->ta_status]);

        return $dataProvider;
    }
}

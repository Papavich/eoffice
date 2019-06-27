<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaComment;

/**
 * TaCommentSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaComment`.
 */
class TaCommentSearch extends TaComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_comment_id', 'crby', 'udby'], 'integer'],
            [['subject_id', 'section', 'ta_id', 'term', 'year', 'ta_comment_text', 'ta_comment_feeling', 'ta_status_id', 'crtime', 'udtime'], 'safe'],
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
        $query = TaComment::find();

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
            'ta_comment_id' => $this->ta_comment_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'ta_id', $this->ta_id])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'ta_comment_text', $this->ta_comment_text])
            ->andFilterWhere(['like', 'ta_comment_feeling', $this->ta_comment_feeling])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id]);

        return $dataProvider;
    }
}

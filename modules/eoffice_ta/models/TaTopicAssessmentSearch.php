<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaTopicAssessment;

/**
 * TaTopicAssessmentSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaTopicAssessment`.
 */
class TaTopicAssessmentSearch extends TaTopicAssessment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_ass_id', 'crby', 'udby'], 'integer'],
            [['topic_ass_name', 'assessment_id', 'past', 'crtime', 'udtime'], 'safe'],
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
        $query = TaTopicAssessment::find();

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
            'topic_ass_id' => $this->topic_ass_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'topic_ass_name', $this->topic_ass_name])
            ->andFilterWhere(['like', 'assessment_id', $this->assessment_id])
            ->andFilterWhere(['like', 'past', $this->past]);

        return $dataProvider;
    }
}

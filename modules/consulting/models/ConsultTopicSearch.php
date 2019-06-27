<?php

namespace app\modules\consulting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\consulting\models\ConsultTopic;

/**
 * ConsultTopicSearch represents the model behind the search form of `app\modules\consulting\models\ConsultTopic`.
 */
class ConsultTopicSearch extends ConsultTopic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_topic_id'], 'integer'],
            [['consult_topic_name'], 'safe'],
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
        $query = ConsultTopic::find();

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
            'consult_topic_id' => $this->consult_topic_id,
        ]);

        $query->andFilterWhere(['like', 'consult_topic_name', $this->consult_topic_name]);

        return $dataProvider;
    }
}

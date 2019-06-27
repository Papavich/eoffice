<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_consult\models\ConsultAnswer;

/**
 * ConsultAnswerSearch represents the model behind the search form of `app\modules\eoffice_consult\models\ConsultAnswer`.
 */
class ConsultAnswerSearch extends ConsultAnswer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_answer_id', 'consult_post_id'], 'integer'],
            [['consult_answer_text'], 'safe'],
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
        $query = ConsultAnswer::find();

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
            'consult_answer_id' => $this->consult_answer_id,
            'consult_post_id' => $this->consult_post_id,
        ]);

        $query->andFilterWhere(['like', 'consult_answer_text', $this->consult_answer_text]);

        return $dataProvider;
    }
}

<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_consult\models\ConsultQuestion;

/**
 * ConsultQuestionSearch represents the model behind the search form of `app\modules\eoffice_consult\models\ConsultQuestion`.
 */
class ConsultQuestionSearch extends ConsultQuestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_question_id', 'consult_satis_id', 'consult_point_id'], 'integer'],
            [['consult_question_name'], 'safe'],
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
        $query = ConsultQuestion::find();

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
            'consult_question_id' => $this->consult_question_id,
            'consult_satis_id' => $this->consult_satis_id,
            'consult_point_id' => $this->consult_point_id,
        ]);

        $query->andFilterWhere(['like', 'consult_question_name', $this->consult_question_name]);

        return $dataProvider;
    }
}

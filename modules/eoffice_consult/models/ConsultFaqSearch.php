<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_consult\models\ConsultFaq;

/**
 * ConsultFaqSearch represents the model behind the search form of `app\modules\eoffice_consult\models\ConsultFaq`.
 */
class ConsultFaqSearch extends ConsultFaq
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_id', 'user_id'], 'integer'],
            [['faq_ark', 'faq_ans', 'faq_crby', 'faq_crtime', 'faq_upby', 'faq_uptime'], 'safe'],
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
        $query = ConsultFaq::find();

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
            'faq_id' => $this->faq_id,
            'faq_crtime' => $this->faq_crtime,
            'faq_uptime' => $this->faq_uptime,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'faq_ark', $this->faq_ark])
            ->andFilterWhere(['like', 'faq_ans', $this->faq_ans])
            ->andFilterWhere(['like', 'faq_crby', $this->faq_crby])
            ->andFilterWhere(['like', 'faq_upby', $this->faq_upby]);

        return $dataProvider;
    }
}

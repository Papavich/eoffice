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
            [['consult_faq_id'], 'integer'],
            [['consult_faq_ark', 'consult_faq_ans', 'consult_faq_crby', 'consult_faq_crtime', 'consult_faq_upby', 'consult_faq_uptime', 'consult_faq_photo', 'consult_faq_photos'], 'safe'],
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
            'consult_faq_id' => $this->consult_faq_id,
            'consult_faq_crtime' => $this->consult_faq_crtime,
            'consult_faq_uptime' => $this->consult_faq_uptime,
        ]);

        $query->andFilterWhere(['like', 'consult_faq_ark', $this->consult_faq_ark])
            ->andFilterWhere(['like', 'consult_faq_ans', $this->consult_faq_ans])
            ->andFilterWhere(['like', 'consult_faq_crby', $this->consult_faq_crby])
            ->andFilterWhere(['like', 'consult_faq_upby', $this->consult_faq_upby])
            ->andFilterWhere(['like', 'consult_faq_photo', $this->consult_faq_photo])
            ->andFilterWhere(['like', 'consult_faq_photos', $this->consult_faq_photos]);

        return $dataProvider;
    }
}

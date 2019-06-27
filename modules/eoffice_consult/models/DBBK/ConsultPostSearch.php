<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_consult\models\ConsultPost;

/**
 * ConsultPostSearch represents the model behind the search form of `app\modules\eoffice_consult\models\ConsultPost`.
 */
class ConsultPostSearch extends ConsultPost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consult_post_id', 'consult_user_id', 'consult_status_id', 'consult_faq_id'], 'integer'],
            [['consult_post_ark_detail', 'consult_post_ark_date'], 'safe'],
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
        $query = ConsultPost::find();

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
            'consult_post_id' => $this->consult_post_id,
            'consult_post_ark_date' => $this->consult_post_ark_date,
            'consult_user_id' => $this->consult_user_id,
            'consult_status_id' => $this->consult_status_id,
            'consult_faq_id' => $this->consult_faq_id,
        ]);

        $query->andFilterWhere(['like', 'consult_post_ark_detail', $this->consult_post_ark_detail]);

        return $dataProvider;
    }
}

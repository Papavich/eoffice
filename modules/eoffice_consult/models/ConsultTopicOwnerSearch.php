<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_consult\models\ConsultTopicOwner;

/**
 * ConsultTopicOwnerSearch represents the model behind the search form of `app\modules\eoffice_consult\models\ConsultTopicOwner`.
 */
class ConsultTopicOwnerSearch extends ConsultTopicOwner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_owner_id', 'respon_id', 'topic_id'], 'integer'],
            [['topic_owner_name'], 'safe'],
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
        $query = ConsultTopicOwner::find();

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
            'topic_owner_id' => $this->topic_owner_id,
            'respon_id' => $this->respon_id,
            'topic_id' => $this->topic_id,
        ]);

        $query->andFilterWhere(['like', 'topic_owner_name', $this->topic_owner_name]);

        return $dataProvider;
    }
}

<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\PublicationOrder;

/**
 * PublicationOrderSearch represents the model behind the search form of `app\modules\portfolio\models\PublicationOrder`.
 */
class PublicationOrderSearch extends PublicationOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pub_order_id', 'publication_pub_id', 'author_level_auth_level_id', 'project_member_pro_member_id', 'publications_type_pub_type_id'], 'integer'],
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
        $query = PublicationOrder::find();

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
            'pub_order_id' => $this->pub_order_id,
            'publication_pub_id' => $this->publication_pub_id,
            'author_level_auth_level_id' => $this->author_level_auth_level_id,
            'project_member_pro_member_id' => $this->project_member_pro_member_id,
            'publications_type_pub_type_id' => $this->publications_type_pub_type_id,
        ]);

        return $dataProvider;
    }
}

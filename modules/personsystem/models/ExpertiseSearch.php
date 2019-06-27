<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\Expertise;

/**
 * ExpertiseSearch represents the model behind the search form of `app\modules\personsystem\models\Expertise`.
 */
class ExpertiseSearch extends Expertise
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expertise_id', 'expertise_field_name', 'expertise_field_name_eng'], 'safe'],
            [['person_id'], 'integer'],
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
    public function search($params,$person_id)
    {
        $query = Expertise::find()->where(['person_id' => $person_id]);

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
            'person_id' => $this->person_id,
        ]);

        $query->andFilterWhere(['like', 'expertise_id', $this->expertise_id])
            ->andFilterWhere(['like', 'expertise_field_name', $this->expertise_field_name])
            ->andFilterWhere(['like', 'expertise_field_name_eng', $this->expertise_field_name_eng]);

        return $dataProvider;
    }
}

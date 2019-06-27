<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\Responsibility;

/**
 * ResponsibilitySearch represents the model behind the search form of `app\modules\personsystem\models\Responsibility`.
 */
class ResponsibilitySearch extends Responsibility
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['respon_id', 'person_id'], 'integer'],
            [['responsibility'], 'safe'],
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
        $query = Responsibility::find()->where(['person_id' => $person_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'respon_id' => $this->respon_id,
            'person_id' => $this->person_id,
        ]);

        $query->andFilterWhere(['like', 'responsibility', $this->responsibility]);

        return $dataProvider;
    }
}

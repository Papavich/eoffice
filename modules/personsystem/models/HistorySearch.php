<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\HistoryEducation;

/**
 * HistorySearch represents the model behind the search form of `app\modules\personsystem\models\HistoryEducation`.
 */
class HistorySearch extends HistoryEducation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['history_education_id', 'person_id'], 'integer'],
            [['level_education', 'educational_background', 'educational_background_eng', 'educational_institution', 'educational_institution_eng', 'graduate_year'], 'safe'],
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
        $query = HistoryEducation::find()->where(['person_id' => $person_id]);

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
            'history_education_id' => $this->history_education_id,
            'person_id' => $this->person_id,
        ]);

        $query->andFilterWhere(['like', 'level_education', $this->level_education])
            ->andFilterWhere(['like', 'educational_background', $this->educational_background])
            ->andFilterWhere(['like', 'educational_background_eng', $this->educational_background_eng])
            ->andFilterWhere(['like', 'educational_institution', $this->educational_institution])
            ->andFilterWhere(['like', 'educational_institution_eng', $this->educational_institution_eng])
            ->andFilterWhere(['like', 'graduate_year', $this->graduate_year]);

        return $dataProvider;
    }
}

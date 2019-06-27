<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbScholarshipTypeHasYear;
use app\modules\scholar_b\components\ModelHelper;
/**
 * ScbScholarshipTypeHasYearSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbScholarshipTypeHasYear`.
 */
class ScbScholarshipTypeHasYearSearch extends ScbScholarshipTypeHasYear
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scholarship_id', 'scholarship_condition', 'scholarship_file', 'scholarship_image', 'date_start', 'date_end', 'crtime', 'udtime'], 'safe'],
            [['scholarship_year', 'crby', 'udby'], 'integer'],
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
        $query = ScbScholarshipTypeHasYear::find();

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
            'scholarship_year' => $this->scholarship_year,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'scholarship_id', $this->scholarship_id])
            ->andFilterWhere(['like', 'scholarship_condition', $this->scholarship_condition])
            ->andFilterWhere(['like', 'scholarship_file', $this->scholarship_file])
            ->andFilterWhere(['like', 'scholarship_image', $this->scholarship_image]);

        return $dataProvider;
    }
}

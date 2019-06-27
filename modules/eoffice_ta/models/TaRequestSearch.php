<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaRequest;

/**
 * TaRequestSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaRequest`.
 */
class TaRequestSearch extends TaRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'term_id', 'year', 'request_note', 'property_grade', 'property_text', 'ta_type_work_id', 'ta_status_id', 'crtime', 'udtime'], 'safe'],
            [['subject_version', 'degree_bachelor', 'degree_master', 'degree_doctorate', 'amount_ta_all', 'crby', 'udby'], 'integer'],
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
        $query = TaRequest::find();

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
            'subject_version' => $this->subject_version,
            'degree_bachelor' => $this->degree_bachelor,
            'degree_master' => $this->degree_master,
            'degree_doctorate' => $this->degree_doctorate,
            'amount_ta_all' => $this->amount_ta_all,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'term_id', $this->term_id])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'request_note', $this->request_note])
            ->andFilterWhere(['like', 'property_grade', $this->property_grade])
            ->andFilterWhere(['like', 'property_text', $this->property_text])
            ->andFilterWhere(['like', 'ta_type_work_id', $this->ta_type_work_id])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id]);

        return $dataProvider;
    }
}

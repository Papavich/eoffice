<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaRegister;

/**
 * TaRegisterSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaRegister`.
 */
class TaRegisterSearch extends TaRegister
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'person_id', 'term', 'year', 'ta_status_id', 'ta_image', 'doc_ref01', 'doc_ref02', 'doc_ref03', 'doc_ref04', 'crtime', 'udtime'], 'safe'],
            [['subject_version', 'crby', 'udby'], 'integer'],
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
        $query = TaRegister::find();

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
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'person_id', $this->person_id])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'ta_status_id', $this->ta_status_id])
            ->andFilterWhere(['like', 'ta_image', $this->ta_image])
            ->andFilterWhere(['like', 'doc_ref01', $this->doc_ref01])
            ->andFilterWhere(['like', 'doc_ref02', $this->doc_ref02])
            ->andFilterWhere(['like', 'doc_ref03', $this->doc_ref03])
            ->andFilterWhere(['like', 'doc_ref04', $this->doc_ref04]);

        return $dataProvider;
    }
}

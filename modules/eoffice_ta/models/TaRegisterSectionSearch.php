<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaRegisterSection;

/**
 * TaRegisterSectionSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaRegisterSection`.
 */
class TaRegisterSectionSearch extends TaRegisterSection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section', 'ta_type_work_id', 'subject_id', 'person_id', 'term', 'year', 'ta_status', 'crtime', 'udtime'], 'safe'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['ta_payment_sec', 'ta_pay_max_sec'], 'number'],
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
        $query = TaRegisterSection::find();

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
            'ta_payment_sec' => $this->ta_payment_sec,
            'ta_pay_max_sec' => $this->ta_pay_max_sec,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'ta_type_work_id', $this->ta_type_work_id])
            ->andFilterWhere(['like', 'subject_id', $this->subject_id])
            ->andFilterWhere(['like', 'person_id', $this->person_id])
            ->andFilterWhere(['like', 'term', $this->term])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'ta_status', $this->ta_status]);

        return $dataProvider;
    }
}

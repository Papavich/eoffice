<?php

namespace app\modules\eoffice_eolm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolm\models\EolmDisbursementform;

/**
 * EolmDisbursementSearch represents the model behind the search form of `app\modules\eoffice_eolm\models\EolmDisbursementform`.
 */
class EolmDisbursementSearch extends EolmDisbursementform
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_app_id', 'eolm_dis_allowance_day', 'eolm_dis_hotal_day', 'crby', 'udby'], 'integer'],
            [['eolm_dis_date', 'eolm_dis_go_from', 'eolm_dis_go_date', 'eolm_dis_go_time', 'eolm_dis_back_to', 'eolm_dis_back_date', 'eolm_dis_back_time', 'eolm_dis_disburse_for', 'eolm_dis_allowance_type', 'eolm_dis_hotal_type', 'eolm_vehicletype', 'eolm_dis_other_expenses', 'crtime', 'udtime'], 'safe'],
            [['eolm_dis_vehicle_cost', 'eolm_dis_other_expenses_cost'], 'number'],
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
        $query = EolmDisbursementform::find();

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
            'eolm_app_id' => $this->eolm_app_id,
            'eolm_dis_date' => $this->eolm_dis_date,
            'eolm_dis_go_date' => $this->eolm_dis_go_date,
            'eolm_dis_go_time' => $this->eolm_dis_go_time,
            'eolm_dis_back_date' => $this->eolm_dis_back_date,
            'eolm_dis_back_time' => $this->eolm_dis_back_time,
            'eolm_dis_allowance_day' => $this->eolm_dis_allowance_day,
            'eolm_dis_hotal_day' => $this->eolm_dis_hotal_day,
            'eolm_dis_vehicle_cost' => $this->eolm_dis_vehicle_cost,
            'eolm_dis_other_expenses_cost' => $this->eolm_dis_other_expenses_cost,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'eolm_dis_go_from', $this->eolm_dis_go_from])
            ->andFilterWhere(['like', 'eolm_dis_back_to', $this->eolm_dis_back_to])
            ->andFilterWhere(['like', 'eolm_dis_disburse_for', $this->eolm_dis_disburse_for])
            ->andFilterWhere(['like', 'eolm_dis_allowance_type', $this->eolm_dis_allowance_type])
            ->andFilterWhere(['like', 'eolm_dis_hotal_type', $this->eolm_dis_hotal_type])
            ->andFilterWhere(['like', 'eolm_vehicletype', $this->eolm_vehicletype])
            ->andFilterWhere(['like', 'eolm_dis_other_expenses', $this->eolm_dis_other_expenses]);

        return $dataProvider;
    }
}

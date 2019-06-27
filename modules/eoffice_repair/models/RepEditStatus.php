<?php

namespace app\modules\eoffice_repair\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_repair\models\RepairDescription;

/**
 * RepairDescriptionSearch represents the model behind the search form of `app\modules\eoffice_repair\models\RepairDescription`.
 */
class RepEditStatus extends RepairDescription
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rep_desc_id', 'rep_image_id', 'rep_status_id', 'staff_id'], 'integer'],
            [['rep_desc_cost', 'rep_desc_comment', 'rep_desc_request_date', 'rep_location', 'asset_detail_id'], 'safe'],
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
        $query = RepairDescription::find()->where(['not',['staff_id'=>null]]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['rep_desc_id' => SORT_DESC]]

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'rep_desc_id' => $this->rep_desc_id,
            //'rep_desc_request_date' => $this->rep_desc_request_date,
            'rep_image_id' => $this->rep_image_id,
            'rep_status_id' => $this->rep_status_id,
           // 'staff_id' => $this->staff_id,
        ]);

    if(isset ($this->rep_desc_request_date)&&$this->rep_desc_request_date!=''){ //you dont need the if function if yourse sure you have a not null date
                        $date_explode=explode(" - ",$this->rep_desc_request_date);
                        $date1=trim($date_explode[0]);
                        $date2=trim($date_explode[1]);
                        $query->andFilterWhere(['between','rep_desc_request_date',$date1,$date2]);

                    }
        $query->andFilterWhere(['like', 'rep_desc_fname', $this->rep_desc_fname])
        ->andFilterWhere(['like', 'staff_id',$this->staff_id])
            ->andFilterWhere(['like', 'rep_desc_lname', $this->rep_desc_lname])
            ->andFilterWhere(['like', 'rep_desc_email', $this->rep_desc_email])
            ->andFilterWhere(['like', 'rep_desc_tel', $this->rep_desc_tel])
            ->andFilterWhere(['like', 'rep_desc_detail', $this->rep_desc_detail])
            ->andFilterWhere(['like', 'rep_desc_cost', $this->rep_desc_cost])
            ->andFilterWhere(['like', 'rep_desc_comment', $this->rep_desc_comment])
            ->andFilterWhere(['like', 'rep_location', $this->rep_location])
            ->andFilterWhere(['like', 'asset_detail_id', $this->asset_detail_id])
            ->andFilterWhere(['like', 'asset_detail_name', $this->asset_detail_name]);

        return $dataProvider;
    }
}

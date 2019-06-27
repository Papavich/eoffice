<?php

namespace app\modules\eoffice_repair\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_repair\models\RepairTracking;

/**
 * RepairTrackingSearch represents the model behind the search form of `app\modules\eoffice_repair\models\RepairTracking`.
 */
class RepairTrackingSearch extends RepairTracking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['rep_track_id','rep_status_id'], 'integer'],
            [['rep_tracking_date'], 'safe'],
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
        $query = RepairTracking::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['rep_tracking_date' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
          //  'rep_desc_id' => $this->rep_desc_id,
          //  'rep_tracking_date' => $this->rep_tracking_date,
            // 'rep_image_id' => $this->rep_image_id,
            'rep_status_id' => $this->rep_status_id,
          //  'staff_id' => ,
        ]);
        if(isset ($this->rep_tracking_date)&&$this->rep_tracking_date!=''){ //you dont need the if function if yourse sure you have a not null date
                            $date_explode=explode(" - ",$this->rep_tracking_date);
                            $date1=trim($date_explode[0]);
                            $date2=trim($date_explode[1]);
                            $query->andFilterWhere(['between','rep_tracking_date',$date1,$date2]);
                        }

        // grid filtering conditions
        $query->andFilterWhere(['like', 'rep_desc_id', $this->rep_desc_id])
        // ->andFilterWhere(['like','staff_id' , ''])
            // ->andFilterWhere(['like', 'rep_tracking_date', $this->rep_tracking_date])
            ->andFilterWhere(['like', 'rep_status_id', $this->rep_status_id])
            // ->andFilterWhere(['like', 'rep_desc_tel', $this->rep_desc_tel])
        ;

        return $dataProvider;
    }
}

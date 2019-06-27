<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_materialsys\models\MatsysBillMaster;

/**
 * MatsysBillMasterSearch represents the model behind the search form of `app\modules\eoffice_materialsys\models\MatsysBillMaster`.
 */
class MatsysBillMasterSearch extends MatsysBillMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bill_master_id', 'bill_master_date', 'bill_mater_record', 'bill_master_check', 'bill_master_id_no', 'bill_master_pdf', 'company_id'], 'safe'],
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
        if (isset($params['date']) && isset($params['search'])) {
            if($params['date'] != '' && $params['search'] != '') {
                $date = explode('+-+',$params['date']);
                $query = MatsysBillMaster::find()
                    ->where('bill_master_id = :bill_master_id', [':bill_master_id' => $params['search']])
                    ->orWhere('bill_mater_record = :bill_mater_record' , [':bill_mater_record' => $params['search']])
                    ->orWhere('bill_master_check = :bill_master_check', [':bill_master_check' => $params['search']])
                    ->orWhere(['between','bill_master_date', $date[0], $date[1]])
                    ->orderBy(['bill_master_date'=>'DESC']);
            }elseif ($params['date'] != ''){
                $date = explode(' - ',$params['date']);
                $query = MatsysBillMaster::find()
                    ->Where(['between','bill_master_date', $date[0], $date[1]])
                    ->orderBy(['bill_master_date'=>'DESC']);
            }elseif ($params['search'] != ''){
                $query = MatsysBillMaster::find()
                    ->where('bill_master_id = :bill_master_id', [':bill_master_id' => $params['search']])
                    ->orWhere('bill_mater_record = :bill_mater_record' , [':bill_mater_record' => $params['search']])
                    ->orWhere('bill_master_check = :bill_master_check', [':bill_master_check' => $params['search']])
                    ->orderBy(['bill_master_date'=>'DESC']);
            }else{
                $query = MatsysBillMaster::find()
                    ->orderBy(['bill_master_date'=>'DESC']);
            }
        } else {
            $query = MatsysBillMaster::find()
            ->orderBy(['bill_master_date'=>'DESC']);
        }

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
            'bill_master_date' => $this->bill_master_date,
        ]);

        $query->andFilterWhere(['like', 'bill_master_id', $this->bill_master_id])
            ->andFilterWhere(['like', 'bill_mater_record', $this->bill_mater_record])
            ->andFilterWhere(['like', 'bill_master_check', $this->bill_master_check])
            ->andFilterWhere(['like', 'bill_master_id_no', $this->bill_master_id_no])
            ->andFilterWhere(['like', 'bill_master_pdf', $this->bill_master_pdf])
            ->andFilterWhere(['like', 'company_id', $this->company_id]);

        return $dataProvider;
    }
}

<?php

namespace app\modules\eoffice_asset\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_asset\models\AssetDetail;

/**
 * AssetdetailSearch represents the model behind the search form of `app\modules\eoffice_asset\models\AssetDetail`.
 */
class AssetdetailSearch extends AssetDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asset_detail_id', 'asset_dept_type', 'asset_detail_amount', 'asset_detail_age', 'asset_detail_price', 'asset_detail_price_wreck', 'asset_detail_insurance', 'asset_detail_building', 'asset_detail_room', 'asset_asset_id'], 'integer'],
            [['asset_univ_code_start', 'asset_univ_type', 'asset_dept_code_start', 'asset_detail_name', 'asset_detail_brand'], 'safe'],
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
        $query = AssetDetail::find();

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
            'asset_detail_id' => $this->asset_detail_id,
            'asset_dept_type' => $this->asset_dept_type,
            'asset_detail_amount' => $this->asset_detail_amount,
            'asset_detail_age' => $this->asset_detail_age,
            'asset_detail_price' => $this->asset_detail_price,
            'asset_detail_price_wreck' => $this->asset_detail_price_wreck,
            'asset_detail_insurance' => $this->asset_detail_insurance,
            'asset_detail_building' => $this->asset_detail_building,
            'asset_detail_room' => $this->asset_detail_room,
            'asset_asset_id' => $this->asset_asset_id,
        ]);

        $query->andFilterWhere(['like', 'asset_univ_code_start', $this->asset_univ_code_start])
            ->andFilterWhere(['like', 'asset_univ_type', $this->asset_univ_type])
            ->andFilterWhere(['like', 'asset_dept_code_start', $this->asset_dept_code_start])
            ->andFilterWhere(['like', 'asset_detail_name', $this->asset_detail_name])
            ->andFilterWhere(['like', 'asset_detail_brand', $this->asset_detail_brand]);

        return $dataProvider;
    }
}
<?php

namespace app\modules\eoffice_asset\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_asset\models\Asset;

/**
 * AssetSearch represents the model behind the search form about `app\modules\eoffice_asset\models\Asset`.
 */
class AssetSearch extends Asset
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asset_id', 'asset_get', 'asset_budget', 'asset_company'], 'integer'],
            [['asset_date', 'asset_year'], 'safe'],
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
        $query = Asset::find();

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
            'asset_id' => $this->asset_id,
            'asset_date' => $this->asset_date,
            'asset_get' => $this->asset_get,
            'asset_budget' => $this->asset_budget,
            'asset_company' => $this->asset_company,
        ]);

        $query->andFilterWhere(['like', 'asset_year', $this->asset_year]);

        return $dataProvider;
    }
}

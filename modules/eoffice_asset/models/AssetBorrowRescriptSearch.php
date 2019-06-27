<?php

namespace app\modules\eoffice_asset\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_asset\models\AssetBorrowRescript;

/**
 * AssetBorrowRescriptSearch represents the model behind the search form of `app\modules\eoffice_asset\models\AssetBorrowRescript`.
 */
class AssetBorrowRescriptSearch extends AssetBorrowRescript
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borrow_rescript_id', 'asset_borrow_detail_id'], 'integer'],
            [['borrow_rescript_date', 'borrow_rescript_time', 'borrow_rescript_location', 'borrow_rescript_staff'], 'safe'],
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
        $query = AssetBorrowRescript::find();

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
            'borrow_rescript_id' => $this->borrow_rescript_id,
            'asset_borrow_detail_id' => $this->asset_borrow_detail_id,
            'borrow_rescript_date' => $this->borrow_rescript_date,
            'borrow_rescript_time' => $this->borrow_rescript_time,
        ]);

        $query->andFilterWhere(['like', 'borrow_rescript_location', $this->borrow_rescript_location])
            ->andFilterWhere(['like', 'borrow_rescript_staff', $this->borrow_rescript_staff]);

        return $dataProvider;
    }
}

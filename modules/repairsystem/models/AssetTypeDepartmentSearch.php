<?php

namespace app\modules\repairsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\repairsystem\models\AssetTypeDepartment;

/**
 * AssetTypeDepartmentSearch represents the model behind the search form about `app\modules\repairsystem\models\AssetTypeDepartment`.
 */
class AssetTypeDepartmentSearch extends AssetTypeDepartment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asset_type_dept_id'], 'integer'],
            [['asset_type_dept_name', 'asset_type_dept_code'], 'safe'],
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
        $query = AssetTypeDepartment::find();

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
            'asset_type_dept_id' => $this->asset_type_dept_id,
        ]);

        $query->andFilterWhere(['like', 'asset_type_dept_name', $this->asset_type_dept_name])
            ->andFilterWhere(['like', 'asset_type_dept_code', $this->asset_type_dept_code]);

        return $dataProvider;
    }
}

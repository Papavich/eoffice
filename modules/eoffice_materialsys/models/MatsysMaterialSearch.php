<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_materialsys\models\MatsysMaterial;

/**
 * MatsysMaterialSearch represents the model behind the search form about `app\modules\eoffice_materialsys\models\MatsysMaterial`.
 */
class MatsysMaterialSearch extends MatsysMaterial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['material_id', 'material_name', 'material_detail', 'material_unit_name', 'material_image', 'location_id', 'material_type_id'], 'safe'],
            [['material_amount_check', 'material_order_count'], 'integer'],
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
        if(isset($params['search'])){
                $sql ="SELECT * FORM matsys_material WHERE ";
                $query = MatsysMaterial::find()->andFilterWhere(['like','material_name',$params['search']]);
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                ]);
                return $dataProvider;
        }else {


            $query = MatsysMaterial::find();

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $dataProvider->sort->attributes['order_count'] = [
                // The tables are the ones our relation are configured to
                // in my case they are prefixed with "tbl_"
                'asc' => ['material_order_count' => SORT_DESC],
                'desc' => ['material_order_count' => SORT_ASC],
            ];

            $this->load($params);

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                'material_amount_check' => $this->material_amount_check,
            ]);

            $query->andFilterWhere(['like', 'material_id', $this->material_id])
                ->andFilterWhere(['like', 'material_name', $this->material_name])
                ->andFilterWhere(['like', 'material_detail', $this->material_detail])
                ->andFilterWhere(['like', 'material_unit_name', $this->material_unit_name])
                ->andFilterWhere(['like', 'material_image', $this->material_image])
                ->andFilterWhere(['like', 'location_id', $this->location_id]);

            return $dataProvider;
        }
    }
}

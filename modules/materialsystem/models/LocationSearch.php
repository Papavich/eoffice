<?php

namespace app\modules\materialsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\materialsystem\models\MatsysLocation;

/**
 * LocationSearch represents the model behind the search form of `app\modules\materialsystem\models\MatsysLocation`.
 */
class LocationSearch extends MatsysLocation
{
    /**
     * @inheritdoc
     */
    public $lSearch;

    public function rules()
    {
        return [
            [['location_id', 'location_name','lSearch'], 'safe'],
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
        $query = MatsysLocation::find();

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
        $query->orFilterWhere(['like', 'location_id', $this->lSearch])
            ->orFilterWhere(['like', 'location_name', $this->lSearch]);

        return $dataProvider;
    }
}

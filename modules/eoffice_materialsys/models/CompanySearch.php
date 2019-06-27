<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CompanySearch represents the model behind the search form of `app\modules\materialsystem\models\MatsysCompany`.
 */
class CompanySearch extends MatsysCompany
{
    /**
     * @inheritdoc
     */
    public $cSearch;

    public function rules()
    {
        return [
            [['company_id', 'company_name', 'company_address', 'company_phone', 'company_sellman','cSearch'], 'safe'],
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
        $query = MatsysCompany::find();

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
        $query->orFilterWhere(['like', 'company_id', $this->cSearch])
            ->orFilterWhere(['like', 'company_name', $this->cSearch])
            ->orFilterWhere(['like', 'company_address', $this->cSearch])
            ->orFilterWhere(['like', 'company_phone', $this->cSearch])
            ->orFilterWhere(['like', 'company_sellman', $this->cSearch]);

        return $dataProvider;
    }
}

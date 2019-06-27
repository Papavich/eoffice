<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\BranchHasLevel;

/**
 * BranchHasLevelSearch represents the model behind the search form of `app\modules\personsystem\models\BranchHasLevel`.
 */
class BranchHasLevelSearch extends BranchHasLevel
{
    public $branch_name,$LEVELNAME;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELID','branch_name','LEVELNAME'], 'safe'],
            [['branch_id'], 'integer'],
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
        $query = BranchHasLevel::find();
        $query->joinWith(['branch','lEVEL']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'branch_id' => $this->branch_id,
            'reg_level.LEVELNAME'=> $this->LEVELNAME,
            'branch.branch_name'=> $this->branch_name,
        ]);

        $query->andFilterWhere(['like', 'LEVELID', $this->LEVELID])
            ->andFilterWhere(['like', 'reg_level.LEVELNAME', $this->LEVELNAME])
            ->andFilterWhere(['like', 'branch.branch_name', $this->branch_name]);

        return $dataProvider;
    }
}

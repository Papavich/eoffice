<?php

namespace app\modules\portfolio\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\portfolio\models\ProjectRole;

/**
 * ProjectRoleSearch represents the model behind the search form of `app\modules\portfolio\models\ProjectRole`.
 */
class ProjectRoleSearch extends ProjectRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_role_id'], 'integer'],
            [['project_role_name'], 'safe'],
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
        $query = ProjectRole::find();

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
            'project_role_id' => $this->project_role_id,
        ]);

        $query->andFilterWhere(['like', 'project_role_name', $this->project_role_name]);

        return $dataProvider;
    }
}

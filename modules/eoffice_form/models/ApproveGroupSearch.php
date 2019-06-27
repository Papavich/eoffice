<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_form\models\ApproveGroup;

/**
 * ApproveGroupSearch represents the model behind the search form of `app\modules\eoffice_form\models\ApproveGroup`.
 */
class ApproveGroupSearch extends ApproveGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'group_order', 'template_id', 'approve_type_id', 'group_type_id'], 'integer'],
            [['group_name'], 'safe'],
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
        $query = ApproveGroup::find();

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

        $session = Yii::$app->session;
        // grid filtering conditions
        $query->andFilterWhere([
            'group_id' => $this->group_id,
            'group_order' => $this->group_order,
            'template_id' =>  $session['template_id'],
            'approve_type_id' => $this->approve_type_id,
            'group_type_id' => $this->group_type_id,
        ]);

        $query->andFilterWhere(['like', 'group_name', $this->group_name]);

        return $dataProvider;
    }
}




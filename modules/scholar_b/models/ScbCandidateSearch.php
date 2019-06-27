<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbCandidate;
use app\modules\scholar_b\components\ModelHelper;

/**
 * ScbCandidateSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbCandidate`.
 */
class ScbCandidateSearch extends ScbCandidate
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_card', 'password', 'prefix', 'firstname', 'lastname', 'blood_type', 'birth_date', 'origin', 'nationality', 'religion', 'place_of_birth', 'email', 'mobile', 'status', 'schoolname', 'school_status', 'crtime', 'udtime'], 'safe'],
            [['total_brethren', 'number_of_sister', 'number_of_brother', 'crby', 'udby'], 'integer'],
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
        $query = ScbCandidate::find();

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
            'birth_date' => $this->birth_date,
            'total_brethren' => $this->total_brethren,
            'number_of_sister' => $this->number_of_sister,
            'number_of_brother' => $this->number_of_brother,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'id_card', $this->id_card])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'blood_type', $this->blood_type])
            ->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'place_of_birth', $this->place_of_birth])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'schoolname', $this->schoolname])
            ->andFilterWhere(['like', 'school_status', $this->school_status]);

        return $dataProvider;
    }
}

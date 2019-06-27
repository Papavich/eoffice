<?php

namespace app\modules\scholar_b\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\scholar_b\models\ScbFunded;
use app\modules\scholar_b\components\ModelHelper;

/**
 * ScbFundedSearch represents the model behind the search form of `app\modules\scholar_b\models\ScbFunded`.
 */
class ScbFundedSearch extends ScbFunded
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
            [['student_id', 'funded_date', 'crtime', 'udtime'], 'safe'],
            [['funded_type_id', 'year', 'semester', 'crby', 'udby'], 'integer'],
            [['funded_amount'], 'number'],
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
        $query = ScbFunded::find();

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
            'funded_type_id' => $this->funded_type_id,
            'funded_date' => $this->funded_date,
            'year' => $this->year,
            'semester' => $this->semester,
            'funded_amount' => $this->funded_amount,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'student_id', $this->student_id]);

        return $dataProvider;
    }
}

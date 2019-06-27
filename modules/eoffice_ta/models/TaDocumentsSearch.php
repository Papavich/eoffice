<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_ta\models\TaDocuments;

/**
 * TaDocumentsSearch represents the model behind the search form of `app\modules\eoffice_ta\models\TaDocuments`.
 */
class TaDocumentsSearch extends TaDocuments
{
    public $q;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_documents_id', 'crby', 'udby'], 'integer'],
            [['q','ta_documents_name', 'ta_doc_detail', 'ta_documents_path', 'ta_doc_status', 'crtime', 'udtime'], 'safe'],
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
        $query = TaDocuments::find();

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
            'ta_documents_id' => $this->ta_documents_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->orFilterWhere(['like', 'ta_documents_name', $this->q])
            ->orFilterWhere(['like', 'ta_doc_detail', $this->q])
            ->orFilterWhere(['like', 'ta_documents_path', $this->q])
            ->orFilterWhere(['like', 'ta_doc_status', $this->q]);

        return $dataProvider;
    }
}

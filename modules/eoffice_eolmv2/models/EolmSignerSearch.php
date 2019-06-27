<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolmv2\models\EolmSigner;

/**
 * EolmSignerSearch represents the model behind the search form about `app\modules\eoffice_eolmv2\models\EolmSigner`.
 */
class EolmSignerSearch extends EolmSigner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_signer_status', 'person_id', 'eolm_signer_type_id'], 'integer'],
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
        $query = EolmSigner::find();

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
            'eolm_signer_status' => $this->eolm_signer_status,
            'person_id' => $this->person_id,
            'eolm_signer_type_id' => $this->eolm_signer_type_id,
        ]);

        return $dataProvider;
    }
}

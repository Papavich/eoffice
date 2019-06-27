<?php

namespace app\modules\eoffice_eolm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolm\models\EolmReceiptStudent;

/**
 * EolmReceiptStudentSearch represents the model behind the search form of `app\modules\eoffice_eolm\models\EolmReceiptStudent`.
 */
class EolmReceiptStudentajSearch extends EolmReceiptStudent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_app_id','crby', 'udby'], 'integer'],
            [['person_id'], 'string', 'max' => 20],
            [['crtime', 'udtime'], 'safe'],
            [['eolm_rec_std_total'], 'number'],
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
        $query = EolmReceiptStudent::find()->where(['crby' => Yii::$app->user->identity->getId()]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['udtime'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'eolm_app_id' => $this->eolm_app_id,
            'person_id' => $this->person_id,
            'eolm_rec_std_total' => $this->eolm_rec_std_total,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        return $dataProvider;
    }
}

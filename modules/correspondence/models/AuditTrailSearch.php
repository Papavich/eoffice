<?php

namespace app\modules\correspondence\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AuditTrailSearch
 * @package bedezign\yii2\audit\models
 */
class AuditTrailSearch extends AuditTrail
{
    /**
     * @return array
     */
    public $document;

    public function rules()
    {
        // Note: The model is used by both the entry and the trail index pages, hence the separate use of `id` and `entry_id`
        return [
            [['id', 'user_id', 'entry_id', 'action', 'model',
                'model_id', 'field', 'created', 'document'], 'safe',
            ],
        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param $params
     * @param null $query
     * @return ActiveDataProvider
     */
    public function search($params, $query = null)
    {

        $query = $query ? $query : $this->find()->groupBy(['model_id']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'entry_id' => SORT_DESC
                ]
            ]
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['document']);
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $userId = $this->user_id;
        if (strlen($this->user_id))
            $userId = intval($this->user_id) ?: 0;

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['entry_id' => $this->entry_id]);
        $query->andFilterWhere(['user_id' => $userId]);
        $query->andFilterWhere(['action' => $this->action]);
        $query->andFilterWhere(['like', 'model', $this->model]);
        //$query->andFilterWhere(['model_id' => $this->document]);

        if (is_array($this->field)) {
            $query->andFilterWhere(['in', 'field', $this->field]);
        } else {
            $query->andFilterWhere(['field' => $this->field]);
        }
        if($this->model_id){
            // filter by cms_document.doc_subject name
            $query->joinWith(['document' => function ($q) {
                $q->where('cms_document.doc_subject LIKE "%' . $this->model_id . '%"');
            }]);
        }
        return $dataProvider;
    }

    public function searchAuditTrail($params)
    {

        $query = $this->find()
            ->where(['model_id' => $params['id']])
            ->joinWith(['document']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created' => SORT_DESC
                ]
            ]
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $userId = $this->user_id;
        if (strlen($this->user_id))
            $userId = intval($this->user_id) ?: 0;

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['entry_id' => $this->entry_id]);
        $query->andFilterWhere(['user_id' => $userId]);
        $query->andFilterWhere(['action' => $this->action]);
        $query->andFilterWhere(['like', 'model', $this->model]);

        if (is_array($this->field)) {
            $query->andFilterWhere(['in', 'field', $this->field]);
        } else {
            $query->andFilterWhere(['field' => $this->field]);
        }
        $query->andFilterWhere(['like', 'created', $this->created]);

        return $dataProvider;
    }

    /**
     * @return array
     */
    static public function actionFilter()
    {
        return \yii\helpers\ArrayHelper::map(
            self::find()->select('action')->groupBy('action')->orderBy('action ASC')->all(),
            'action',
            'action'
        );
    }
}

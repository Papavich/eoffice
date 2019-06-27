<?php

namespace app\modules\correspondence\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\correspondence\models\CmsDocument;
use yii\db\Expression;
use yii\helpers\Json;

/**
 * DocumentGridView represents the model behind the search form of `app\modules\correspondence\models\CmsDocument`.
 */
class DocumentGridView extends CmsDocument
{
// add the public attributes that will be used to store the data to be search
    public $cmsDocRollReceives;
    public $cmsDocRollSends;
    public $docDept;
    public $cmsInboxes;
    public $user;
    public $check;

    public function rules()
    {
        return [
            [['doc_id', 'doc_subject', 'receive_date', 'sent_date', 'doc_rank', 'doc_expire', 'doc_tel', 'doc_date', 'doc_from', 'doc_id_regist', 'doc_ref', 'address_id'], 'safe'],
            [['check_id', 'secret_id', 'speed_id', 'type_id', 'user_id', 'sub_type_id', 'doc_dept_id'], 'integer'],
            [['money'], 'number'],
            [['check'], 'string'],
            [['subType', 'cmsDocRollReceives', 'cmsDocRollSends', 'docDept',
                'cmsInboxes', 'user', 'check'], 'safe'],
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
    public function filterTypeSend($params)
    {
        if (empty($params['viewpoint'])) {
            $data = $this->searchRoll($params);
            return $data;
        } elseif ($params['viewpoint'] == "roll-send") {
            $data = $this->searchSend($params);
            return $data;
        } elseif ($params['viewpoint'] == "folder") {
            $data = $this->searchRoll($params);
            return $data;
        }
    }

    public function filterTypeReceive($params)
    {
        if (empty($params['viewpoint'])) {
            $data = $this->searchRoll($params);
            return $data;
        } elseif ($params['viewpoint'] == "roll-receive") {
            $data = $this->searchReceive($params);
            return $data;
        } elseif ($params['viewpoint'] == "folder") {
            $data = $this->searchRoll($params);
            return $data;
        }
        if (!empty($params['id'])) {
            $data = $this->searchSendInFolder($params);
            return $data;
        }
    }

    public function searchSend($params)
    {
        $query = CmsDocument::find()->joinWith(['check'])
            ->innerJoin('cms_doc_roll_send', 'cms_document.doc_id = cms_doc_roll_send.doc_id');

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        $dataProvider->sort->attributes['subType'] = [
            'asc' => ['cms_doc_sub_type.sub_type_name' => SORT_ASC],
            'desc' => ['cms_doc_sub_type.sub_type_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cmsDocRollSends'] = [
            'asc' => ['doc_roll_send_id' => SORT_ASC],
            'desc' => ['doc_roll_send_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cmsDocRollSendsDoing'] = [
            'asc' => ['doc_roll_send_doing' => SORT_ASC],
            'desc' => ['doc_roll_send_doing' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['docDept'] = [
            'asc' => ['doc_dept_name' => SORT_ASC],
            'desc' => ['doc_dept_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['check'] = [
            'asc' => ['check_name' => SORT_ASC],
            'desc' => ['check_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sent_date' => $this->sent_date,
            'doc_date' => $this->doc_date,
            'doc_dept_id' => $this->doc_dept_id,
            'subType' => $this->subType,
            'cmsDocRollSends' => $this->cmsDocRollSends,
            'doc_id_regist' => $this->doc_id_regist,
            //   'check'=>$this->check,
        ]);

        $query->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'doc_subject', $this->doc_subject])
            ->andFilterWhere(['like', 'doc_from', $this->doc_from])
            ->andFilterWhere(['like', 'doc_id_regist', $this->doc_id_regist]);
        if (null !== $this->cmsDocRollSends) {
            $query->orFilterWhere(['like', 'cmsDocRollSends.doc_roll_send_id', $this->cmsDocRollSends->doc_roll_send_id]);
        }
        return $dataProvider;
    }

    public function searchReceiveInFolder($params, $querySearch)
    {
        if (!empty($params['id']) && is_null($querySearch)) {
            $query = CmsDocument::find()
                ->where(['address_id' => $params['id']])
                ->joinWith(['check', 'docDept'])
                ->innerJoin('cms_doc_roll_receive', 'cms_document.doc_id = cms_doc_roll_receive.doc_id');
        } elseif (!is_null($querySearch)) {
            $query = CmsDocument::find()
                ->where(['cms_document.doc_id' => $querySearch])
                ->joinWith(['check', 'docDept'])
                ->innerJoin('cms_doc_roll_receive', 'cms_document.doc_id = cms_doc_roll_receive.doc_id')
                ->orderBy([new Expression((" FIELD (cms_document.doc_id,".
                    substr(json_encode($querySearch),1,-1)
                .")"))]);
        } else {
            $query = CmsDocument::find()
                ->joinWith(['check', 'docDept'])
                ->innerJoin('cms_doc_roll_receive', 'cms_document.doc_id = cms_doc_roll_receive.doc_id');
        }
        // add conditions that should always apply here
        if (!empty($params['keyword']) || !empty($params['range-date'])) {

            $filter = [
                'doc_id' => $querySearch
            ];
            //echo Json::encode($filter);
        }else{
            $filter = false;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            /*'sort' => [
                'defaultOrder' => $filter
            ]*/

        ]);
        //SELECT * FROM `cms_document`
        // WHERE doc_id IN ('DID20180425154324290195','DID20180423161301157650')
        // ORDER BY FIELD(doc_id,'DID20180423161301157650','DID20180425154324290195')
        /*$dataProvider->query->orderBy([new Expression((" FIELD (cms_document.doc_id,
        \"DID20180425154324290195\",\"DID20180423161301157650\")"))]);*/
        $dataProvider->sort->attributes['subType'] = [
            'asc' => ['cms_doc_sub_type.sub_type_name' => SORT_ASC],
            'desc' => ['cms_doc_sub_type.sub_type_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cmsDocRollReceives'] = [
            'asc' => ['doc_roll_receive_id' => SORT_ASC],
            'desc' => ['doc_roll_receive_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cmsDocRollReceivesDoing'] = [
            'asc' => ['doc_roll_receive_doing' => SORT_ASC],
            'desc' => ['doc_roll_receive_doing' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['docDept'] = [
            'asc' => ['doc_dept_name' => SORT_ASC],
            'desc' => ['doc_dept_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['check'] = [
            'asc' => ['check_name' => SORT_ASC],
            'desc' => ['check_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cmsInboxes'] = [
            'asc' => ['user_id' => SORT_ASC],
            'desc' => ['user_id' => SORT_DESC],
        ];
        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sent_date' => $this->sent_date,
            'doc_date' => $this->doc_date,
            'doc_dept_id' => $this->doc_dept_id,
            'subType' => $this->subType,
            //'cmsDocRollReceives' => $this->cmsDocRollReceives,
            'doc_id_regist' => $this->doc_id_regist,
            'check' => $this->check,
        ]);

        $query->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'doc_subject', $this->doc_subject])
            ->andFilterWhere(['like', 'doc_from', $this->doc_from])
            ->andFilterWhere(['like', 'doc_id_regist', $this->doc_id_regist]);

        return $dataProvider;
    }

    public function searchRoll($params)
    {

        $query = CmsAddress::find()
            ->joinWith(['subType']);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]
        ]);
        $dataProvider->sort->attributes['subType'] = [
            'asc' => ['cms_doc_sub_type.sub_type_name' => SORT_ASC],
            'desc' => ['cms_doc_sub_type.sub_type_name' => SORT_DESC],
        ];
        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sub_type_id' => $this->sub_type_id,
            'address_name' => $this->address_name,
            'subType' => $this->subType,
            'address_id' => $this->address_id,
            //  'orderSum.count' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'address_id', $this->address_id]);
        if (null !== $this->subType) {
            $query->orFilterWhere(['like', 'subType.sub_type_name', $this->subType->sub_type_name]);
        }

        return $dataProvider;
    }

    public function searchSendInFolder($params, $querySearch)
    {
        if (!empty($params['id']) && is_null($querySearch)) {
            $query = CmsDocument::find()
                ->where(['address_id' => $params['id']])
                ->joinWith(['check', 'docDept'])
                ->innerJoin('cms_doc_roll_send',
                    'cms_document.doc_id = cms_doc_roll_send.doc_id');
        } elseif (!is_null($querySearch)) {
            $query = CmsDocument::find()
                ->where(['cms_document.doc_id' => $querySearch])
                ->andFilterWhere(['in', 'cms_document.doc_id', $querySearch])
                ->joinWith(['check', 'docDept'])
                ->innerJoin('cms_doc_roll_send',
                    'cms_document.doc_id = cms_doc_roll_send.doc_id')
                ->orderBy([new Expression((" FIELD (cms_document.doc_id,".
                    substr(json_encode($querySearch),1,-1)
                    .")"))]);
        } else {
            $query = CmsDocument::find()
                ->joinWith(['check', 'docDept'])
                ->innerJoin('cms_doc_roll_send',
                    'cms_document.doc_id = cms_doc_roll_send.doc_id');

        }
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],

        ]);
        $dataProvider->sort->attributes['subType'] = [
            'asc' => ['cms_doc_sub_type.sub_type_name' => SORT_ASC],
            'desc' => ['cms_doc_sub_type.sub_type_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cmsDocRollSends'] = [
            'asc' => ['doc_roll_send_id' => SORT_ASC],
            'desc' => ['doc_roll_send_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cmsDocRollSendsDoing'] = [
            'asc' => ['doc_roll_send_doing' => SORT_ASC],
            'desc' => ['doc_roll_send_doing' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['docDept'] = [
            'asc' => ['doc_dept_name' => SORT_ASC],
            'desc' => ['doc_dept_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['check'] = [
            'asc' => ['check_name' => SORT_ASC],
            'desc' => ['check_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sent_date' => $this->sent_date,
            'doc_date' => $this->doc_date,
            'doc_dept_id' => $this->doc_dept_id,
            'subType' => $this->subType,
            //'cmsDocRollSends' => $this->cmsDocRollSends,
            'doc_id_regist' => $this->doc_id_regist,
            //   'check'=>$this->check,
        ]);

        $query->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'doc_subject', $this->doc_subject])
            ->andFilterWhere(['like', 'doc_from', $this->doc_from])
            ->andFilterWhere(['like', 'doc_id_regist', $this->doc_id_regist]);

        return $dataProvider;
    }
}

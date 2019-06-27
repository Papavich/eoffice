<?php

namespace app\modules\correspondence\models;

use app\modules\correspondence\controllers;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\correspondence\models\CmsInbox;
use yii\data\Pagination;
use yii\db\Expression;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\widgets\LinkPager;

/**
 * MailSearch represents the model behind the search form of `app\modules\correspondence\models\CmsInbox`.
 */
class MailSearch extends CmsInbox
{
// add the public attributes that will be used to store the data to be search
    public $inboxes;
    public $inboxLabels;
    public $docDept;
    public $secret;
    public $user;
    public $speed;
    public $doc;
    public $outbox;
    public $cmsInboxes;
    public $outbox_time;

    public function rules()
    {
        return [
            [['inbox_id', 'inbox_status', 'inbox_subject', 'inbox_content', 'inbox_time', 'doc_id', 'approve_status', 'approve_time', 'message_reply_time', 'message_approve', 'message_reply', 'outbox_id', 'read_time'], 'safe'],
            [['user_id', 'approve_by', 'inbox_fav', 'inbox_trash'], 'integer'],
            [['outbox_time'], 'safe'],
            [['subType', 'cmsDocRollReceives', 'cmsDocRollSends', 'docDept',
                'speed', 'user', 'secret', 'doc', 'inboxLabels', 'inboxes', 'outbox', 'cmsInboxes'], 'safe'],
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

    public function findInbox($params, $querySearch)
    {
        //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (!$querySearch && empty($params['id']) && empty($params['address_id'])) {
            $query = CmsInbox::find()
                ->where(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere(['cms_inbox.inbox_trash' => 0])
                ->joinWith(['doc', 'doc.speed', 'doc.secret']);

        } elseif ($querySearch) {
            $query = CmsInbox::find()
                ->where(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere(['cms_inbox.doc_id' => $querySearch])
                ->andWhere(['cms_inbox.inbox_trash' => 0])
                ->joinWith(['doc', 'doc.speed', 'doc.secret'])
                ->orderBy([new Expression((" FIELD (cms_inbox.doc_id," .
                    substr(json_encode($querySearch), 1, -1)
                    . ")"))]);
        } elseif (!empty($params['id'])) {
            //if user search label
            $query = CmsInbox::find()
                ->where(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere(['inbox_trash' => 0])
                ->andWhere(['inbox_label.label_id' => $params['id']])
                ->joinWith(['inboxLabels', 'doc', 'doc.speed', 'doc.secret']);
        } elseif (!empty($params['address_id'])) {
            $query = CmsInbox::find()
                ->where(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere(['inbox_trash' => 0])
                ->andWhere(['cms_document.address_id' => $params['address_id']])
                ->joinWith(['inboxLabels', 'doc', 'doc.speed', 'doc.secret', 'doc.address']);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
            'sort' => [
                'defaultOrder' => [
                    'inbox_time' => SORT_DESC
                ]
            ]
        ]);
        $dataProvider->sort->attributes['speed'] = [
            'asc' => ['cms_doc_speed.speed_id' => SORT_ASC],
            'desc' => ['cms_doc_speed.speed_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['secret'] = [
            'asc' => ['cms_doc_secret.secret_id' => SORT_ASC],
            'desc' => ['cms_doc_secret.secret_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['inbox_time'] = [
            'asc' => ['cms_inbox.inbox_time' => SORT_ASC],
            'desc' => ['cms_inbox.inbox_time' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'inbox_time' => $this->inbox_time,
            'speed' => $this->speed,
            'secret' => $this->secret,
        ]);

        $query->andFilterWhere(['like', 'inbox_id', $this->inbox_id])
            ->andFilterWhere(['like', 'inbox_status', $this->inbox_status])
            ->andFilterWhere(['like', 'inbox_subject', $this->inbox_subject])
            ->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'inbox_time', $this->inbox_time])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'speed', $this->speed]);

        return array($dataProvider, $pages);
    }

    public function findByJunkMail($params, $querySearch)
    {
        //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (empty($params['id']) && empty($params['address_id'])) {
            $query = CmsOutbox::find()
//                ->where('cms_outbox.user_id = '.$user->id.'')
//                ->andWhere(['cms_outbox.outbox_trash' => 1])
                ->where('cms_outbox.user_id = ' . UserDAO::getCurentUser()->id . '')
                ->andWhere(['=', 'cms_outbox.outbox_trash', new Expression('1')])
                //->andWhere(['!=', 'cms_inbox.inbox_trash', new Expression('0')])
                // ->having(['cms_inbox.inbox_trash' => 1])
                ->orWhere('cms_inbox.user_id = ' . UserDAO::getCurentUser()->id . ' AND cms_inbox.inbox_trash = 1')
                //->groupBy('cms_outbox.outbox_subject')
                ->joinWith(['doc', 'doc.speed', 'doc.secret', 'cmsInboxes'])
                ->distinct();

        } elseif ($querySearch) {
            $query = CmsOutbox::find()
                ->where('cms_outbox.user_id = ' . UserDAO::getCurentUser()->id . '')
                ->andWhere(['=', 'cms_outbox.outbox_trash', new Expression('1')])
                //->andWhere(['!=', 'cms_inbox.inbox_trash', new Expression('0')])
                ->andWhere(['cms_outbox.doc_id' => $querySearch])
                ->orWhere('cms_inbox.user_id =' . UserDAO::getCurentUser()->id . ' AND cms_inbox.inbox_trash = 1')
                //->groupBy('cms_outbox.outbox_id')
                ->joinWith(['doc', 'doc.speed', 'doc.secret', 'cmsInboxes'])
                ->distinct()
                ->orderBy([new Expression((" FIELD (cms_outbox.doc_id," .
                    substr(json_encode($querySearch), 1, -1)
                    . ")"))]);
        } elseif (!empty($params['id'])) {
            //if user search label
            $query = CmsInbox::find()
                ->where(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere(['=', 'cms_inbox.inbox_trash', new Expression('1')])
                ->orWhere(['=', 'cms_outbox.outbox_trash', new Expression('1')])
                ->andWhere(['inbox_label.label_id' => $params['id']])
                ->joinWith(['inboxLabels', 'doc', 'doc.speed', 'doc.secret', 'outbox']);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages
        ]);
        $dataProvider->sort->attributes['speed'] = [
            'asc' => ['cms_doc_speed.speed_id' => SORT_ASC],
            'desc' => ['cms_doc_speed.speed_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['secret'] = [
            'asc' => ['cms_doc_secret.secret_id' => SORT_ASC],
            'desc' => ['cms_doc_secret.secret_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['inbox_time'] = [
            'asc' => ['cms_outbox.outbox_time' => SORT_ASC],
            'desc' => ['cms_outbox.outbox_time' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'inbox_time' => $this->inbox_time,
            'speed' => $this->speed,
            'secret' => $this->secret,
            'outbox' => $this->outbox
        ]);

        $query->andFilterWhere(['like', 'inbox_id', $this->inbox_id])
            ->andFilterWhere(['like', 'inbox_time', $this->inbox_time])
            ->andFilterWhere(['like', 'inbox_status', $this->inbox_status])
            ->andFilterWhere(['like', 'inbox_subject', $this->inbox_subject])
            ->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'speed', $this->speed]);
        return array($dataProvider, $pages);
    }

    public function findByFavMail($params, $querySearch)
    {
       // $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (!$querySearch && empty($params['id']) && empty($params['address_id'])) {
            $query = CmsInbox::find()->where(['inbox_fav' => 1])
                ->andWhere('cms_inbox.user_id = ' . UserDAO::getCurentUser()->id)
                ->andWhere(['=', 'cms_inbox.inbox_trash', 0])
                ->joinWith(['doc', 'doc.speed', 'doc.secret']);
        } elseif ($querySearch) {
            $query = CmsInbox::find()->where(['inbox_fav' => 1])
                ->andWhere(['cms_inbox.doc_id' => $querySearch])
                ->andWhere('cms_inbox.user_id = ' . UserDAO::getCurentUser()->id)
                ->andWhere(['=', 'cms_inbox.inbox_trash', 0])
                ->joinWith(['doc', 'doc.speed', 'doc.secret'])
                ->orderBy([new Expression((" FIELD (cms_outbox.doc_id," .
                    substr(json_encode($querySearch), 1, -1)
                    . ")"))]);;
        } else {
            //if user search label
            $query = CmsInbox::find()
                ->where(['inbox_fav' => 1])
                ->andWhere('cms_inbox.user_id = ' . UserDAO::getCurentUser()->id)
                ->andWhere(['=', 'cms_inbox.inbox_trash', 0])
                ->andWhere(['inbox_label.label_id' => $params['id']])
                ->joinWith(['inboxLabels', 'doc', 'doc.speed', 'doc.secret']);

        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
            'sort' => [
                'defaultOrder' => [
                    'inbox_time' => SORT_DESC
                ]
            ]
        ]);
        $dataProvider->sort->attributes['speed'] = [
            'asc' => ['cms_doc_speed.speed_id' => SORT_ASC],
            'desc' => ['cms_doc_speed.speed_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['secret'] = [
            'asc' => ['cms_doc_secret.secret_id' => SORT_ASC],
            'desc' => ['cms_doc_secret.secret_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['inbox_time'] = [
            'asc' => ['inbox_time' => SORT_ASC],
            'desc' => ['inbox_time' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'inbox_time' => $this->inbox_time,
            'speed' => $this->speed,
            'secret' => $this->secret,
        ]);

        $query->andFilterWhere(['like', 'inbox_id', $this->inbox_id])
            ->andFilterWhere(['like', 'inbox_status', $this->inbox_status])
            ->andFilterWhere(['like', 'inbox_subject', $this->inbox_subject])
            ->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'speed', $this->speed]);

        return array($dataProvider, $pages);
    }

    public function findInboxByCategory($params)
    {
        //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (empty($params['address_id'])) {
            $query = CmsInbox::find()
                ->where('cms_inbox.doc_id = cms_document.doc_id')
                ->andWhere(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere('cms_document.address_id = cms_address.address_id')
                ->andWhere(['=', 'cms_inbox.inbox_trash', 0])
                ->groupBy(['cms_address.address_id'])
                ->joinWith(['doc', 'doc.speed', 'doc.secret', 'doc.address', 'doc.subType']);

        } else {
            $query = CmsInbox::find()
                ->where('cms_inbox.doc_id = cms_document.doc_id')
                ->andWhere(['cms_inbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere(['cms_address.address_id' => $params['address_id']])
                ->andWhere(['=', 'cms_inbox.inbox_trash', 0])
                ->groupBy(['cms_address.address_id'])
                ->joinWith(['doc', 'doc.speed', 'doc.secret', 'doc.address', 'doc.subType']);
        }

        // add conditions that should always apply here
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
            'sort' => [
                'defaultOrder' => [
                    'inbox_time' => SORT_DESC
                ]
            ]
        ]);
        $dataProvider->sort->attributes['speed'] = [
            'asc' => ['cms_doc_speed.speed_id' => SORT_ASC],
            'desc' => ['cms_doc_speed.speed_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['address_year'] = [
            'asc' => ['address_year' => SORT_ASC],
            'desc' => ['address_year' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['address_name'] = [
            'asc' => ['address_name' => SORT_ASC],
            'desc' => ['address_name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['subType'] = [
            'asc' => ['cms_doc_sub_type.sub_type_name' => SORT_ASC],
            'desc' => ['cms_doc_sub_type.sub_type_name' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'doc.address' => $this->doc,
        ]);

        $query->andFilterWhere(['like', 'inbox_id', $this->inbox_id])
            ->andFilterWhere(['like', 'inbox_status', $this->inbox_status])
            ->andFilterWhere(['like', 'inbox_subject', $this->inbox_subject])
            ->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'speed', $this->speed]);

        return array($dataProvider, $pages);
    }

    public function findOutbox($params, $querySearch)
    {
        //$user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        if (!$querySearch && empty($params['id']) && empty($params['address_id'])) {
            $query = CmsOutbox::find()
                ->distinct()
                ->where(['cms_outbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere('cms_outbox.user_id = user.id')
                ->andWhere('cms_outbox.outbox_id = cms_inbox.outbox_id')
                ->andWhere('cms_outbox.outbox_trash = 0')
                //->groupBy(['cms_inbox.user_id', 'cms_outbox.outbox_subject'])
                ->joinWith(['doc', 'doc.speed', 'doc.secret', 'user', 'cmsInboxes']);
        } elseif ($querySearch) {
            $query = CmsOutbox::find()
                ->distinct()
                ->where(['cms_outbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere(['cms_outbox.doc_id' => $querySearch])
                ->andWhere('cms_outbox.user_id = user.id')
                ->andWhere('cms_outbox.outbox_trash = 0')
                ->groupBy(['cms_inbox.user_id', 'cms_outbox.outbox_subject'])
                ->joinWith(['doc', 'doc.speed', 'doc.secret', 'user', 'cmsInboxes'])
                ->orderBy([new Expression((" FIELD (cms_outbox.doc_id,".
                    substr(json_encode($querySearch),1,-1)
                    .")"))]);
        } elseif (!empty($params['id'])) {
            //if user search label
            $query = CmsOutbox::find()
                ->distinct()
                ->where(['cms_outbox.user_id' => UserDAO::getCurentUser()->id])
                ->andWhere('cms_outbox.user_id = user.id')
                ->andWhere('cms_outbox.outbox_id = cms_inbox.outbox_id')
                ->andWhere(['inbox_label.label_id' => $params['id']])
                ->andWhere('cms_outbox.outbox_trash = 0')
                ->joinWith(['user', 'cmsInboxes', 'cmsInboxes.inboxLabels', 'doc', 'doc.speed', 'doc.secret']);

        }
        // add conditions that should always apply here
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 15,]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages,
            'sort' => [
                'defaultOrder' => [
                    'outbox_time' => SORT_DESC
                ]
            ]
        ]);
        $dataProvider->sort->attributes['speed'] = [
            'asc' => ['cms_doc_speed.speed_id' => SORT_ASC],
            'desc' => ['cms_doc_speed.speed_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['secret'] = [
            'asc' => ['cms_doc_secret.secret_id' => SORT_ASC],
            'desc' => ['cms_doc_secret.secret_id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['inbox_time'] = [
            'asc' => ['outbox_time' => SORT_ASC],
            'desc' => ['outbox_time' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'inbox_time' => $this->inbox_time,
            'speed' => $this->speed,
            'secret' => $this->secret,
            'outbox' => $this->outbox,
        ]);

        $query->andFilterWhere(['like', 'inbox_id', $this->inbox_id])
            ->andFilterWhere(['like', 'inbox_status', $this->inbox_status])
            ->andFilterWhere(['like', 'inbox_subject', $this->inbox_subject])
            ->andFilterWhere(['like', 'doc_id', $this->doc_id])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'speed', $this->speed]);

        return array($dataProvider, $pages);
    }

    public function findQueue($params, $querySearch)
    {
        if (!$querySearch) {
            $query = CmsQueue::find()->orderBy(['status' => SORT_ASC])
                ->joinWith(['outbox', 'outbox.doc']);
        } else {
            $query = CmsQueue::find()
                ->where(['outbox_doc_id' => $querySearch])
                ->orderBy([new Expression((" FIELD (cms_outbox.doc_id,".
                    substr(json_encode($querySearch),1,-1)
                    .")"))])
                ->joinWith(['outbox', 'outbox.doc']);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pages
        ]);
        $dataProvider->sort->attributes['outbox.doc.doc_subject'] = [
            'asc' => ['cms_document.doc_subject' => SORT_ASC],
            'desc' => ['cms_document.doc_subject' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['outbox.outbox_time'] = [
            'asc' => ['cms_outbox.outbox_time' => SORT_ASC],
            'desc' => ['cms_outbox.outbox_time' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'doc' => $this->doc,
            'outbox' => $this->outbox,
        ]);

        $query
            ->andFilterWhere(['like', 'doc_id', $this->doc_id]);

        return array($dataProvider, $pages);
    }
}
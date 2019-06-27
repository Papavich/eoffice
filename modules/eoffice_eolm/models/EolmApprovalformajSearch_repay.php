<?php

namespace app\modules\eoffice_eolm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_eolm\models\EolmApprovalform;
use yii\web\NotFoundHttpException;

/**
 * EolmApprovalformsfSearch represents the model behind the search form about `app\modules\eolm\models\EolmApprovalform`.
 */
class EolmApprovalformajSearch_repay extends EolmLoancontract
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_app_id', 'eolm_loa_examiner', 'eolm_loa_approvers', 'crby', 'udby'], 'integer'],
            [['eolm_loa_date', 'eolm_loa_use_date', 'eolm_loa_refund_date', 'eolm_loa_number', 'crtime', 'udtime'], 'safe'],
            [['eolm_loa_total_amout'], 'number'],
        ];
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
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
        $query = EolmLoancontract::find()->joinWith('eolmApp')->where(['crby' => Yii::$app->user->identity->getId(),'eolm_status_id' => 3]);

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
            'eolm_loa_date' => $this->eolm_loa_date,
            'eolm_loa_use_date' => $this->eolm_loa_use_date,
            'eolm_loa_refund_date' => $this->eolm_loa_refund_date,
            'eolm_loa_examiner' => $this->eolm_loa_examiner,
            'eolm_loa_approvers' => $this->eolm_loa_approvers,
            'eolm_loa_total_amout' => $this->eolm_loa_total_amout,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,
        ]);

        $query->andFilterWhere(['like', 'eolm_loa_number', $this->eolm_loa_number]);

        return $dataProvider;
    }
}

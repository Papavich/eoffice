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
class EolmApprovalformajSearch_dis extends EolmApprovalform
{    public $person1;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['eolm_app_id','eolm_type_id', 'eolm_status_id', 'eolm_budp_id', 'eolm_budt_id', /*'eolm_exp_id', */ 'pro_id', 'crby', 'udby'], 'integer'],
            [['eolm_app_date', 'eolm_app_subject', 'eolm_app_number', 'eolm_app_deprture_date', 'eolm_app_retuen_date', 'eolm_budget_year', 'eolm_link', 'crtime', 'udtime'], 'safe'],
            //[['eolm_app_borrow_money'], 'number'],
            [['person1'], 'safe'],
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
        $query = EolmApprovalform::find()->joinWith('person1')->leftJoin('eoffice_central.view_pis_user', 'eoffice_central.view_pis_user.person_id = eolm_approvalform_has_personal.person_id')->where(['eolm_status_id' => 3,'eoffice_central.view_pis_user.id'=>Yii::$app->user->identity->id]);

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
            //'eolm_app_date' => $this->eolm_app_date,
            'eolm_app_deprture_date' => $this->eolm_app_deprture_date,
            'eolm_app_retuen_date' => $this->eolm_app_retuen_date,
            //'eolm_app_borrow_money' => $this->eolm_app_borrow_money,
            /*'eolm_approver_major' => $this->eolm_approver_major,
            'eolm_approver_dean' => $this->eolm_approver_dean,
            'eolm_approver_finance' => $this->eolm_approver_finance,*/
            'eolm_budget_year' => $this->eolm_budget_year,
            'eolm_type_id' => $this->eolm_type_id,
            'eolm_status_id' => $this->eolm_status_id,
            'eolm_budp_id' => $this->eolm_budp_id,
            /*'eolm_budt_id' => $this->eolm_budt_id,*/
            /*'eolm_exp_id' => $this->eolm_exp_id,*/
            'pro_id' => $this->pro_id,
            'crby' => $this->crby,
            'crtime' => $this->crtime,
            'udby' => $this->udby,
            'udtime' => $this->udtime,

            'eolm_approvalform_has_personal.person_id' => $this->person1,
        ]);
        if(isset ($this->eolm_app_date)&&$this->eolm_app_date!=''){ //you dont need the if function if yourse sure you have a not null date
            $date_explode=explode(" - ",$this->eolm_app_date);
            $date1=trim($date_explode[0]);
            $date2=trim($date_explode[1]);
            $query->andFilterWhere(['between','eolm_app_date',$date1,$date2]);
        }

        $query->andFilterWhere(['like', 'eolm_app_subject', $this->eolm_app_subject])
            ->andFilterWhere(['like', 'eolm_app_number', $this->eolm_app_number])
            ->andFilterWhere(['like', 'eolm_link', $this->eolm_link]);

        return $dataProvider;
    }

}

<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\personsystem\models\Person;

/**
 * PersonSearch represents the model behind the search form of `app\modules\personsystem\models\Person`.
 */
class PersonSearch extends Person
{
    public $major_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'person_current_district', 'person_current_amphur', 'person_current_province', 'person_current_zipcode', 'person_home_district', 'person_home_amphur', 'person_home_province', 'person_home_zipcode', 'major_id', 'person_religion_id', 'person_nation_id'], 'integer'],
            [['person_card_id', 'person_name', 'person_name_eng', 'person_surname', 'person_surname_eng', 'person_citizen_id', 'prefix_id', 'person_gender', 'person_birthdate', 'person_operate_status', 'person_duty', 'person_start_date', 'person_contract_date', 'person_expire_date', 'person_confirmed_date', 'person_pass_probation_date', 'person_retire_date', 'person_official_age', 'person_decommission_date', 'person_account_hold', 'person_current_work_place', 'person_person_type', 'person_position_type', 'person_administer_position', 'person_salary_position', 'person_pension', 'person_pension_withdraw', 'person_talent', 'person_current_address', 'person_mobile', 'person_email', 'person_home_address', 'lecturer', 'person_fax', 'person_type', 'academic_positions_id', 'department_id', 'faculty_id', 'person_marital_status', 'person_group_blood', 'person_underlying_disease', 'person_website', 'person_line', 'person_facbook','major_name'], 'safe'],
            [['person_salary'], 'number'],
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
        $query = Person::find()->where(['person_type' => 1]);
        $query->joinWith(['major']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pageSize'=>10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'person_id' => $this->person_id,
            'major_id' => $this->major_id,
            'person_religion_id' => $this->person_religion_id,
            'person_nation_id' => $this->person_nation_id,
            'major.major_name' => $this->major_name,
        ]);

        $query->andFilterWhere(['like', 'person_card_id', $this->person_card_id])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'person_name_eng', $this->person_name_eng])
            ->andFilterWhere(['like', 'person_surname', $this->person_surname])
            ->andFilterWhere(['like', 'person_surname_eng', $this->person_surname_eng])
            ->andFilterWhere(['like', 'major.major_name', $this->major_name]);


        return $dataProvider;
    }
}

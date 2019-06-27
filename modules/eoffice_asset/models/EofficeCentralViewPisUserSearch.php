<?php

namespace app\modules\eoffice_asset\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\eoffice_asset\models\EofficeCentralViewPisUser;

/**
 * EofficeCentralViewPisUserSearch represents the model behind the search form of `app\modules\eoffice_asset\models\EofficeCentralViewPisUser`.
 */
class EofficeCentralViewPisUserSearch extends EofficeCentralViewPisUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'major_id', 'person_id', 'branch_id'], 'integer'],
            [['username', 'email', 'user_type_id', 'student_fname_th', 'student_lname_th', 'student_fname_en', 'student_lname_en', 'person_fname_en', 'person_lname_th', 'person_lname_en', 'prefix_en', 'user_id', 'academic_positions_id', 'academic_positions_abb_thai', 'academic_positions_eng', 'academic_positions', 'academic_positions_abb', 'PREFIXNAME', 'major_name', 'major_name_eng', 'major_code', 'person_fname_th', 'person_mobile', 'person_current_address', 'AMPHUR_NAME', 'PROVINCE_NAME', 'ZIPCODE', 'DISTRICT_NAME', 'password_hash', 'STUDENTMOBILE', 'student_img', 'person_img', 'STUDENTEMAIL', 'person_email'], 'safe'],
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
        $query = EofficeCentralViewPisUser::find();

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
            'id' => $this->id,
            'department_id' => $this->department_id,
            'major_id' => $this->major_id,
            'person_id' => $this->person_id,
            'branch_id' => $this->branch_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'user_type_id', $this->user_type_id])
            ->andFilterWhere(['like', 'student_fname_th', $this->student_fname_th])
            ->andFilterWhere(['like', 'student_lname_th', $this->student_lname_th])
            ->andFilterWhere(['like', 'student_fname_en', $this->student_fname_en])
            ->andFilterWhere(['like', 'student_lname_en', $this->student_lname_en])
            ->andFilterWhere(['like', 'person_fname_en', $this->person_fname_en])
            ->andFilterWhere(['like', 'person_lname_th', $this->person_lname_th])
            ->andFilterWhere(['like', 'person_lname_en', $this->person_lname_en])
            ->andFilterWhere(['like', 'prefix_en', $this->prefix_en])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'academic_positions_id', $this->academic_positions_id])
            ->andFilterWhere(['like', 'academic_positions_abb_thai', $this->academic_positions_abb_thai])
            ->andFilterWhere(['like', 'academic_positions_eng', $this->academic_positions_eng])
            ->andFilterWhere(['like', 'academic_positions', $this->academic_positions])
            ->andFilterWhere(['like', 'academic_positions_abb', $this->academic_positions_abb])
            ->andFilterWhere(['like', 'PREFIXNAME', $this->PREFIXNAME])
            ->andFilterWhere(['like', 'major_name', $this->major_name])
            ->andFilterWhere(['like', 'major_name_eng', $this->major_name_eng])
            ->andFilterWhere(['like', 'major_code', $this->major_code])
            ->andFilterWhere(['like', 'person_fname_th', $this->person_fname_th])
            ->andFilterWhere(['like', 'person_mobile', $this->person_mobile])
            ->andFilterWhere(['like', 'person_current_address', $this->person_current_address])
            ->andFilterWhere(['like', 'AMPHUR_NAME', $this->AMPHUR_NAME])
            ->andFilterWhere(['like', 'PROVINCE_NAME', $this->PROVINCE_NAME])
            ->andFilterWhere(['like', 'ZIPCODE', $this->ZIPCODE])
            ->andFilterWhere(['like', 'DISTRICT_NAME', $this->DISTRICT_NAME])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'STUDENTMOBILE', $this->STUDENTMOBILE])
            ->andFilterWhere(['like', 'student_img', $this->student_img])
            ->andFilterWhere(['like', 'person_img', $this->person_img])
            ->andFilterWhere(['like', 'STUDENTEMAIL', $this->STUDENTEMAIL])
            ->andFilterWhere(['like', 'person_email', $this->person_email]);

        return $dataProvider;
    }
}

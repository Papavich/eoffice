<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;
/**
 * This is the model class for table "scb_select_branch".
 *
 * @property string $candidate_id_card
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property int $scb_branch_id
 * @property int $branch_seq
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbBranch $scbBranch
 * @property ScbEnrollScholarship $candidateIdCard
 */
class ScbSelectBranch extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_select_branch';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['candidate_id_card', 'scholarship_id', 'scholarship_year', 'scb_branch_id'], 'required'],
            [['scholarship_year', 'scb_branch_id', 'branch_seq', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['candidate_id_card'], 'string', 'max' => 13],
            [['scholarship_id'], 'string', 'max' => 5],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year', 'scb_branch_id'], 'unique', 'targetAttribute' => ['candidate_id_card', 'scholarship_id', 'scholarship_year', 'scb_branch_id']],
            [['scb_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbBranch::className(), 'targetAttribute' => ['scb_branch_id' => 'branch_id']],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbEnrollScholarship::className(), 'targetAttribute' => ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'candidate_id_card' => 'Candidate Id Card',
            'scholarship_id' => 'Scholarship ID',
            'scholarship_year' => 'Scholarship Year',
            'scb_branch_id' => 'Scb Branch ID',
            'branch_seq' => 'Branch Seq',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbBranch()
    {
        return $this->hasOne(ScbBranch::className(), ['branch_id' => 'scb_branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCard()
    {
        return $this->hasOne(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }
}

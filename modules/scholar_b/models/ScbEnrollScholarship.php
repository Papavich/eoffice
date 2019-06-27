<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;


/**
 * This is the model class for table "scb_enroll_scholarship".
 *
 * @property string $candidate_id_card
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property string $gpax_4to5
 * @property string $gpa_math4
 * @property string $gpa_math4to5
 * @property string $gpa_chem4
 * @property string $gpa_chem5
 * @property string $gpa_math5
 * @property string $gpa_physic4
 * @property string $gpa_physic5
 * @property string $gpa_sum_chem_physic_math_4to5
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbCandPortfolio[] $scbCandPortfolios
 * @property ScbCandidate $candidateIdCard
 * @property ScbScholarshipTypeHasYear $scholarship
 * @property ScbEvidenceFile[] $scbEvidenceFiles
 * @property ScbEvidenceType[] $evidenceTypes
 * @property ScbScore[] $scbScores
 * @property ScbSubject[] $scbSubjectSubjects
 * @property ScbSelectBranch[] $scbSelectBranches
 * @property ScbBranch[] $scbBranches
 */
class ScbEnrollScholarship extends \yii\db\ActiveRecord
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
        return 'scb_enroll_scholarship';
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
            [['candidate_id_card', 'scholarship_id', 'scholarship_year'], 'required'],
            [['scholarship_year', 'crby', 'udby'], 'integer'],
            [['gpax_4to5', 'gpa_math4', 'gpa_math4to5', 'gpa_chem4', 'gpa_chem5', 'gpa_math5', 'gpa_physic4', 'gpa_physic5', 'gpa_sum_chem_physic_math_4to5'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['candidate_id_card'], 'string', 'max' => 17],
            [['scholarship_id'], 'string', 'max' => 5],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year'], 'unique', 'targetAttribute' => ['candidate_id_card', 'scholarship_id', 'scholarship_year']],
            [['candidate_id_card'], 'exist', 'skipOnError' => true, 'targetClass' => ScbCandidate::className(), 'targetAttribute' => ['candidate_id_card' => 'id_card']],
            [['scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbScholarshipTypeHasYear::className(), 'targetAttribute' => ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
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
            'gpax_4to5' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5 รวมทุกวิชาเท่ากับ',
            'gpa_math4' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4 วิชาคณิตศาสตร์เท่ากับ',
            'gpa_math4to5' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5 วิชาคณิตศาสตร์เท่ากับ',
            'gpa_chem4' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4 วิชาเคมีเท่ากับ',
            'gpa_chem5' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 5 วิชาเคมีเท่ากับ',
            'gpa_math5' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 5 วิชาคณิตศาสตร์เท่ากับ',
            'gpa_physic4' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4 วิชาฟิสิกส์เท่ากับ',
            'gpa_physic5' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 5 วิชาฟิสิกส์เท่ากับ',
            'gpa_sum_chem_physic_math_4to5' => 'คะแนนรวมเฉลี่ยชั้นมัธยมศึกษาปีที่ 4-5 เฉพาะวิชาคณิตศาสตร์ ฟิสิกส์ เคมี เท่ากับ',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCandPortfolios()
    {
        return $this->hasMany(ScbCandPortfolio::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCard()
    {
        return $this->hasOne(ScbCandidate::className(), ['id_card' => 'candidate_id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarship()
    {
        return $this->hasOne(ScbScholarshipTypeHasYear::className(), ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbEvidenceFiles()
    {
        return $this->hasMany(ScbEvidenceFile::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidenceTypes()
    {
        return $this->hasMany(ScbEvidenceType::className(), ['evidence_type_id' => 'evidence_type_id'])->viaTable('scb_evidence_file', ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbScores()
    {
        return $this->hasMany(ScbScore::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbSubjectSubjects()
    {
        return $this->hasMany(ScbSubject::className(), ['subject_id' => 'scb_subject_subject_id'])->viaTable('scb_score', ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbSelectBranches()
    {
        return $this->hasMany(ScbSelectBranch::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbBranches()
    {
        return $this->hasMany(ScbBranch::className(), ['branch_id' => 'scb_branch_id'])->viaTable('scb_select_branch', ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

}

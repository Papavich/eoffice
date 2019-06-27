<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_evidence_file".
 *
 * @property string $candidate_id_card
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property int $evidence_type_id
 * @property string $file_name
 * @property int $file_status
 * @property string $file_comment
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbEnrollScholarship $candidateIdCard
 * @property ScbEvidenceType $evidenceType
 */
class ScbEvidenceFile extends \yii\db\ActiveRecord
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
        return 'scb_evidence_file';
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
            [['candidate_id_card', 'scholarship_id', 'scholarship_year', 'evidence_type_id'], 'required'],
            [['scholarship_year', 'evidence_type_id', 'file_status', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['candidate_id_card'], 'string', 'max' => 13],
            [['scholarship_id'], 'string', 'max' => 5],
            [['file_name'], 'string', 'max' => 45],
            [['file_comment'], 'string', 'max' => 50],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year', 'evidence_type_id'], 'unique', 'targetAttribute' => ['candidate_id_card', 'scholarship_id', 'scholarship_year', 'evidence_type_id']],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbEnrollScholarship::className(), 'targetAttribute' => ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
            [['evidence_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbEvidenceType::className(), 'targetAttribute' => ['evidence_type_id' => 'evidence_type_id']],
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
            'evidence_type_id' => 'Evidence Type ID',
            'file_name' => 'File Name',
            'file_status' => 'File Status',
            'file_comment' => 'File Comment',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCard()
    {
        return $this->hasOne(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidenceType()
    {
        return $this->hasOne(ScbEvidenceType::className(), ['evidence_type_id' => 'evidence_type_id']);
    }
}

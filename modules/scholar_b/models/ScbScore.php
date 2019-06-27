<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;
/**
 * This is the model class for table "scb_score".
 *
 * @property int $scb_subject_subject_id
 * @property string $candidate_id_card
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property double $score
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbSubject $scbSubjectSubject
 * @property ScbEnrollScholarship $candidateIdCard
 */
class ScbScore extends \yii\db\ActiveRecord
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
        return 'scb_score';
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
            [['scb_subject_subject_id', 'candidate_id_card', 'scholarship_id', 'scholarship_year'], 'required'],
            [['scb_subject_subject_id', 'scholarship_year', 'crby', 'udby'], 'integer'],
            [['score'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['candidate_id_card'], 'string', 'max' => 17],
            [['scholarship_id'], 'string', 'max' => 5],
            [['scb_subject_subject_id', 'candidate_id_card', 'scholarship_id', 'scholarship_year'], 'unique', 'targetAttribute' => ['scb_subject_subject_id', 'candidate_id_card', 'scholarship_id', 'scholarship_year']],
            [['scb_subject_subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbSubject::className(), 'targetAttribute' => ['scb_subject_subject_id' => 'subject_id']],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbEnrollScholarship::className(), 'targetAttribute' => ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scb_subject_subject_id' => 'Scb Subject Subject ID',
            'candidate_id_card' => 'Candidate Id Card',
            'scholarship_id' => 'Scholarship ID',
            'scholarship_year' => 'Scholarship Year',
            'score' => '',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbSubjectSubject()
    {
        return $this->hasOne(ScbSubject::className(), ['subject_id' => 'scb_subject_subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCard()
    {
        return $this->hasOne(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }
}

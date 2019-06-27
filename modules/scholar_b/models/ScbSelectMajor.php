<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_select_major".
 *
 * @property int $major_seq
 * @property string $major_code
 * @property string $candidate_id_card
 * @property string $scholarship_id
 * @property int $scholarship_year
 *
 * @property ScbEnrollScholarship $candidateIdCard
 */
class ScbSelectMajor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_select_major';
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
            [['major_seq', 'scholarship_year'], 'integer'],
            [['major_code', 'candidate_id_card', 'scholarship_id', 'scholarship_year'], 'required'],
            [['major_code'], 'string', 'max' => 6],
            [['candidate_id_card'], 'string', 'max' => 17],
            [['scholarship_id'], 'string', 'max' => 5],
            [['major_code', 'candidate_id_card', 'scholarship_id', 'scholarship_year'], 'unique', 'targetAttribute' => ['major_code', 'candidate_id_card', 'scholarship_id', 'scholarship_year']],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbEnrollScholarship::className(), 'targetAttribute' => ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'major_seq' => 'Major Seq',
            'major_code' => 'Major Code',
            'candidate_id_card' => 'Candidate Id Card',
            'scholarship_id' => 'Scholarship ID',
            'scholarship_year' => 'Scholarship Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCard()
    {
        return $this->hasOne(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    public function getMajorName()
    {
        return $this->hasOne(\app\modules\scholar_b\models\model_main\EofficeCentralViewPisMajor::className(), ['code' => 'major_code']);
    }
}

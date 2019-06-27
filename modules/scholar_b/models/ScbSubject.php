<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_subject".
 *
 * @property int $subject_id
 * @property string $subject_name
 *
 * @property ScbScore[] $scbScores
 * @property ScbEnrollScholarship[] $candidateIdCards
 */
class ScbSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_subject';
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
            [['subject_id'], 'required'],
            [['subject_id'], 'integer'],
            [['subject_name'], 'string', 'max' => 45],
            [['subject_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_name' => 'Subject Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbScores()
    {
        return $this->hasMany(ScbScore::className(), ['scb_subject_subject_id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCards()
    {
        return $this->hasMany(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year'])->viaTable('scb_score', ['scb_subject_subject_id' => 'subject_id']);
    }
}

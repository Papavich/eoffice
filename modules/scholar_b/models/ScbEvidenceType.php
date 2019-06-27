<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_evidence_type".
 *
 * @property integer $evidence_type_id
 * @property string $file_type_name
 *
 * @property ScbEvidenceFile[] $scbEvidenceFiles
 * @property ScbEnrollScholarship[] $candidateIdCards
 */
class ScbEvidenceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_evidence_type';
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
            [['evidence_type_id'], 'required'],
            [['evidence_type_id'], 'integer'],
            [['file_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'evidence_type_id' => 'Evidence Type ID',
            'file_type_name' => 'File Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbEvidenceFiles()
    {
        return $this->hasMany(ScbEvidenceFile::className(), ['evidence_type_id' => 'evidence_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCards()
    {
        return $this->hasMany(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_type_id' => 'scholarship_type_id', 'scholarship_year' => 'scholarship_year'])->viaTable('scb_evidence_file', ['evidence_type_id' => 'evidence_type_id']);
    }
}

<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_topic_assessment".
 *
 * @property int $topic_ass_id
 * @property string $topic_ass_name
 * @property string $assessment_id
 * @property string $past
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaAssessDetail[] $taAssessDetails
 * @property TaAssess[] $assessPeople
 * @property TaAssessment $assessment
 */
class TaTopicAssessment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_topic_assessment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['topic_ass_name'], 'string', 'max' => 400],
            [['assessment_id', 'past'], 'string', 'max' => 30],
            [['assessment_id', 'past'], 'exist', 'skipOnError' => true, 'targetClass' => TaAssessment::className(), 'targetAttribute' => ['assessment_id' => 'ta_assessment_id', 'past' => 'past']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic_ass_id' => 'Topic Ass ID',
            'topic_ass_name' => 'Topic Ass Name',
            'assessment_id' => 'Assessment ID',
            'past' => 'Past',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssessDetails()
    {
        return $this->hasMany(TaAssessDetail::className(), ['topic_ass_id' => 'topic_ass_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessPeople()
    {
        return $this->hasMany(TaAssess::className(), ['assess_person' => 'assess_person', 'ta_assessment_id' => 'ta_assessment_id', 'ta_id' => 'ta_id', 'subject_id' => 'subject_id', 'section' => 'section', 'term' => 'term', 'year' => 'year', 'past' => 'past', 'subject_version' => 'subject_version'])->viaTable('ta_assess_detail', ['topic_ass_id' => 'topic_ass_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessment()
    {
        return $this->hasOne(TaAssessment::className(), ['ta_assessment_id' => 'assessment_id', 'past' => 'past']);
    }
}

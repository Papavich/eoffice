<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_assessment".
 *
 * @property string $ta_assessment_id
 * @property string $past
 * @property string $ta_assessment_name
 * @property string $ta_assessment_detail
 * @property string $type_user
 * @property string $ta_assessment_note
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaAssess[] $taAssesses
 * @property TaAssessmentOpen $taAssessmentOpen
 * @property TaTopicAssessment[] $taTopicAssessments
 */
class TaAssessment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_assessment';
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
            [['ta_assessment_id', 'past'], 'required'],
            [['type_user'], 'string'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_assessment_id', 'past'], 'string', 'max' => 30],
            [['ta_assessment_name'], 'string', 'max' => 400],
            [['ta_assessment_detail'], 'string', 'max' => 500],
            [['ta_assessment_note'], 'string', 'max' => 200],
            [['ta_assessment_id', 'past'], 'unique', 'targetAttribute' => ['ta_assessment_id', 'past']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_assessment_id' => 'Ta Assessment ID',
            'past' => 'Past',
            'ta_assessment_name' => 'Ta Assessment Name',
            'ta_assessment_detail' => 'Ta Assessment Detail',
            'type_user' => 'Type User',
            'ta_assessment_note' => 'Ta Assessment Note',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssesses()
    {
        return $this->hasMany(TaAssess::className(), ['ta_assessment_id' => 'ta_assessment_id', 'past' => 'past']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssessmentOpen()
    {
        return $this->hasOne(TaAssessmentOpen::className(), ['ta_assessment_id' => 'ta_assessment_id', 'past' => 'past']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTopicAssessments()
    {
        return $this->hasMany(TaTopicAssessment::className(), ['assessment_id' => 'ta_assessment_id', 'past' => 'past']);
    }
}

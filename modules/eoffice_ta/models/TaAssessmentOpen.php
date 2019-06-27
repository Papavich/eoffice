<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_assessment_open".
 *
 * @property string $ta_assessment_id
 * @property string $past
 * @property string $term
 * @property string $year
 * @property string $active
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaAssessment $taAssessment
 * @property Term $term0
 */
class TaAssessmentOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_assessment_open';
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
            [['ta_assessment_id', 'past', 'term', 'year'], 'required'],
            [['active'], 'string'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_assessment_id', 'past'], 'string', 'max' => 30],
            [['term', 'year'], 'string', 'max' => 10],
            [['ta_assessment_id', 'past'], 'unique', 'targetAttribute' => ['ta_assessment_id', 'past']],
            [['ta_assessment_id', 'past'], 'exist', 'skipOnError' => true, 'targetClass' => TaAssessment::className(), 'targetAttribute' => ['ta_assessment_id' => 'ta_assessment_id', 'past' => 'past']],
            [['term', 'year'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['term' => 'term_id', 'year' => 'year']],
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
            'term' => 'Term',
            'year' => 'Year',
            'active' => 'Active',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssessment()
    {
        return $this->hasOne(TaAssessment::className(), ['ta_assessment_id' => 'ta_assessment_id', 'past' => 'past']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerm0()
    {
        return $this->hasOne(Term::className(), ['term_id' => 'term', 'year' => 'year']);
    }
}

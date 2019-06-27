<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;
/**
 * This is the model class for table "scb_timeline".
 *
 * @property integer $scholarship_type_id
 * @property integer $scholarship_year
 * @property integer $timeline_id
 * @property string $timeline_topic
 * @property string $timeline_detail
 * @property string $timeline_date
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property ScbScholarshipTypeHasYear $scholarshipType
 */
class ScbTimeline extends \yii\db\ActiveRecord
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
        return 'scb_timeline';
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
            [['scholarship_type_id', 'scholarship_year', 'timeline_id'], 'required'],
            [['scholarship_type_id', 'scholarship_year', 'timeline_id', 'crby', 'udby'], 'integer'],
            [['timeline_date', 'crtime', 'udtime'], 'safe'],
            [['timeline_topic'], 'string', 'max' => 45],
            [['timeline_detail'], 'string', 'max' => 100],
            [['scholarship_type_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbScholarshipTypeHasYear::className(), 'targetAttribute' => ['scholarship_type_id' => 'scholarship_type_id', 'scholarship_year' => 'scholarship_year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scholarship_type_id' => 'Scholarship Type ID',
            'scholarship_year' => 'Scholarship Year',
            'timeline_id' => 'Timeline ID',
            'timeline_topic' => 'Timeline Topic',
            'timeline_detail' => 'Timeline Detail',
            'timeline_date' => 'Timeline Date',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarshipType()
    {
        return $this->hasOne(ScbScholarshipTypeHasYear::className(), ['scholarship_type_id' => 'scholarship_type_id', 'scholarship_year' => 'scholarship_year']);
    }
}

<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_comment".
 *
 * @property int $ta_comment_id
 * @property string $subject_id
 * @property string $section
 * @property string $ta_type_work_id
 * @property string $ta_id
 * @property string $term
 * @property string $year
 * @property string $ta_comment_text
 * @property string $ta_comment_feeling
 * @property string $ta_status_id
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaStatus $taStatus
 */
class TaComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_comment';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'section', 'ta_id', 'term', 'year'], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['subject_id', 'section', 'ta_type_work_id', 'term', 'year'], 'string', 'max' => 10],
            [['ta_id', 'ta_status_id'], 'string', 'max' => 15],
            [['ta_comment_text'], 'string', 'max' => 1000],
            [['ta_comment_feeling'], 'string', 'max' => 200],
            [['ta_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status_id' => 'ta_status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ta_comment_id' => 'Ta Comment ID',
            'subject_id' => 'Subject ID',
            'section' => 'Section',
            'ta_type_work_id' => 'Ta Type Work ID',
            'ta_id' => 'Ta ID',
            'term' => 'Term',
            'year' => 'Year',
            'ta_comment_text' => 'Ta Comment Text',
            'ta_comment_feeling' => 'Ta Comment Feeling',
            'ta_status_id' => 'Ta Status ID',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaStatus()
    {
        return $this->hasOne(TaStatus::className(), ['ta_status_id' => 'ta_status_id']);
    }
}

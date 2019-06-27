<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_payment".
 *
 * @property string $subject_id
 * @property int $subject_version
 * @property string $program_id
 * @property string $term
 * @property string $year
 * @property string $workload_value
 * @property string $ta_payment
 * @property string $ta_payment_max
 * @property string $ta_status_id
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaRequest $subject
 * @property TaStatus $taStatus
 */
class TaPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_payment';
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
            [['subject_id', 'subject_version', 'term', 'year'], 'required'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['workload_value', 'ta_payment', 'ta_payment_max'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['subject_id', 'program_id', 'term', 'year'], 'string', 'max' => 10],
            [['ta_status_id'], 'string', 'max' => 15],
            [['subject_id', 'subject_version', 'term', 'year'], 'unique', 'targetAttribute' => ['subject_id', 'subject_version', 'term', 'year']],
            [['subject_id', 'term', 'year', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => TaRequest::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'term' => 'term_id', 'year' => 'year', 'subject_version' => 'subject_version']],
            [['ta_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status_id' => 'ta_status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'program_id' => 'Program ID',
            'term' => 'Term',
            'year' => 'Year',
            'workload_value' => 'Workload Value',
            'ta_payment' => 'Ta Payment',
            'ta_payment_max' => 'Ta Payment Max',
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
    public function getSubject()
    {
        return $this->hasOne(TaRequest::className(), ['subject_id' => 'subject_id', 'term_id' => 'term', 'year' => 'year', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaStatus()
    {
        return $this->hasOne(TaStatus::className(), ['ta_status_id' => 'ta_status_id']);
    }
}

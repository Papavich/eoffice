<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_schedule".
 *
 * @property int $ta_schedule_id
 * @property string $ta_schedule_url
 * @property string $ta_schedule_title
 * @property string $time_start
 * @property string $time_end
 * @property string $ta_schedule_detail
 * @property string $ta_schedule_type
 * @property string $term
 * @property string $year
 * @property string $active_status
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property Term $term0
 * @property Term $year0
 */
class TaSchedule extends \yii\db\ActiveRecord
{
    const NON_ACTIVE = '0';
    const ACTIVE_ONE = '1';
    const ACTIVE_TWO = '2';

    const TYPE_REQ = 'REQ';
    const TYPE_REGIS = 'REGIS';
    const TYPE_CHO_TA = 'CHO-TA';
    const TYPE_CONFIRM_REQ = 'CONFIRM-REQ';
    const TYPE_CONFIRM_TA = 'CONFIRM-TA';
    const TYPE_WLOAD_TA = 'WLOAD-TA';
    const TYPE_WORKING_TA = 'WORKING-TA';
    const TYPE_CHECK_HR = 'CHECK-HR';
    const TYPE_ASSESS_TA = 'ASSESS-TA';
    const TYPE_PAYMENT_TA = 'PAYMENT-TA';
    const TYPE_OTHER= 'OTHER';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_schedule';
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
            [['time_start', 'time_end', 'crtime', 'udtime'], 'safe'],
            [['ta_schedule_type', 'ta_schedule_url','term','year'], 'required'],
            [['ta_schedule_type', 'active_status'], 'string'],
            [['crby', 'udby'], 'integer'],
            [['ta_schedule_url'], 'string', 'max' => 200],
            [['ta_schedule_title', 'ta_schedule_detail'], 'string', 'max' => 500],
            [['term', 'year'], 'string', 'max' => 10],
            [['term'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['term' => 'term_id']],
            [['year'], 'exist', 'skipOnError' => true, 'targetClass' => Term::className(), 'targetAttribute' => ['year' => 'year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_schedule_id' => controllers::t('label','ID'),
            'ta_schedule_url' => controllers::t('label','Url'),
            'ta_schedule_title' => controllers::t('label','Schedule Title'),
            'time_start' => controllers::t('label','Day Start'),
            'time_end' => controllers::t('label','Day End'),
            'ta_schedule_detail' => controllers::t('label','Detail'),
            'ta_schedule_type' => controllers::t('label','Schedule Type'),
            'term' => controllers::t('label','Term'),
            'year' => controllers::t('label','Year'),
            'active_status' => controllers::t('label','Status'),
            'crby' => controllers::t('label','Create By'),
            'crtime' => controllers::t('label','Create Time'),
            'udby' => controllers::t('label','Update By'),
            'udtime' => controllers::t('label','Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerm0()
    {
        return $this->hasOne(Term::className(), ['term_id' => 'term']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(Term::className(), ['year' => 'year']);
    }
}

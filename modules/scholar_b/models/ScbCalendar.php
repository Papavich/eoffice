<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;
/**
 * This is the model class for table "scb_calendar".
 *
 * @property int $calendar_id
 * @property string $staff_id_card
 * @property string $calendar_topic
 * @property string $calendar_detail
 * @property string $calendar_date_start
 * @property string $calendar_date_end
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbStaff $staffIdCard
 */
class ScbCalendar extends \yii\db\ActiveRecord
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
        return 'scb_calendar';
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
            [['staff_id_card','calendar_topic'], 'required'],
            [['calendar_date_start', 'calendar_date_end', 'crtime', 'udtime'], 'safe'],
            [['crby', 'udby'], 'integer'],
            [['staff_id_card'], 'string', 'max' => 13],
            [['calendar_topic'], 'string', 'max' => 45],
            [['calendar_detail'], 'string', 'max' => 100],
            [['staff_id_card'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStaff::className(), 'targetAttribute' => ['staff_id_card' => 'staff_id_card']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'calendar_id' => 'Calendar ID',
            'staff_id_card' => 'Staff Id Card',
            'calendar_topic' => '',
            'calendar_detail' => '',
            'calendar_date_start' => '',
            'calendar_date_end' => '',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffIdCard()
    {
        return $this->hasOne(ScbStaff::className(), ['staff_id_card' => 'staff_id_card']);
    }
}

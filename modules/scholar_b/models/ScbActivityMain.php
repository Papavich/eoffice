<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_activity_main".
 *
 * @property int $act_main_id
 * @property int $year
 * @property int $act_type_id
 * @property string $act_main_name
 * @property string $act_main_location
 * @property string $act_main_date_start
 * @property string $act_main_date_end
 * @property string $act_main_detail
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbActivityType $actType
 * @property ScbYear $year0
 * @property ScbStudentHasActivityMain[] $scbStudentHasActivityMains
 * @property ScbStudent[] $students
 */
class ScbActivityMain extends \yii\db\ActiveRecord
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
        return 'scb_activity_main';
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
            [['act_main_id', 'year', 'act_type_id'], 'required'],
            [['act_main_id', 'year', 'act_type_id', 'crby', 'udby'], 'integer'],
            [['act_main_date_start', 'act_main_date_end', 'crtime', 'udtime'], 'safe'],
            [['act_main_detail'], 'string'],
            [['act_main_name', 'act_main_location'], 'string', 'max' => 45],
            [['act_main_id', 'year'], 'unique', 'targetAttribute' => ['act_main_id', 'year']],
            [['act_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbActivityType::className(), 'targetAttribute' => ['act_type_id' => 'act_type_id']],
            [['year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYear::className(), 'targetAttribute' => ['year' => 'year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'act_main_id' => 'รหัสกิจกรรม',
            'year' => 'ปีการศึกษา',
            'act_type_id' => 'ประเภทกิจกรรม',
            'act_main_name' => 'ชื่อกิจกรรม',
            'act_main_location' => 'สถานที่',
            'act_main_date_start' => 'วันที่เริ่มกิจกรรม',
            'act_main_date_end' => 'วันที่จบกิจกรรม',
            'act_main_detail' => 'รายละเอียดกิจกรรม',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActType()
    {
        return $this->hasOne(ScbActivityType::className(), ['act_type_id' => 'act_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYear::className(), ['year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbStudentHasActivityMains()
    {
        return $this->hasMany(ScbStudentHasActivityMain::className(), ['activity_main_id' => 'act_main_id', 'year' => 'year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(ScbStudent::className(), ['student_id' => 'student_id'])->viaTable('scb_student_has_activity_main', ['activity_main_id' => 'act_main_id', 'year' => 'year']);
    }


}

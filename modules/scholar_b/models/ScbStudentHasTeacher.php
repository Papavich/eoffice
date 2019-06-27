<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\models\model_main\EofficeCentralViewStudentFull;
use app\modules\scholar_b\models\model_main\RegSysbytedes;
use Yii;

/**
 * This is the model class for table "scb_student_has_teacher".
 *
 * @property string $student_id
 * @property string $teacher_id_card
 * @property int $teacher_type_id
 *
 * @property ScbStudent $student
 * @property ScbTeacherHasType $teacherIdCard
 */
class ScbStudentHasTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_student_has_teacher';
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
            [['student_id', 'teacher_id_card', 'teacher_type_id'], 'required'],
            [['teacher_type_id'], 'integer'],
            [['student_id'], 'string', 'max' => 11],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['student_id', 'teacher_id_card', 'teacher_type_id'], 'unique', 'targetAttribute' => ['student_id', 'teacher_id_card', 'teacher_type_id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
            [['teacher_id_card', 'teacher_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbTeacherHasType::className(), 'targetAttribute' => ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'รายชื่อนักศึกษาที่ยังไม่มีที่ปรึกษา',
            'teacher_id_card' => 'รายชื่ออาจารย์',
            'teacher_type_id' => 'ประเภท',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCard()
    {
        return $this->hasOne(ScbTeacherHasType::className(), ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id']);
    }

    public function getViewStudent()
    {
        return $this->hasOne(EofficeCentralViewStudentFull::className(), ['STUDENTCODE' => 'student_id']);
    }

    public  function getScholarshipname(){
        return @$this->hasOne(ScbScholarshipType::className(), ['scholarship_id' => 'scholarship_id']);
    }



}

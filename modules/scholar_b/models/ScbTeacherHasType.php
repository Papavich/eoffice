<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_teacher_has_type".
 *
 * @property string $teacher_id_card
 * @property int $teacher_type_id
 * @property int $year
 * @property int $project_code
 *
 * @property ScbStudentHasTeacher[] $scbStudentHasTeachers
 * @property ScbStudent[] $students
 * @property ScbProject $projectCode
 * @property ScbTeacher $teacherIdCard
 * @property ScbTeacherType $teacherType
 * @property ScbYear $year0
 */
class ScbTeacherHasType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_teacher_has_type';
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
            [['teacher_id_card', 'teacher_type_id', 'year', 'project_code'], 'required'],
            [['teacher_type_id', 'year', 'project_code'], 'integer'],
            [['teacher_id_card'], 'string', 'max' => 13],
            [['teacher_id_card', 'teacher_type_id', 'project_code'], 'unique', 'targetAttribute' => ['teacher_id_card', 'teacher_type_id', 'project_code']],
            [['project_code'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProject::className(), 'targetAttribute' => ['project_code' => 'project_code']],
            [['teacher_id_card'], 'exist', 'skipOnError' => true, 'targetClass' => ScbTeacher::className(), 'targetAttribute' => ['teacher_id_card' => 'id_card']],
            [['teacher_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbTeacherType::className(), 'targetAttribute' => ['teacher_type_id' => 'type_id']],
            [['year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYear::className(), 'targetAttribute' => ['year' => 'year']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_id_card' => 'รายชื่ออาจารย์',
            'teacher_type_id' => 'ประเภท',
            'year' => 'ปีการศึกษา',
            'project_code' => 'Project Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbStudentHasTeachers()
    {
        return $this->hasMany(ScbStudentHasTeacher::className(), ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(ScbStudent::className(), ['student_id' => 'student_id'])->viaTable('scb_student_has_teacher', ['teacher_id_card' => 'teacher_id_card', 'teacher_type_id' => 'teacher_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectCode()
    {
        return $this->hasOne(ScbProject::className(), ['project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCard()
    {
        return $this->hasOne(ScbTeacher::className(), ['id_card' => 'teacher_id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherType()
    {
        return $this->hasOne(ScbTeacherType::className(), ['type_id' => 'teacher_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYear::className(), ['year' => 'year']);
    }
}

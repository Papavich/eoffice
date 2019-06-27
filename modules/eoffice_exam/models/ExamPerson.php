<?php

namespace app\modules\eoffice_exam\models;

use Yii;

/**
 * This is the model class for table "exam_person".
 *
 * @property int $person_id
 * @property int $teacher_id
 * @property string $type_id
 * @property string $prefix_id
 * @property string $person_name
 * @property string $person_surname
 * @property string $person_mail_register
 * @property string $person_mail
 * @property string $line_id
 * @property string $academic_positions_id
 * @property string $staff_position
 * @property string $department_id
 */
class ExamPerson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_person';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_exam');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'teacher_id', 'type_id', 'prefix_id', 'person_surname', 'person_mail_register', 'person_mail', 'line_id', 'academic_positions_id', 'staff_position', 'department_id'], 'required'],
            [['person_id', 'teacher_id'], 'integer'],
            [['type_id', 'prefix_id', 'person_name', 'person_surname', 'person_mail_register', 'person_mail', 'line_id', 'academic_positions_id', 'staff_position'], 'string', 'max' => 50],
            [['department_id'], 'string', 'max' => 80],
            [['person_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'teacher_id' => 'Teacher ID',
            'type_id' => 'Type ID',
            'prefix_id' => 'Prefix ID',
            'person_name' => 'Person Name',
            'person_surname' => 'Person Surname',
            'person_mail_register' => 'Person Mail Register',
            'person_mail' => 'Person Mail',
            'line_id' => 'Line ID',
            'academic_positions_id' => 'Academic Positions ID',
            'staff_position' => 'Staff Position',
            'department_id' => 'Department ID',
        ];
    }
}

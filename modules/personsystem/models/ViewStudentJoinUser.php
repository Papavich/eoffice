<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "view_student_join_user".
 *
 * @property int $id
 * @property int $STUDENTID
 * @property string $ADMITSEMESTER
 * @property string $ADMITACADYEAR
 * @property int $major_id
 * @property string $major_name
 * @property string $major_code
 * @property string $STUDENTCODE
 * @property string $type
 * @property string $LEVELNAME
 * @property string $LEVELID
 * @property string $STUDENTNAME
 * @property string $STUDENTSURNAME
 */
class ViewStudentJoinUser extends \yii\db\ActiveRecord
{
    public static function primaryKey()
    {
        return ['id'];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_student_join_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'STUDENTID', 'major_id'], 'integer'],
            [['STUDENTID', 'LEVELID'], 'required'],
            [['ADMITSEMESTER', 'ADMITACADYEAR'], 'string', 'max' => 45],
            [['major_name'], 'string', 'max' => 200],
            [['major_code', 'STUDENTNAME', 'STUDENTSURNAME'], 'string', 'max' => 100],
            [['STUDENTCODE', 'type'], 'string', 'max' => 20],
            [['LEVELNAME', 'LEVELID'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'STUDENTID' => 'Studentid',
            'ADMITSEMESTER' => 'Admitsemester',
            'ADMITACADYEAR' => 'Admitacadyear',
            'major_id' => 'Major ID',
            'major_name' => 'Major Name',
            'major_code' => 'Major Code',
            'STUDENTCODE' => 'Studentcode',
            'type' => 'Type',
            'LEVELNAME' => 'Levelname',
            'LEVELID' => 'Levelid',
            'STUDENTNAME' => 'Studentname',
            'STUDENTSURNAME' => 'Studentsurname',
        ];
    }
}

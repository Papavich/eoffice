<?php

namespace app\modules\eoffice_materialsys\models;

use Yii;

/**
 * This is the model class for table "eoffice_main.view_pis_user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $user_type_id
 * @property int $user_id
 * @property string $department_id
 * @property string $major_id
 * @property string $student_fname_th
 * @property string $student_lname_th
 * @property string $student_fname_en
 * @property string $student_lname_en
 * @property string $person_fname_th
 * @property string $person_fname_eng
 * @property string $person_lname_th
 * @property string $person_lname_eng
 * @property string $prefix_th
 * @property string $prefix_en
 */
class User extends \yii\db\ActiveRecord
{
    const TYPE_ADMIN = 3;
    const TYPE_TEACHER = 1;
    const TYPE_STUDENT = 0;
    const TYPE_VISITOR = 2;

    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_user';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get( 'db' );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['username', 'email', 'user_type_id'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['user_type_id'], 'string', 'max' => 20],
            [['department_id', 'major_id', 'person_fname_th', 'person_fname_eng', 'person_lname_th', 'person_lname_eng', 'prefix_th', 'prefix_en'], 'string', 'max' => 50],
            [['student_fname_th', 'student_lname_th', 'student_fname_en', 'student_lname_en'], 'string', 'max' => 100],
             ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'user_type_id' => 'User Type Type',
            'user_id' => 'User ID',
            'department_id' => 'Department ID',
            'major_id' => 'Major ID',
            'student_fname_th' => 'Student Fname Th',
            'student_lname_th' => 'Student Lname Th',
            'student_fname_en' => 'Student Fname En',
            'student_lname_en' => 'Student Lname En',
            'person_fname_th' => 'Person Fname Th',
            'person_fname_eng' => 'Person Fname Eng',
            'person_lname_th' => 'Person Lname Th',
            'person_lname_eng' => 'Person Lname Eng',
            'prefix_th' => 'Prefix Th',
            'prefix_en' => 'Prefix En',
        ];
    }
    static public function getFullname($id){
        $user = User::find()
            ->where('id = :id',[':id'=>$id])
            ->one();
        return $user->PREFIXNAME." ".$user->person_fname_th." ".$user->person_lname_th;
    }
    static public function getFullnameobj($user){
        return $user->PREFIXNAME." ".$user->person_fname_th." ".$user->person_lname_th;
    }

}

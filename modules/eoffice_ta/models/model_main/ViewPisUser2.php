<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;

/**
 * This is the model class for table "view_pis_user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $user_type_id
 * @property string $department_id
 * @property string $student_fname_th
 * @property string $student_lname_th
 * @property string $student_fname_en
 * @property string $student_lname_en
 * @property string $person_fname_th
 * @property string $person_fname_en
 * @property string $person_lname_th
 * @property string $person_lname_en
 * @property string $prefix_th
 * @property string $prefix_en
 * @property int $major_id
 * @property string $user_id
 * @property string $branch_name
 * @property int $branch_id
 */
class ViewPisUser2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_pis_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'major_id', 'branch_id'], 'integer'],
            [['username', 'email', 'user_type_id'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['user_type_id', 'user_id'], 'string', 'max' => 20],
            [['department_id'], 'string', 'max' => 80],
            [['student_fname_th', 'student_lname_th', 'student_fname_en', 'student_lname_en'], 'string', 'max' => 100],
            [['person_fname_th', 'person_fname_en', 'person_lname_th', 'person_lname_en', 'prefix_th', 'prefix_en'], 'string', 'max' => 50],
            [['branch_name'], 'string', 'max' => 200],
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
            'user_type_id' => 'User Type ID',
            'department_id' => 'Department ID',
            'student_fname_th' => 'Student Fname Th',
            'student_lname_th' => 'Student Lname Th',
            'student_fname_en' => 'Student Fname En',
            'student_lname_en' => 'Student Lname En',
            'person_fname_th' => 'Person Fname Th',
            'person_fname_en' => 'Person Fname En',
            'person_lname_th' => 'Person Lname Th',
            'person_lname_en' => 'Person Lname En',
            'prefix_th' => 'Prefix Th',
            'prefix_en' => 'Prefix En',
            'major_id' => 'Major ID',
            'user_id' => 'User ID',
            'branch_name' => 'Branch Name',
            'branch_id' => 'Branch ID',
        ];
    }
}

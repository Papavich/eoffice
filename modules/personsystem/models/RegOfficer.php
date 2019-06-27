<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_officer".
 *
 * @property int $OFFICERID
 * @property string $OFFICERCODE
 * @property string $OFFICERPASSWORD
 * @property string $OFFICERTYPE
 * @property string $FACULTYID
 * @property string $DEPARTMENTID
 * @property string $PREFIXID
 * @property string $OFFICERNAME
 * @property string $OFFICERSURNAME
 * @property string $OFFICERNAMEENG
 * @property string $OFFICERSURNAMEENG
 * @property string $OFFICEREMAIL
 * @property string $REMARK
 * @property string $OFFICERLOGIN
 * @property string $LDAP
 * @property string $SKIPSYNC
 */
class RegOfficer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_officer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OFFICERID'], 'required'],
            [['OFFICERID'], 'integer'],
            [['OFFICERCODE', 'OFFICERPASSWORD', 'OFFICERTYPE', 'FACULTYID', 'DEPARTMENTID', 'PREFIXID', 'OFFICERNAME', 'OFFICERSURNAME', 'OFFICERNAMEENG', 'OFFICERSURNAMEENG', 'OFFICEREMAIL', 'REMARK', 'OFFICERLOGIN', 'LDAP', 'SKIPSYNC'], 'string', 'max' => 255],
            [['OFFICERID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OFFICERID' => 'Officerid',
            'OFFICERCODE' => 'Officercode',
            'OFFICERPASSWORD' => 'Officerpassword',
            'OFFICERTYPE' => 'Officertype',
            'FACULTYID' => 'Facultyid',
            'DEPARTMENTID' => 'Departmentid',
            'PREFIXID' => 'Prefixid',
            'OFFICERNAME' => 'Officername',
            'OFFICERSURNAME' => 'Officersurname',
            'OFFICERNAMEENG' => 'Officernameeng',
            'OFFICERSURNAMEENG' => 'Officersurnameeng',
            'OFFICEREMAIL' => 'Officeremail',
            'REMARK' => 'Remark',
            'OFFICERLOGIN' => 'Officerlogin',
            'LDAP' => 'Ldap',
            'SKIPSYNC' => 'Skipsync',
        ];
    }
}

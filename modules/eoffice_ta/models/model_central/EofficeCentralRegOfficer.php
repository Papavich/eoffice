<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.reg_officer".
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
class EofficeCentralRegOfficer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.reg_officer';
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

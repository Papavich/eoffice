<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_main.reg_studentmaster".
 *
 * @property string $STUDENTID
 * @property string $STUDENTCODE
 * @property string $PREFIXID
 * @property string $LEVELID
 * @property string $STUDENTNAME
 * @property string $STUDENTNAMEENG
 * @property string $STUDENTSURNAME
 * @property string $STUDENTSURNAMEENG
 * @property string $STUDENTYEAR
 * @property string $STUDENTEMAIL
 * @property string $STUDENTSTATUS
 * @property double $GPA
 * @property string $ADMITDATE
 * @property string $FINISHDATE
 * @property string $FACALTYID
 * @property string $DEPARTMENTID
 * @property string $PROGRAMID
 */
class RegStudentmaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_main.reg_studentmaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'PREFIXID', 'LEVELID', 'FACALTYID', 'DEPARTMENTID', 'PROGRAMID'], 'required'],
            [['GPA'], 'number'],
            [['ADMITDATE', 'FINISHDATE'], 'safe'],
            [['STUDENTID', 'STUDENTCODE'], 'string', 'max' => 20],
            [['PREFIXID', 'LEVELID', 'FACALTYID'], 'string', 'max' => 50],
            [['STUDENTNAME', 'STUDENTNAMEENG', 'STUDENTSURNAME', 'STUDENTSURNAMEENG', 'STUDENTYEAR', 'STUDENTEMAIL', 'STUDENTSTATUS'], 'string', 'max' => 100],
            [['DEPARTMENTID'], 'string', 'max' => 80],
            [['PROGRAMID'], 'string', 'max' => 255],
            [['STUDENTID'], 'unique'],
            [['PROGRAMID'], 'exist', 'skipOnError' => true, 'targetClass' => AvsregProgram::className(), 'targetAttribute' => ['PROGRAMID' => 'PROGRAMID']],
            [['DEPARTMENTID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['DEPARTMENTID' => 'DEPARTMENTID']],
            [['FACALTYID'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['FACALTYID' => 'FACALTYID']],
            [['LEVELID'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['LEVELID' => 'LEVELID']],
            [['PREFIXID'], 'exist', 'skipOnError' => true, 'targetClass' => Prefix::className(), 'targetAttribute' => ['PREFIXID' => 'PREFIXID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
            'STUDENTCODE' => 'Studentcode',
            'PREFIXID' => 'Prefixid',
            'LEVELID' => 'Levelid',
            'STUDENTNAME' => 'Studentname',
            'STUDENTNAMEENG' => 'Studentnameeng',
            'STUDENTSURNAME' => 'Studentsurname',
            'STUDENTSURNAMEENG' => 'Studentsurnameeng',
            'STUDENTYEAR' => 'Studentyear',
            'STUDENTEMAIL' => 'Studentemail',
            'STUDENTSTATUS' => 'Studentstatus',
            'GPA' => 'Gpa',
            'ADMITDATE' => 'Admitdate',
            'FINISHDATE' => 'Finishdate',
            'FACALTYID' => 'Facaltyid',
            'DEPARTMENTID' => 'Departmentid',
            'PROGRAMID' => 'Programid',
        ];
    }
}

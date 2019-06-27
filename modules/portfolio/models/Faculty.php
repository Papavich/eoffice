<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property string $FACALTYID
 * @property string $FACULTYNAME
 * @property string $FACULTYNAMEENG
 * @property string $FACULTYABB
 * @property string $DEAN
 * @property string $DEANENG
 * @property string $FACULTYTYPE
 * @property string $FACULTYGROUP
 *
 * @property Studentreg[] $studentregs
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FACALTYID'], 'required'],
            [['FACALTYID', 'FACULTYNAME', 'FACULTYNAMEENG', 'FACULTYABB', 'DEAN', 'DEANENG', 'FACULTYTYPE', 'FACULTYGROUP'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FACALTYID' => 'Facaltyid',
            'FACULTYNAME' => 'Facultyname',
            'FACULTYNAMEENG' => 'Facultynameeng',
            'FACULTYABB' => 'Facultyabb',
            'DEAN' => 'Dean',
            'DEANENG' => 'Deaneng',
            'FACULTYTYPE' => 'Facultytype',
            'FACULTYGROUP' => 'Facultygroup',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentregs()
    {
        return $this->hasMany(Studentreg::className(), ['FACALTYID' => 'FACALTYID']);
    }
}

<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "epro_enroll".
 *
 * @property string $STUDENTID
 * @property string $ACADYEAR
 * @property string $SEMESTER
 * @property string $COURSEID
 * @property string $SECTION
 * @property string $CLASSID
 * @property string $CREDITATTEMPT
 * @property string $CREDITSATISFY
 * @property string $FACALTYID
 * @property string $DEPARTMENTID
 *
 * @property RegFaculty $fACALTY
 * @property RegDepartment $dEPARTMENT
 * @property RegStudentmaster $sTUDENT
 */
class EproEnroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_enroll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'FACALTYID', 'DEPARTMENTID'], 'required'],
            [['STUDENTID'], 'string', 'max' => 20],
            [['ACADYEAR', 'SEMESTER', 'COURSEID', 'SECTION', 'CLASSID', 'CREDITATTEMPT', 'CREDITSATISFY'], 'string', 'max' => 255],
            [['FACALTYID'], 'string', 'max' => 50],
            [['DEPARTMENTID'], 'string', 'max' => 80],
            [['FACALTYID'], 'exist', 'skipOnError' => true, 'targetClass' => RegFaculty::className(), 'targetAttribute' => ['FACALTYID' => 'FACALTYID']],
            [['DEPARTMENTID'], 'exist', 'skipOnError' => true, 'targetClass' => RegDepartment::className(), 'targetAttribute' => ['DEPARTMENTID' => 'DEPARTMENTID']],
            [['STUDENTID'], 'exist', 'skipOnError' => true, 'targetClass' => RegStudentmaster::className(), 'targetAttribute' => ['STUDENTID' => 'STUDENTID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
            'ACADYEAR' => 'Acadyear',
            'SEMESTER' => 'Semester',
            'COURSEID' => 'Courseid',
            'SECTION' => 'Section',
            'CLASSID' => 'Classid',
            'CREDITATTEMPT' => 'Creditattempt',
            'CREDITSATISFY' => 'Creditsatisfy',
            'FACALTYID' => 'Facaltyid',
            'DEPARTMENTID' => 'Departmentid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFACALTY()
    {
        return $this->hasOne(RegFaculty::className(), ['FACALTYID' => 'FACALTYID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEPARTMENT()
    {
        return $this->hasOne(RegDepartment::className(), ['DEPARTMENTID' => 'DEPARTMENTID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTUDENT()
    {
        return $this->hasOne(RegStudentmaster::className(), ['STUDENTID' => 'STUDENTID']);
    }
}

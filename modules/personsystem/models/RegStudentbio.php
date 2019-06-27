<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_studentbio".
 *
 * @property int $STUDENTID
 * @property string $NATIONID
 * @property string $RELIGIONID
 * @property string $SCHOOLID
 * @property string $ENTRYTYPE
 * @property string $ENTRYDEGREE
 * @property string $BIRTHDATE
 * @property string $STUDENTFATHERNAME
 * @property string $STUDENTMOTHERNAME
 * @property string $STUDENTSEX
 * @property string $ENTRYGPA
 * @property string $CITIZENID
 * @property string $PARENTNAME
 * @property string $PARENTRELATION
 * @property string $STUDENTMOBILE
 * @property string $HOMEADDRESS1
 * @property string $HOMEADDRESS2
 * @property string $HOMEDISTRICT
 * @property string $HOMEZIPCODE
 * @property string $PARENTPHONENO
 * @property string $HOMEPROVINCEID
 * @property string $CURRENTADDRESS1
 * @property string $CURRENTADDRESS2
 * @property string $CURRENTDISTRICT
 * @property string $CURRENTPROVINCEID
 * @property string $CURRENTZIPCODE
 * @property string $CONTACTPERSON
 * @property string $CONTACTPHONENO
 * @property string $CONTACTRELATION
 * @property string $HOMEPHONENO
 *
 * @property RegStudentmaster $sTUDENT
 */
class RegStudentbio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_studentbio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STUDENTID'], 'required'],
            [['STUDENTID'], 'integer'],
            [['NATIONID', 'RELIGIONID', 'SCHOOLID', 'ENTRYTYPE', 'ENTRYDEGREE', 'BIRTHDATE', 'STUDENTFATHERNAME', 'STUDENTMOTHERNAME', 'STUDENTSEX', 'ENTRYGPA', 'CITIZENID', 'PARENTNAME', 'PARENTRELATION', 'STUDENTMOBILE', 'HOMEADDRESS1', 'HOMEADDRESS2', 'HOMEDISTRICT', 'HOMEZIPCODE', 'PARENTPHONENO', 'HOMEPROVINCEID', 'CURRENTADDRESS1', 'CURRENTADDRESS2', 'CURRENTDISTRICT', 'CURRENTPROVINCEID', 'CURRENTZIPCODE', 'CONTACTPERSON', 'CONTACTPHONENO', 'CONTACTRELATION', 'HOMEPHONENO'], 'string', 'max' => 200],
            [['STUDENTID'], 'unique'],
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
            'NATIONID' => 'Nationid',
            'RELIGIONID' => 'Religionid',
            'SCHOOLID' => 'Schoolid',
            'ENTRYTYPE' => 'Entrytype',
            'ENTRYDEGREE' => 'Entrydegree',
            'BIRTHDATE' => 'Birthdate',
            'STUDENTFATHERNAME' => 'Studentfathername',
            'STUDENTMOTHERNAME' => 'Studentmothername',
            'STUDENTSEX' => 'Studentsex',
            'ENTRYGPA' => 'Entrygpa',
            'CITIZENID' => 'Citizenid',
            'PARENTNAME' => 'Parentname',
            'PARENTRELATION' => 'Parentrelation',
            'STUDENTMOBILE' => 'Studentmobile',
            'HOMEADDRESS1' => 'Homeaddress1',
            'HOMEADDRESS2' => 'Homeaddress2',
            'HOMEDISTRICT' => 'Homedistrict',
            'HOMEZIPCODE' => 'Homezipcode',
            'PARENTPHONENO' => 'Parentphoneno',
            'HOMEPROVINCEID' => 'Homeprovinceid',
            'CURRENTADDRESS1' => 'Currentaddress1',
            'CURRENTADDRESS2' => 'Currentaddress2',
            'CURRENTDISTRICT' => 'Currentdistrict',
            'CURRENTPROVINCEID' => 'Currentprovinceid',
            'CURRENTZIPCODE' => 'Currentzipcode',
            'CONTACTPERSON' => 'Contactperson',
            'CONTACTPHONENO' => 'Contactphoneno',
            'CONTACTRELATION' => 'Contactrelation',
            'HOMEPHONENO' => 'Homephoneno',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTUDENT()
    {
        return $this->hasOne(RegStudentmaster::className(), ['STUDENTID' => 'STUDENTID']);
    }
}

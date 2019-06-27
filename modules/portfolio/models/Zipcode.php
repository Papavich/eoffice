<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "zipcode".
 *
 * @property integer $ZIPCODE _ID
 * @property string $DISTRICT_CODE
 * @property string $ZIPCODE
 *
 * @property Person[] $people
 * @property Person[] $people0
 * @property Studentbio[] $studentbios
 * @property Studentbio[] $studentbios0
 * @property Studentbio[] $studentbios1
 * @property Studentbio[] $studentbios2
 * @property Studentbio[] $studentbios3
 * @property Studentbio[] $studentbios4
 */
class Zipcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zipcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ZIPCODE _ID'], 'required'],
            [['ZIPCODE _ID'], 'integer'],
            [['DISTRICT_CODE', 'ZIPCODE'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ZIPCODE _ID' => 'Zipcode   ID',
            'DISTRICT_CODE' => 'District  Code',
            'ZIPCODE' => 'Zipcode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['person_current_zipcode' => 'ZIPCODE _ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople0()
    {
        return $this->hasMany(Person::className(), ['person_home_zipcode' => 'ZIPCODE _ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios()
    {
        return $this->hasMany(Studentbio::className(), ['contact_zipcode_id' => 'ZIPCODE _ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios0()
    {
        return $this->hasMany(Studentbio::className(), ['parent_zipcode_id' => 'ZIPCODE _ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios1()
    {
        return $this->hasMany(Studentbio::className(), ['mother_zipcode_id' => 'ZIPCODE _ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios2()
    {
        return $this->hasMany(Studentbio::className(), ['father_zipcode_id' => 'ZIPCODE _ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios3()
    {
        return $this->hasMany(Studentbio::className(), ['student_home_zipcode_id' => 'ZIPCODE _ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios4()
    {
        return $this->hasMany(Studentbio::className(), ['student_current_zipcode_id' => 'ZIPCODE _ID']);
    }
}

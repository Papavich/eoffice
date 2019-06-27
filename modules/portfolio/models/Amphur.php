<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "amphur".
 *
 * @property integer $AMPHUR_ID
 * @property string $AMPHUR_CODE
 * @property string $AMPHUR_NAME
 * @property string $AMPHUR_NAME_ENG
 * @property integer $GEO_ID
 * @property integer $PROVINCE_ID
 *
 * @property Geography $gEO
 * @property Province $pROVINCE
 * @property District[] $districts
 * @property Person[] $people
 * @property Person[] $people0
 * @property Studentbio[] $studentbios
 * @property Studentbio[] $studentbios0
 * @property Studentbio[] $studentbios1
 * @property Studentbio[] $studentbios2
 * @property Studentbio[] $studentbios3
 * @property Studentbio[] $studentbios4
 */
class Amphur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amphur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AMPHUR_ID', 'GEO_ID', 'PROVINCE_ID'], 'required'],
            [['AMPHUR_ID', 'GEO_ID', 'PROVINCE_ID'], 'integer'],
            [['AMPHUR_CODE', 'AMPHUR_NAME', 'AMPHUR_NAME_ENG'], 'string', 'max' => 50],
            [['GEO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Geography::className(), 'targetAttribute' => ['GEO_ID' => 'GEO_ID']],
            [['PROVINCE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['PROVINCE_ID' => 'PROVINCE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AMPHUR_ID' => 'Amphur  ID',
            'AMPHUR_CODE' => 'Amphur  Code',
            'AMPHUR_NAME' => 'Amphur  Name',
            'AMPHUR_NAME_ENG' => 'Amphur  Name  Eng',
            'GEO_ID' => 'Geo  ID',
            'PROVINCE_ID' => 'Province  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGEO()
    {
        return $this->hasOne(Geography::className(), ['GEO_ID' => 'GEO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROVINCE()
    {
        return $this->hasOne(Province::className(), ['PROVINCE_ID' => 'PROVINCE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['AMPHUR_ID' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['person_home_amphur' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople0()
    {
        return $this->hasMany(Person::className(), ['person_current_amphur' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios()
    {
        return $this->hasMany(Studentbio::className(), ['contact_amphur_id' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios0()
    {
        return $this->hasMany(Studentbio::className(), ['parent_amphur_id' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios1()
    {
        return $this->hasMany(Studentbio::className(), ['mother_amphur_id' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios2()
    {
        return $this->hasMany(Studentbio::className(), ['father_amphur_id' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios3()
    {
        return $this->hasMany(Studentbio::className(), ['student_home_amphur_id' => 'AMPHUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentbios4()
    {
        return $this->hasMany(Studentbio::className(), ['student_current_amphur_id' => 'AMPHUR_ID']);
    }
}

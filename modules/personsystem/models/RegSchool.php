<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "reg_school".
 *
 * @property int $SCHOOLID
 * @property string $SCHOOLNAME
 * @property string $SCHOOLNAMEENG
 * @property string $SCHOOLHEAD
 * @property string $SCHOOLADDRESS1
 * @property string $SCHOOLADDRESS2
 * @property string $SCHOOLDISTRICT
 * @property string $SCHOOLZIPCODE
 * @property string $SCHOOLPHONENO
 * @property string $SCHOOLPROVINCEID
 * @property string $SCHOOLCODE
 * @property string $FLAG1
 * @property string $NATIONID
 * @property string $SCHOOLCODE2
 * @property string $VALID
 * @property string $GROUPID
 */
class RegSchool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SCHOOLID'], 'required'],
            [['SCHOOLID'], 'integer'],
            [['SCHOOLNAME', 'SCHOOLNAMEENG', 'SCHOOLHEAD', 'SCHOOLADDRESS1', 'SCHOOLADDRESS2', 'SCHOOLDISTRICT', 'SCHOOLZIPCODE', 'SCHOOLPHONENO', 'SCHOOLPROVINCEID', 'SCHOOLCODE', 'FLAG1', 'NATIONID', 'SCHOOLCODE2', 'VALID', 'GROUPID'], 'string', 'max' => 255],
            [['SCHOOLID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SCHOOLID' => 'ID',
            'SCHOOLNAME' => 'Name',
            'SCHOOLNAMEENG' => 'Name Eng',
            'SCHOOLHEAD' => 'School Head',
            'SCHOOLADDRESS1' => 'Address 1',
            'SCHOOLADDRESS2' => 'Address 2',
            'SCHOOLDISTRICT' => 'District',
            'SCHOOLZIPCODE' => 'Zipcode',
            'SCHOOLPHONENO' => 'Phone',
            'SCHOOLPROVINCEID' => 'SchoolProvinceID',
            'SCHOOLCODE' => 'School Code',
            'FLAG1' => 'Flag1',
            'NATIONID' => 'Nationid',
            'SCHOOLCODE2' => 'School Code 2',
            'VALID' => 'Valid',
            'GROUPID' => 'Groupid',
        ];
    }
}

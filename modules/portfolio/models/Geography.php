<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "geography".
 *
 * @property integer $GEO_ID
 * @property string $GEO_NAME
 *
 * @property Amphur[] $amphurs
 * @property District[] $districts
 * @property Province[] $provinces
 */
class Geography extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geography';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GEO_ID'], 'required'],
            [['GEO_ID'], 'integer'],
            [['GEO_NAME'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GEO_ID' => 'Geo  ID',
            'GEO_NAME' => 'Geo  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmphurs()
    {
        return $this->hasMany(Amphur::className(), ['GEO_ID' => 'GEO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['GEO_ID' => 'GEO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinces()
    {
        return $this->hasMany(Province::className(), ['GEO_ID' => 'GEO_ID']);
    }
}

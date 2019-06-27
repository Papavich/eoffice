<?php

namespace app\modules\eoffice_eolmv2\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_central.province".
 *
 * @property int $PROVINCE_ID
 * @property string $PROVINCE_CODE
 * @property string $PROVINCE_NAME
 * @property int $GEO_ID
 */
class EofficeMainProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.province';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROVINCE_CODE', 'PROVINCE_NAME'], 'required'],
            [['GEO_ID'], 'integer'],
            [['PROVINCE_CODE'], 'string', 'max' => 2],
            [['PROVINCE_NAME'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROVINCE_ID' => 'Province  ID',
            'PROVINCE_CODE' => 'Province  Code',
            'PROVINCE_NAME' => 'Province  Name',
            'GEO_ID' => 'Geo  ID',
        ];
    }
}

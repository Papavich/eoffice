<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_property".
 *
 * @property int $ta_property_id
 * @property string $ta_property_name
 * @property string $ta_property_value
 * @property string $level_degree
 * @property string $property_detail
 * @property string $property_gpa
 * @property string $active_status
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 */
class TaProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_property';
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
            [['ta_property_value', 'property_gpa'], 'number'],
            [['active_status'], 'string'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_property_name'], 'string', 'max' => 5],
            [['level_degree'], 'string', 'max' => 10],
            [['property_detail'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_property_name' => controllers::t( 'label', 'Property Grade'),
            'ta_property_value' => controllers::t( 'label', 'Property Value'),
            'level_degree' => controllers::t( 'label', 'Level Degree'),
            'property_detail' => controllers::t( 'label', 'Detail'),
            'property_gpa' => controllers::t( 'label', 'GPA'),
            'active_status' => controllers::t( 'label', 'Active Status'),
            'crby' => controllers::t('label','Create Time'),
            'crtime' => controllers::t('label','Create By'),
            'udby' => controllers::t('label','Update By'),
            'udtime' => controllers::t('label','Update Time'),
        ];
    }
}

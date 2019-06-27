<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "frequency".
 *
 * @property integer $frequency_order_id
 * @property string $frequency_name
 * @property string $frequency_id
 */
class Frequency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frequency';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency_order_id', 'frequency_name', 'frequency_id'], 'required'],
            [['frequency_order_id'], 'integer'],
            [['frequency_name'], 'string', 'max' => 50],
            [['frequency_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frequency_order_id' => 'Frequency Order ID',
            'frequency_name' => 'Frequency Name',
            'frequency_id' => 'Frequency ID',
        ];
    }
}

<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "areward_order".
 *
 * @property integer $areward_order_id
 * @property integer $areward_name
 * @property integer $date_areward
 * @property integer $owner_id
 * @property integer $level_id
 */
class Areward_Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areward_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['areward_name', 'date_areward', 'owner_id', 'level_id'], 'required'],
            [['areward_name', 'date_areward', 'owner_id', 'level_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'areward_order_id' => 'Areward Order ID',
            'areward_name' => 'Areward Name',
            'date_areward' => 'Date Areward',
            'owner_id' => 'Owner ID',
            'level_id' => 'Level ID',
        ];
    }
}

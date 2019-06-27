<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 8/3/2561
 * Time: 18:38
 */

namespace app\modules\eoffice_ta\components;


use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class TimeBehavior
{

    public function behaviors()
    {
        return [

            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'crtime',
                'updatedAtAttribute' => 'udtime',
                'value' => new Expression('NOW()'),//กำหนดค่า หรืออาจใช้ค่าอย่างอื่นที่ return เป็น timestamp ก็ได้
            ],
            //other behaviors
        ];
    }
}
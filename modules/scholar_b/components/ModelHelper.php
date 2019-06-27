<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 1/3/2561
 * Time: 22:54
 */

namespace app\modules\scholar_b\components;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class ModelHelper
{
    public static function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'crtime',
                'updatedAtAttribute' => 'udtime',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'crby',
                'updatedByAttribute' => 'udby',
            ],
        ];
    }
}
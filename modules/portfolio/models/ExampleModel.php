<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 7/3/2561
 * Time: 1:10
 */

namespace app\modules\portfolio\models;



use yii\base\Model;

class ExampleModel extends Model
{

    public $website;

    public function init()
    {
        parent::init();

        $this->website = [
            [
                'day' => '27.02.2015',
                'user_id' => 1,
                'priority' => 1
            ],
            [
                'day' => '27.02.2015',
                'user_id' => 2,
                'priority' => 2
            ],
        ];

    }
}
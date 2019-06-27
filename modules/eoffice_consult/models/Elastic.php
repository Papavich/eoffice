<?php

namespace app\modules\eoffice_consult\models;

use Yii;

class Elastic extends \yii\elasticsearch\ActiveRecord
{
    public function attributes()
    {
      //  return['name', 'email'];
      return [
          'post_id',
          'post_ark_detail',
          'post_ark_date',
          'status_id',
          'post_ans',
          'post_ans_date',
          'topic_owner_id',
          'respon_id',
          'user_id',
      ];
    }

}

<?php

namespace app\modules\eoffice_consult\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "question".
 *
 * @property int $question_id
 * @property int $question_one
 * @property int $question_two
 * @property int $question_three
 * @property int $question_four
 * @property int $question_five
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_consult');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        
            [['question_one', 'question_two', 'question_three', 'question_four', 'question_five'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'ID',
            'question_one' => '1.ความสุภาพของการให้คำปรึกษา',
            'question_two' => '2.ความง่ายต่อการใช้งาน',
            'question_three' => '3.การตอบคำถามที่ชัดเจน',
            'question_four' => '4.ความเร็วของการให้คำปรึกษา',
            'question_five' => '5.ความสะดวกในการติดต่อ',
        ];
    }

    // public static function itemsAlias($key){
    //     return [
    //
    //        'qone'=>[
    //          1 => 'น้อยมาก',
    //          2 => 'น้อย',
    //          3 => 'ปานกลาง',
    //          4 => 'มาก',
    //          5 => 'มากที่สุด',
    //        ],
    //
    //        'qtwo'=>[
    //          1 => 'น้อยมาก',
    //          2 => 'น้อย',
    //          3 => 'ปานกลาง',
    //          4 => 'มาก',
    //          5 => 'มากที่สุด',
    //        ],
    //
    //        'qthree'=>[
    //          1 => 'น้อยมาก',
    //          2 => 'น้อย',
    //          3 => 'ปานกลาง',
    //          4 => 'มาก',
    //          5 => 'มากที่สุด',
    //        ],
    //
    //        'qfour'=>[
    //          1 => 'น้อยมาก',
    //          2 => 'น้อย',
    //          3 => 'ปานกลาง',
    //          4 => 'มาก',
    //          5 => 'มากที่สุด',
    //        ],
    //
    //        'qfive'=>[
    //          1 => 'น้อยมาก',
    //          2 => 'น้อย',
    //          3 => 'ปานกลาง',
    //          4 => 'มาก',
    //          5 => 'มากที่สุด',
    //        ]
    //
    //
    //    ];
    //      return ArrayHelper::getValue($items,$key,[]);
    //      //return array_key_exists($key, $items) ? $items[$key] : [];
    //    }
    //
    //    public function getItemQuestionone()
    //    {
    //      return self::itemsAlias('qone');
    //    }
    //
    //    public function getItemQuestiontwo()
    //    {
    //      return self::itemsAlias('qtwo');
    //    }
    //
    //    public function getItemQuestionthree()
    //    {
    //      return self::itemsAlias('qthree');
    //    }
    //
    //    public function getItemQuestionfour()
    //    {
    //      return self::itemsAlias('qfour');
    //    }
    //
    //    public function getItemQuestionfive()
    //    {
    //      return self::itemsAlias('qfive');
    //    }
    //
    //    public function getQuestiononeName(){
    //        return ArrayHelper::getValue($this->getItemQuestionone(),$this->question_one);
    //    }
    //
    //    public function getQuestiontwoName(){
    //        return ArrayHelper::getValue($this->getItemQuestiontwo(),$this->question_two);
    //    }
    //
    //    public function getQuestionthreeName(){
    //        return ArrayHelper::getValue($this->getItemQuestionthree(),$this->question_three);
    //    }
    //
    //    public function getQuestionfourName(){
    //        return ArrayHelper::getValue($this->getItemQuestionfour(),$this->question_four);
    //    }
    //
    //    public function getQuestionfiveName(){
    //        return ArrayHelper::getValue($this->getItemQuestionfive(),$this->question_five);
    //    }
    //

}

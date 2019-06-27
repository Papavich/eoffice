<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "adder".
 *
 * @property integer $sub_id
 * @property string $sub_type
 * @property integer $sub_year
 * @property string $sub_term
 * @property string $sub_thainame
 * @property string $sub_engname
 * @property integer $sub_credit
 * @property string $sub_teacher
 * @property string $sub_student
 */
class Adder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adder';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_test');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_id', 'sub_type', 'sub_year', 'sub_term', 'sub_thainame', 'sub_engname', 'sub_credit', 'sub_teacher', 'sub_student'], 'required'],
            [['sub_id', 'sub_year', 'sub_credit'], 'integer'],
            [['sub_type', 'sub_thainame', 'sub_engname', 'sub_teacher', 'sub_student'], 'string', 'max' => 50],
            [['sub_term'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sub_id' => 'Sub ID',
            'sub_type' => 'Sub Type',
            'sub_year' => 'Sub Year',
            'sub_term' => 'Sub Term',
            'sub_thainame' => 'Sub Thainame',
            'sub_engname' => 'Sub Engname',
            'sub_credit' => 'Sub Credit',
            'sub_teacher' => 'Sub Teacher',
            'sub_student' => 'Sub Student',
        ];
    }
}

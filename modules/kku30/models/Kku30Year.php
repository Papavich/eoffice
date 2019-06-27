<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_year".
 *
 * @property int $year_id
 */
class Kku30Year extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kku30_year';
    }

    /**
     * {@inheritdoc}
     */

    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['year_id'], 'required'],
            [['year_id'], 'integer'],
            [['year_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'year_id' => 'Year ID',
        ];
    }
}

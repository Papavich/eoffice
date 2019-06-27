<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_semester".
 *
 * @property int $semester_id
 */
class Kku30Semester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kku30_semester';
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
            [['semester_id'], 'required'],
            [['semester_id'], 'integer'],
            [['semester_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'semester_id' => 'Semester ID',
        ];
    }
}

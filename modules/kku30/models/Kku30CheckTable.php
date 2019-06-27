<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_check_table".
 *
 * @property int $check_table_year
 * @property int $check_table_semester
 * @property int $check_table_status
 */
class Kku30CheckTable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kku30_check_table';
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
            [['check_table_year', 'check_table_semester'], 'required'],
            [['check_table_year', 'check_table_semester', 'check_table_status'], 'integer'],
            [['check_table_year', 'check_table_semester'], 'unique', 'targetAttribute' => ['check_table_year', 'check_table_semester']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'check_table_year' => 'Check Table Year',
            'check_table_semester' => 'Check Table Semester',
            'check_table_status' => 'Check Table Status',
        ];
    }
}

<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "view_kku30_subject_open".
 *
 * @property string $subject_id
 * @property string $term_id
 * @property string $year_id
 * @property string $subject_name
 * @property string $credit
 * @property integer $amount_sec
 * @property string $teacher
 */
class ViewSubjectOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_kku30_subject_open';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'term_id', 'year_id'], 'required'],
            [['amount_sec'], 'integer'],
            [['subject_id', 'term_id', 'year_id'], 'string', 'max' => 10],
            [['subject_name', 'credit'], 'string', 'max' => 45],
            [['teacher'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'term_id' => 'Term ID',
            'year_id' => 'Year ID',
            'subject_name' => 'Subject Name',
            'credit' => 'Credit',
            'amount_sec' => 'Amount Sec',
            'teacher' => 'Teacher',
        ];
    }
}

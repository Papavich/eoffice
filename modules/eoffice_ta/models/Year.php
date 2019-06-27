<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "year".
 *
 * @property string $year_id
 * @property string $year_name
 *
 * @property Term[] $terms
 */
class Year extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'year';
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
            [['year_id'], 'required'],
            [['year_id'], 'string', 'max' => 10],
            [['year_name'], 'string', 'max' => 45],
            [['year_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year_id' => 'Year ID',
            'year_name' => 'Year Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerms()
    {
        return $this->hasMany(Term::className(), ['year' => 'year_id']);
    }
}

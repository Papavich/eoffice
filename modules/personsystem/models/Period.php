<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "period".
 *
 * @property int $period_id
 * @property string $period_describe
 * @property string $date
 *
 * @property BoardOfDirectors[] $boardOfDirectors
 */
class Period extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'period';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['period_describe'], 'string', 'max' => 200],
            [['period_describe', 'date'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'period_id' => 'Period ID',
            'period_describe' => 'Period Describe',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoardOfDirectors()
    {
        return $this->hasMany(BoardOfDirectors::className(), ['period_id' => 'period_id']);
    }
}

<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "board_of_directors".
 *
 * @property integer $board_id
 * @property integer $person_id
 * @property integer $director_id
 * @property integer $period_id
 *
 * @property Period $period
 * @property Person $person
 * @property PositionDirectors $director
 */
class BoardOfDirectors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'board_of_directors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'director_id', 'period_id'], 'required'],
            [['person_id', 'director_id', 'period_id'], 'integer'],
            [['period_id'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['period_id' => 'period_id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'person_id']],
            [['director_id'], 'exist', 'skipOnError' => true, 'targetClass' => PositionDirectors::className(), 'targetAttribute' => ['director_id' => 'director_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'board_id' => 'Board ID',
            'person_id' => 'Person ID',
            'director_id' => 'Director ID',
            'period_id' => 'Period ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(Period::className(), ['period_id' => 'period_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirector()
    {
        return $this->hasOne(PositionDirectors::className(), ['director_id' => 'director_id']);
    }
}

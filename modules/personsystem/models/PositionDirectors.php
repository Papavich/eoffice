<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "position_directors".
 *
 * @property int $director_id
 * @property string $position_name
 * @property string $position_name_eng
 *
 * @property BoardOfDirectors[] $boardOfDirectors
 */
class PositionDirectors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position_directors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_name', 'position_name_eng'], 'string', 'max' => 200],
            [['position_name', 'position_name_eng'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'director_id' => 'Director ID',
            'position_name' => 'Position Name',
            'position_name_eng' => 'Position Name Eng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoardOfDirectors()
    {
        return $this->hasMany(BoardOfDirectors::className(), ['director_id' => 'director_id']);
    }
}

<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "history_education".
 *
 * @property int $history_education_id
 * @property string $level_education
 * @property string $educational_background
 * @property string $educational_background_eng
 * @property string $educational_institution
 * @property string $educational_institution_eng
 * @property string $graduate_year
 * @property int $person_id
 *
 * @property Person $person
 */
class HistoryEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level_education', 'educational_background', 'educational_institution', 'graduate_year', 'person_id'], 'required'],
            [['person_id'], 'integer'],
            [['level_education', 'educational_background', 'educational_background_eng', 'educational_institution', 'educational_institution_eng'], 'string', 'max' => 50],
            [['graduate_year'], 'string', 'max' => 20],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'history_education_id' => 'History Education ID',
            'level_education' => 'Level Education',
            'educational_background' => 'Educational Background',
            'educational_background_eng' => 'Educational Background Eng',
            'educational_institution' => 'Educational Institution',
            'educational_institution_eng' => 'Educational Institution Eng',
            'graduate_year' => 'Graduate Year',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }
}

<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "expertise".
 *
 * @property int $expertise_id
 * @property int $person_id
 * @property string $expertise_field_name
 * @property string $expertise_field_name_eng
 *
 * @property Person $person
 */
class Expertise extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expertise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'expertise_field_name', 'expertise_field_name_eng'], 'required'],
            [['person_id'], 'integer'],
            [['expertise_field_name', 'expertise_field_name_eng'], 'string', 'max' => 100],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expertise_id' => 'Expertise ID',
            'person_id' => 'Person ID',
            'expertise_field_name' => 'Expertise Field Name',
            'expertise_field_name_eng' => 'Expertise Field Name Eng',
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

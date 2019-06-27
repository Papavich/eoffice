<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "expertise".
 *
 * @property string $expertise_id
 * @property string $person_id
 * @property string $expertise_field_name
 * @property string $expertise_field_name_eng
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
            [['expertise_id', 'person_id'], 'string', 'max' => 50],
            [['expertise_field_name', 'expertise_field_name_eng'], 'string', 'max' => 100],
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
}

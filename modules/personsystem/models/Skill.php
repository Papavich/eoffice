<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id_skill
 * @property string $skill_name
 *
 * @property StudentSkill[] $studentSkills
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skill_name'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_skill' => 'Id Skill',
            'skill_name' => 'Skill Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentSkills()
    {
        return $this->hasMany(StudentSkill::className(), ['id_skill' => 'id_skill']);
    }
}

<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "student_skill".
 *
 * @property int $id_skill
 * @property int $id_student
 *
 * @property Skill $skill
 * @property Student $student
 */
class StudentSkill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_skill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_skill', 'id_student'], 'required'],
            [['id_skill', 'id_student'], 'integer'],
            [['id_skill', 'id_student'], 'unique', 'targetAttribute' => ['id_skill', 'id_student']],
            [['id_skill'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['id_skill' => 'id_skill']],
            [['id_student'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['id_student' => 'STUDENTID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_skill' => 'Id Skill',
            'id_student' => 'Id Student',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id_skill' => 'id_skill']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['STUDENTID' => 'id_student']);
    }
}

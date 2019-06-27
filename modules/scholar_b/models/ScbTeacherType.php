<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_teacher_type".
 *
 * @property int $type_id
 * @property string $type_name
 *
 * @property ScbTeacherHasType[] $scbTeacherHasTypes
 * @property ScbTeacher[] $teacherIdCards
 */
class ScbTeacherType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_teacher_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id'], 'required'],
            [['type_id'], 'integer'],
            [['type_name'], 'string', 'max' => 45],
            [['type_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'ประเภท',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbTeacherHasTypes()
    {
        return $this->hasMany(ScbTeacherHasType::className(), ['teacher_type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherIdCards()
    {
        return $this->hasMany(ScbTeacher::className(), ['id_card' => 'teacher_id_card'])->viaTable('scb_teacher_has_type', ['teacher_type_id' => 'type_id']);
    }
}

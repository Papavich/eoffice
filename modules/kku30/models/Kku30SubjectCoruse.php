<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_subject_coruse".
 *
 * @property string $course_id
 * @property string $subject_id
 * @property int $subject_version
 * @property int $type_id
 * @property int $typegroup_id
 * @property int $subgroup_id
 *
 * @property Kku30Course $course
 * @property Kku30Subgroup $subgroup
 * @property Kku30Subject $subject
 * @property Kku30Type $type
 * @property Kku30Typegroup $typegroup
 */
class Kku30SubjectCoruse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subject_coruse';
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['course_id', 'subject_id', 'subject_version', 'type_id', 'typegroup_id', 'subgroup_id'], 'required'],
            [['subject_version', 'type_id', 'typegroup_id', 'subgroup_id'], 'integer'],
            [['course_id'], 'string', 'max' => 12],
            [['subject_id'], 'string', 'max' => 10],
            [['course_id', 'subject_id', 'subject_version', 'type_id', 'typegroup_id', 'subgroup_id'], 'unique', 'targetAttribute' => ['course_id', 'subject_id', 'subject_version', 'type_id', 'typegroup_id', 'subgroup_id']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Course::className(), 'targetAttribute' => ['course_id' => 'course_id']],
            [['subgroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Subgroup::className(), 'targetAttribute' => ['subgroup_id' => 'subgroup_id']],
            [['subject_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Subject::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Type::className(), 'targetAttribute' => ['type_id' => 'type_id']],
            [['typegroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kku30Typegroup::className(), 'targetAttribute' => ['typegroup_id' => 'typegroup_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'type_id' => 'Type ID',
            'typegroup_id' => 'Typegroup ID',
            'subgroup_id' => 'Subgroup ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Kku30Course::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubgroup()
    {
        return $this->hasOne(Kku30Subgroup::className(), ['subgroup_id' => 'subgroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Kku30Subject::className(), ['subject_id' => 'subject_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Kku30Type::className(), ['type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypegroup()
    {
        return $this->hasOne(Kku30Typegroup::className(), ['typegroup_id' => 'typegroup_id']);
    }
}

<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_teacher".
 *
 * @property string $id_card
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbTeacherHasType[] $scbTeacherHasTypes
 * @property ScbTeacherType[] $teacherTypes
 */
class ScbTeacher extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_teacher';
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
            [['id_card'], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['id_card'], 'string', 'max' => 13],
            [['id_card'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_card' => 'Id Card',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbTeacherHasTypes()
    {
        return $this->hasMany(ScbTeacherHasType::className(), ['teacher_id_card' => 'id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherTypes()
    {
        return $this->hasMany(ScbTeacherType::className(), ['type_id' => 'teacher_type_id'])->viaTable('scb_teacher_has_type', ['teacher_id_card' => 'id_card']);
    }
}

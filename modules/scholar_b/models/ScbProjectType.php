<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_project_type".
 *
 * @property int $type_id
 * @property string $type_name
 *
 * @property ScbProject[] $scbProjects
 */
class ScbProjectType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_project_type';
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
            [['type_name'], 'string', 'max' => 30],
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
            'type_name' => 'Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbProjects()
    {
        return $this->hasMany(ScbProject::className(), ['project_type_id' => 'type_id']);
    }
}

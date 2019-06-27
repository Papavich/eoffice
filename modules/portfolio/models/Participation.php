<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "participation".
 *
 * @property int $participation_project_code
 * @property string $participation_project_name
 * @property string $participation_value
 *
 * @property Project[] $projects
 */
class Participation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'participation';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['participation_project_name'], 'required'],
            [['participation_project_name', 'participation_value'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'participation_project_code' => 'Participation Project Code',
            'participation_project_name' => 'Participation Project Name',
            'participation_value' => 'Participation Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['participation_participation_project_code' => 'participation_project_code']);
    }
}

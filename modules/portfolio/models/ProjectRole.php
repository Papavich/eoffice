<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "project_role".
 *
 * @property int $project_role_id
 * @property string $project_role_name
 *
 * @property ProjectOrder[] $projectOrders
 */
class ProjectRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_role';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_role_name'], 'required'],
            [['project_role_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_role_id' => 'Project Role ID',
            'project_role_name' => 'Project Role Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectOrders()
    {
        return $this->hasMany(ProjectOrder::className(), ['project_role_project_role_id' => 'project_role_id']);
    }
}

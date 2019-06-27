<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_project_x_project_type".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property integer $project_type_id
 * @property integer $project_id
 *
 * @property Project $project
 * @property ProjectType $projectType
 */
class ProjectXProjectType extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_project_x_project_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get( 'db_eproject' );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_type_id', 'project_id'], 'required'],
            [['crby', 'udby', 'project_type_id', 'project_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['project_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectType::className(), 'targetAttribute' => ['project_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'project_type_id' => 'Project Type ID',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne( Project::className(), ['id' => 'project_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectType()
    {
        return $this->hasOne( ProjectType::className(), ['id' => 'project_type_id'] );
    }


}

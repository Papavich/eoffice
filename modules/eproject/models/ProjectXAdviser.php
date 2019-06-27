<?php

namespace app\modules\eproject\models;

use Yii;

/**
 * This is the model class for table "epro_project_x_adviser".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property integer $project_id
 * @property integer $adviser_id
 * @property string $status
 * @property integer $type_id
 *
 * @property Project $project
 * @property User $adviser
 * @property AdviserType $type
 */
class ProjectXAdviser extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = '1';
    const STATUS_NOT_ACTIVE = '0';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_project_x_adviser';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'project_id', 'adviser_id', 'type_id'], 'required'],
            [['crby', 'udby', 'project_id', 'adviser_id', 'type_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['status'], 'string', 'max' => 1],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['adviser_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['adviser_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdviserType::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'project_id' => 'Project ID',
            'adviser_id' => 'Adviser ID',
            'status' => 'Status',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviser()
    {
        return $this->hasOne(User::className(), ['id' => 'adviser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(AdviserType::className(), ['id' => 'type_id']);
    }
}

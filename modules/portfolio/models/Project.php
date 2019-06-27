<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $project_id
 * @property string $project_name_thai
 * @property string $project_name_eng
 * @property string $project_start
 * @property string $project_end
 * @property string $project_duration
 * @property string $project_budget
 * @property string $repayment
 * @property string $project_url
 * @property int $std_id
 * @property int $person_id
 * @property string $participation
 * @property int $cities_id
 *
 * @property ProPub[] $proPubs
 * @property Cities $cities
 * @property ProjectOrder[] $projectOrders
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
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
            [['project_name_thai', 'project_name_eng'], 'required'],
            [['project_start', 'project_end'], 'safe'],
            [['std_id', 'person_id', 'cities_id'], 'integer'],
            [['project_name_thai', 'project_name_eng'], 'string', 'max' => 100],
            [['project_duration', 'project_budget', 'repayment', 'project_url', 'participation'], 'string', 'max' => 45],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['cities_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'project_name_thai' => 'Project Name Thai',
            'project_name_eng' => 'Project Name Eng',
            'project_start' => 'Project Start',
            'project_end' => 'Project End',
            'project_duration' => 'Project Duration',
            'project_budget' => 'Project Budget',
            'repayment' => 'Repayment',
            'project_url' => 'Project Url',
            'std_id' => 'Std ID',
            'person_id' => 'Person ID',
            'participation' => 'Participation',
            'cities_id' => 'Cities ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProPubs()
    {
        return $this->hasMany(ProPub::className(), ['project_project_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasOne(Cities::className(), ['id' => 'cities_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectOrders()
    {
        return $this->hasMany(ProjectOrder::className(), ['project_project_id' => 'project_id']);
    }
}

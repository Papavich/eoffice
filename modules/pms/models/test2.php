<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_project".
 *
 * @property integer $project_id
 * @property string $project_name
 * @property string $project_code
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property PmsProjectSub[] $pmsProjectSubs
 */
class PmsProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_project';
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['project_name'], 'string', 'max' => 100],
            [['project_code'], 'string', 'max' => 17],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'project_name' => 'Project Name',
            'project_code' => 'Project Code',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubs()
    {
        return $this->hasMany(PmsProjectSub::className(), ['project_project_id' => 'project_id']);
    }
}

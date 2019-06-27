<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_project".
 *
 * @property string $project_code
 * @property string $project_name
 * @property int $project_year
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
            [['project_code', 'project_name'], 'required'],
            [['project_year'], 'integer'],
            [['project_code'], 'string', 'max' => 17],
            [['project_name'], 'string', 'max' => 256],
            [['project_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_code' => 'Project Code',
            'project_name' => 'Project Name',
            'project_year' => 'Project Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubs()
    {
        return $this->hasMany(PmsProjectSub::className(), ['pms_project_project_code' => 'project_code']);
    }
}

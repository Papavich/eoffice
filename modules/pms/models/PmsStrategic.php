<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_strategic".
 *
 * @property integer $strategic_id
 * @property string $strategic_name
 * @property integer $pms_strategic_issues_strategic_issues_id
 *
 * @property PmsStrategicIssues $pmsStrategicIssuesStrategicIssues
 * @property PmsStrategicHasProjectSub[] $pmsStrategicHasProjectSubs
 * @property PmsProjectSub[] $pmsProjectSubProsubs
 */
class PmsStrategic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_strategic';
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
            [['strategic_name', 'pms_strategic_issues_strategic_issues_id','strategic_name'], 'required'],
            [['pms_strategic_issues_strategic_issues_id'], 'integer'],
            [['strategic_name'], 'string', 'max' => 256],
            [['pms_strategic_issues_strategic_issues_id'], 'exist', 'skipOnError' => true, 'targetClass' => PmsStrategicIssues::className(), 'targetAttribute' => ['pms_strategic_issues_strategic_issues_id' => 'strategic_issues_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'strategic_id' => 'ลำดับกลยุทธ์ ',
            'strategic_name' => 'ชื่อกลยุทธ์ ',
            'pms_strategic_issues_strategic_issues_id' => 'Pms Strategic Issues Strategic Issues ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsStrategicIssuesStrategicIssues()
    {
        return $this->hasOne(PmsStrategicIssues::className(), ['strategic_issues_id' => 'pms_strategic_issues_strategic_issues_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsStrategicHasProjectSubs()
    {
        return $this->hasMany(PmsStrategicHasProjectSub::className(), ['strategic_strategic_id' => 'strategic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubProsubs()
    {
        return $this->hasMany(PmsProjectSub::className(), ['prosub_id' => 'pms_project_sub_prosub_id'])->viaTable('pms_strategic_has_project_sub', ['strategic_strategic_id' => 'strategic_id']);
    }
}

<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "strategic".
 *
 * @property int $strategic_id
 * @property string $strategic_name
 * @property int $strategic_issues_strategic_issues_id
 *
 * @property PmsStrategicOfYear[] $pmsStrategicOfYears
 * @property StrategicIssues $strategicIssuesStrategicIssues
 */
class Strategic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'strategic';
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
            [['strategic_id', 'strategic_issues_strategic_issues_id'], 'required'],
            [['strategic_id', 'strategic_issues_strategic_issues_id'], 'integer'],
            [['strategic_name'], 'string', 'max' => 100],
            [['strategic_id', 'strategic_issues_strategic_issues_id'], 'unique', 'targetAttribute' => ['strategic_id', 'strategic_issues_strategic_issues_id']],
            [['strategic_issues_strategic_issues_id'], 'exist', 'skipOnError' => true, 'targetClass' => StrategicIssues::className(), 'targetAttribute' => ['strategic_issues_strategic_issues_id' => 'strategic_issues_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'strategic_id' => 'Strategic ID',
            'strategic_name' => 'Strategic Name',
            'strategic_issues_strategic_issues_id' => 'Strategic Issues Strategic Issues ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsStrategicOfYears()
    {
        return $this->hasMany(PmsStrategicOfYear::className(), ['strategic_id' => 'strategic_id', 'strategic_issues_id' => 'strategic_issues_strategic_issues_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStrategicIssuesStrategicIssues()
    {
        return $this->hasOne(StrategicIssues::className(), ['strategic_issues_id' => 'strategic_issues_strategic_issues_id']);
    }
}

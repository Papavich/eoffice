<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_strategic_issues".
 *
 * @property integer $strategic_issues_id
 * @property string $strategic_issues_name
 *
 * @property PmsStrategic[] $pmsStrategics
 */
class PmsStrategicIssues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_strategic_issues';
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
            [['strategic_issues_name'], 'required'],
            [['strategic_issues_name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'strategic_issues_id' => 'Strategic Issues ID',
            'strategic_issues_name' => 'Strategic Issues Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsStrategics()
    {
        return $this->hasMany(PmsStrategic::className(), ['pms_strategic_issues_strategic_issues_id' => 'strategic_issues_id']);
    }
}

<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "strategic_issues".
 *
 * @property int $strategic_issues_id
 * @property string $strategic_issues_name
 *
 * @property Strategic[] $strategics
 */
class StrategicIssues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'strategic_issues';
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
            [['strategic_issues_id'], 'required'],
            [['strategic_issues_id'], 'integer'],
            [['strategic_issues_name'], 'string', 'max' => 100],
            [['strategic_issues_id'], 'unique'],
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
    public function getStrategics()
    {
        return $this->hasMany(Strategic::className(), ['strategic_issues_strategic_issues_id' => 'strategic_issues_id']);
    }
}

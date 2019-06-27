<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_strategic_has_project_sub".
 *
 * @property int $strategic_issues_id
 * @property int $strategic_id
 * @property string $pms_project_sub_prosub_code
 *
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsStrategicHasProjectSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_strategic_has_project_sub';
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
            [['strategic_issues_id', 'strategic_id', 'pms_project_sub_prosub_code'], 'required'],
            [['strategic_issues_id', 'strategic_id'], 'integer'],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['strategic_issues_id', 'strategic_id', 'pms_project_sub_prosub_code'], 'unique', 'targetAttribute' => ['strategic_issues_id', 'strategic_id', 'pms_project_sub_prosub_code']],
            [['pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProjectSub::className(), 'targetAttribute' => ['pms_project_sub_prosub_code' => 'prosub_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'strategic_issues_id' => 'Strategic Issues ID',
            'strategic_id' => 'Strategic ID',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubProsubCode()
    {
        return $this->hasOne(PmsProjectSub::className(), ['prosub_code' => 'pms_project_sub_prosub_code']);
    }
}

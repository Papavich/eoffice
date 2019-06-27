<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_indicator".
 *
 * @property int $indicator_id
 * @property string $indicator_detail
 * @property string $indicator_goalValue
 * @property string $pms_project_sub_prosub_code
 *
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsIndicator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_indicator';
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
            [['pms_project_sub_prosub_code'], 'required'],
            [['indicator_detail'], 'string', 'max' => 256],
            [['indicator_goalValue'], 'string', 'max' => 50],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProjectSub::className(), 'targetAttribute' => ['pms_project_sub_prosub_code' => 'prosub_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'indicator_id' => 'Indicator ID',
            'indicator_detail' => 'Indicator Detail',
            'indicator_goalValue' => 'Indicator Goal Value',
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

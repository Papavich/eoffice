<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_cost_plan".
 *
 * @property int $cost_id
 * @property string $cost_detail
 * @property int $cost_price
 * @property string $pms_project_sub_prosub_code
 *
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsCostPlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_cost_plan';
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
            [['cost_price'], 'integer'],
            [['pms_project_sub_prosub_code'], 'required'],
            [['cost_detail'], 'string', 'max' => 256],
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
            'cost_id' => 'Cost ID',
            'cost_detail' => 'Cost Detail',
            'cost_price' => 'Cost Price',
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

<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_result_expect".
 *
 * @property int $result_id
 * @property string $result_detail
 * @property string $pms_project_sub_prosub_code
 *
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsResultExpect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_result_expect';
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
            [['result_detail'], 'string', 'max' => 256],
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
            'result_id' => 'Result ID',
            'result_detail' => 'Result Detail',
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

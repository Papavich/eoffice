<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_governance_has_project_sub".
 *
 * @property int $governance_id
 * @property string $pms_project_sub_prosub_code
 *
 * @property PmsCompactHasMethod[] $pmsCompactHasMethods
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class PmsGovernanceHasProjectSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_governance_has_project_sub';
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
            [['governance_id', 'pms_project_sub_prosub_code'], 'required'],
            [['governance_id'], 'integer'],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['governance_id', 'pms_project_sub_prosub_code'], 'unique', 'targetAttribute' => ['governance_id', 'pms_project_sub_prosub_code']],
            [['pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProjectSub::className(), 'targetAttribute' => ['pms_project_sub_prosub_code' => 'prosub_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'governance_id' => 'หลักธรรมาภิบาล',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasMethods()
    {
        return $this->hasMany(PmsCompactHasMethod::className(), ['pms_governance_has_project_sub_governance_id' => 'governance_id', 'pms_governance_has_project_sub_pms_project_sub_prosub_code' => 'pms_project_sub_prosub_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubProsubCode()
    {
        return $this->hasOne(PmsProjectSub::className(), ['prosub_code' => 'pms_project_sub_prosub_code']);
    }
}

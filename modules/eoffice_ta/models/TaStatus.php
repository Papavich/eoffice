<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_status".
 *
 * @property string $ta_status_id
 * @property string $ta_status_name
 * @property string $ta_status_icon
 *
 * @property TaComment[] $taComments
 * @property TaComparisonGrade[] $taComparisonGrades
 * @property TaInbox[] $taInboxes
 * @property TaInboxFiles[] $taInboxFiles
 * @property TaInboxUser[] $taInboxUsers
 * @property TaNews[] $taNews
 * @property TaNewsComment[] $taNewsComments
 * @property TaPayment[] $taPayments
 * @property TaRegister[] $taRegisters
 * @property TaRegisterSection[] $taRegisterSections
 * @property TaRequest0[] $taRequests
 * @property TaWorkAtone[] $taWorkAtones
 * @property TaWorkPlan[] $taWorkPlans
 */
class TaStatus extends \yii\db\ActiveRecord
{
    const START_REQUEST_TA = 'RQ-TA';
    const START_REGISTER_TA = 'RG-TA';
    const REGISTER_TA_READ = 'RG-TA-READ';
    const CHOOSE_TA = 'RG-CH';
    const FAIL_CHOOSE_TA = 'RG-FCH';
    const WORKING_TA = 'WORK-TA';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_status';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_status_id'], 'required'],
            [['ta_status_id'], 'string', 'max' => 15],
            [['ta_status_name', 'ta_status_icon'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_status_id' => 'Ta Status ID',
            'ta_status_name' => 'Ta Status Name',
            'ta_status_icon' => 'Ta Status Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaComments()
    {
        return $this->hasMany(TaComment::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaComparisonGrades()
    {
        return $this->hasMany(TaComparisonGrade::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaInboxes()
    {
        return $this->hasMany(TaInbox::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaInboxFiles()
    {
        return $this->hasMany(TaInboxFiles::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaInboxUsers()
    {
        return $this->hasMany(TaInboxUser::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaNews()
    {
        return $this->hasMany(TaNews::className(), ['ta_status' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaNewsComments()
    {
        return $this->hasMany(TaNewsComment::className(), ['ta_status' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPayments()
    {
        return $this->hasMany(TaPayment::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRegisters()
    {
        return $this->hasMany(TaRegister::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRegisterSections()
    {
        return $this->hasMany(TaRegisterSection::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRequests()
    {
        return $this->hasMany(TaRequest0::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaWorkAtones()
    {
        return $this->hasMany(TaWorkAtone::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaWorkPlans()
    {
        return $this->hasMany(TaWorkPlan::className(), ['ta_status_id' => 'ta_status_id']);
    }
}

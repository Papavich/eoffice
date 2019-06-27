<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;


/**
 * This is the model class for table "scb_cand_portfolio".
 *
 * @property int $port_no
 * @property string $candidate_id_card
 * @property string $scholarship_id
 * @property int $scholarship_year
 * @property int $port_type_id
 * @property string $port_name
 * @property string $port_level
 * @property string $port_date
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbEnrollScholarship $candidateIdCard
 * @property ScbPortType $portType
 */
class ScbCandPortfolio extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_cand_portfolio';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['port_no', 'candidate_id_card', 'scholarship_id', 'scholarship_year', 'port_type_id'], 'required'],
            [['port_no', 'scholarship_year', 'port_type_id', 'crby', 'udby'], 'integer'],
            [['port_date', 'crtime', 'udtime'], 'safe'],
            [['candidate_id_card'], 'string', 'max' => 13],
            [['scholarship_id'], 'string', 'max' => 5],
            [['port_name'], 'string', 'max' => 50],
            [['port_level'], 'string', 'max' => 10],
            [['port_no', 'candidate_id_card', 'scholarship_id', 'scholarship_year'], 'unique', 'targetAttribute' => ['port_no', 'candidate_id_card', 'scholarship_id', 'scholarship_year']],
            [['candidate_id_card', 'scholarship_id', 'scholarship_year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbEnrollScholarship::className(), 'targetAttribute' => ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']],
            [['port_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbPortType::className(), 'targetAttribute' => ['port_type_id' => 'port_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'port_no' => 'Port No',
            'candidate_id_card' => 'Candidate Id Card',
            'scholarship_id' => 'Scholarship ID',
            'scholarship_year' => 'Scholarship Year',
            'port_type_id' => 'Port Type ID',
            'port_name' => 'Port Name',
            'port_level' => 'Port Level',
            'port_date' => 'Port Date',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCard()
    {
        return $this->hasOne(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortType()
    {
        return $this->hasOne(ScbPortType::className(), ['port_type_id' => 'port_type_id']);
    }
}

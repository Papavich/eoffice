<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_address_candidate".
 *
 * @property string $address_type
 * @property string $scb_candidate_id_card
 * @property string $address
 * @property string $tumbon
 * @property string $amphor
 * @property string $province
 * @property string $country
 * @property string $zipcode
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbCandidate $scbCandidateIdCard
 */
class ScbAddressCandidate extends \yii\db\ActiveRecord
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
        return 'scb_address_candidate';
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
            [['address_type', 'scb_candidate_id_card'], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['address_type', 'tumbon', 'amphor', 'province', 'country'], 'string', 'max' => 15],
            [['scb_candidate_id_card'], 'string', 'max' => 17],
            [['address'], 'string', 'max' => 60],
            [['zipcode'], 'string', 'max' => 5],
            [['address_type', 'scb_candidate_id_card'], 'unique', 'targetAttribute' => ['address_type', 'scb_candidate_id_card']],
            [['scb_candidate_id_card'], 'exist', 'skipOnError' => true, 'targetClass' => ScbCandidate::className(), 'targetAttribute' => ['scb_candidate_id_card' => 'id_card']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_type' => '',
            'scb_candidate_id_card' => '',
            'address' => '',
            'tumbon' => '',
            'amphor' => '',
            'province' => '',
            'country' => '',
            'zipcode' => '',
            'crby' => '',
            'crtime' => '',
            'udby' => '',
            'udtime' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCandidateIdCard()
    {
        return $this->hasOne(ScbCandidate::className(), ['id_card' => 'scb_candidate_id_card']);
    }
}

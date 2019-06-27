<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_parents".
 *
 * @property string $id_card_parent
 * @property string $parent_type
 * @property string $firstname
 * @property string $lastname
 * @property string $status
 * @property int $birth_year
 * @property string $highest_education
 * @property string $occupation
 * @property string $mobile
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property string $parent
 *
 * @property ScbAddressParent $scbAddressParent
 * @property ScbCandidateHasParents[] $scbCandidateHasParents
 * @property ScbCandidate[] $scbCandidateIdCards
 */
class ScbParents extends \yii\db\ActiveRecord
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
        return 'scb_parents';
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
            [['id_card_parent'], 'required'],
            [['birth_year', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['id_card_parent'], 'string', 'max' => 17],
            [['parent_type', 'status', 'highest_education'], 'string', 'max' => 10],
            [['firstname', 'lastname', 'occupation'], 'string', 'max' => 30],
            [['mobile'], 'string', 'max' => 11],
            [['parent'], 'string', 'max' => 45],
            [['id_card_parent'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_card_parent' => '',
            'parent_type' => '',
            'firstname' => '',
            'lastname' => '',
            'status' => '',
            'birth_year' => '',
            'highest_education' => '',
            'occupation' => '',
            'mobile' => '',
            //'crby' => 'Crby',
            //'crtime' => 'Crtime',
            // 'udby' => 'Udby',
            //'udtime' => 'Udtime',
            // 'parent' => 'Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbAddressParent()
    {
        return $this->hasOne(ScbAddressParent::className(), ['scb_parents_id_card_parent' => 'id_card_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCandidateHasParents()
    {
        return $this->hasMany(ScbCandidateHasParents::className(), ['scb_parents_id_card_parent' => 'id_card_parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCandidateIdCards()
    {
        return $this->hasMany(ScbCandidate::className(), ['id_card' => 'scb_candidate_id_card'])->viaTable('scb_candidate_has_parents', ['scb_parents_id_card_parent' => 'id_card_parent']);
    }
}

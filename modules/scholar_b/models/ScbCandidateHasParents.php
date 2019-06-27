<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_candidate_has_parents".
 *
 * @property string $scb_candidate_id_card
 * @property string $scb_parents_id_card_parent
 *
 * @property ScbCandidate $scbCandidateIdCard
 * @property ScbParents $scbParentsIdCardParent
 */
class ScbCandidateHasParents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_candidate_has_parents';
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
            [['scb_candidate_id_card', 'scb_parents_id_card_parent'], 'required'],
            [['scb_candidate_id_card', 'scb_parents_id_card_parent'], 'string', 'max' => 17],
            [['scb_candidate_id_card'], 'exist', 'skipOnError' => true, 'targetClass' => ScbCandidate::className(), 'targetAttribute' => ['scb_candidate_id_card' => 'id_card']],
            [['scb_parents_id_card_parent'], 'exist', 'skipOnError' => true, 'targetClass' => ScbParents::className(), 'targetAttribute' => ['scb_parents_id_card_parent' => 'id_card_parent']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scb_candidate_id_card' => 'Scb Candidate Id Card',
            'scb_parents_id_card_parent' => 'Scb Parents Id Card Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCandidateIdCard()
    {
        return $this->hasOne(ScbCandidate::className(), ['id_card' => 'scb_candidate_id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbParentsIdCardParent()
    {
        return $this->hasOne(ScbParents::className(), ['id_card_parent' => 'scb_parents_id_card_parent']);
    }
}

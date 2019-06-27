<?php

namespace app\modules\scholar_b\models;

use Yii;

/**
 * This is the model class for table "scb_branch".
 *
 * @property integer $branch_id
 * @property string $branch_name
 *
 * @property ScbSelectBranch[] $scbSelectBranches
 * @property ScbEnrollScholarship[] $candidateIdCards
 */
class ScbBranch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_branch';
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
            [['branch_id'], 'required'],
            [['branch_id'], 'integer'],
            [['branch_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'branch_name' => 'Branch Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbSelectBranches()
    {
        return $this->hasMany(ScbSelectBranch::className(), ['scb_branch_id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCandidateIdCards()
    {
        return $this->hasMany(ScbEnrollScholarship::className(), ['candidate_id_card' => 'candidate_id_card', 'scholarship_type_id' => 'scholarship_type_id', 'scholarship_year' => 'scholarship_year'])->viaTable('scb_select_branch', ['scb_branch_id' => 'branch_id']);
    }
}

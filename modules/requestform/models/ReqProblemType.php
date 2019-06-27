<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_problem_type".
 *
 * @property integer $problem_type_id
 * @property string $problem_type_name
 *
 * @property ReqProblem[] $reqProblems
 */
class ReqProblemType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_problem_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['problem_type_id'], 'required'],
            [['problem_type_id'], 'integer'],
            [['problem_type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'problem_type_id' => 'Problem Type ID',
            'problem_type_name' => 'Problem Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqProblems()
    {
        return $this->hasMany(ReqProblem::className(), ['problem_type_problem_type_id' => 'problem_type_id']);
    }
}

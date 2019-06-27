<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_problem".
 *
 * @property integer $problem_id
 * @property string $problem_topic
 * @property string $problem_detail
 * @property string $problem_picture
 * @property integer $problem_status
 * @property string $crtime
 * @property string $udtime
 * @property string $udby
 * @property integer $problem_type_problem_type_id
 * @property integer $user_id
 *
 * @property ReqProblemType $problemTypeProblemType
 * @property User $user
 */
class ReqProblem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_problem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['problem_id', 'problem_type_problem_type_id', 'user_id'], 'required'],
            [['problem_id', 'problem_status', 'problem_type_problem_type_id', 'user_id'], 'integer'],
            [['problem_picture'], 'string'],
            [['crtime', 'udtime'], 'safe'],
            [['problem_topic'], 'string', 'max' => 150],
            [['problem_detail'], 'string', 'max' => 300],
            [['udby'], 'string', 'max' => 45],
            [['problem_type_problem_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReqProblemType::className(), 'targetAttribute' => ['problem_type_problem_type_id' => 'problem_type_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'problem_id' => 'Problem ID',
            'problem_topic' => 'Problem Topic',
            'problem_detail' => 'Problem Detail',
            'problem_picture' => 'Problem Picture',
            'problem_status' => 'Problem Status',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'udby' => 'Udby',
            'problem_type_problem_type_id' => 'Problem Type Problem Type ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProblemTypeProblemType()
    {
        return $this->hasOne(ReqProblemType::className(), ['problem_type_id' => 'problem_type_problem_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

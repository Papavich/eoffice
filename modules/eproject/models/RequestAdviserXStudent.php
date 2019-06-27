<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_request_adviser_x_student".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property integer $adviser_request_id
 * @property integer $student_id
 *
 * @property RequestAdviser $adviserRequest
 * @property User $student
 */
class RequestAdviserXStudent extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    const STATUS_ACTIVE='1';
    const STATUS_NOT_ACTIVE='0';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_request_adviser_x_student';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'adviser_request_id', 'student_id'], 'required'],
            [['crby', 'udby', 'adviser_request_id', 'student_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['adviser_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestAdviser::className(), 'targetAttribute' => ['adviser_request_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'adviser_request_id' => 'Adviser Request ID',
            'student_id' => 'Student ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviserRequest()
    {
        return $this->hasOne(RequestAdviser::className(), ['id' => 'adviser_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }
}

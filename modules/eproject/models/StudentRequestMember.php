<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_student_request_member".
 *
 * @property int $change_member_request_id
 * @property int $student_id
 * @property int $type
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @propertyChangeMemberRequest $changeMemberRequest
 */
class StudentRequestMember extends \yii\db\ActiveRecord
{
    const TYPE_FROM=0;
    const TYPE_TO=1;

    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_student_request_member';
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
            [['change_member_request_id', 'student_id', 'type'], 'required'],
            [['change_member_request_id', 'student_id', 'type', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['change_member_request_id', 'student_id', 'type'], 'unique', 'targetAttribute' => ['change_member_request_id', 'student_id', 'type']],
            [['change_member_request_id'], 'exist', 'skipOnError' => true, 'targetClass' =>ChangeMemberRequest::className(), 'targetAttribute' => ['change_member_request_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'change_member_request_id' => 'Change Member Request ID',
            'student_id' => 'Student ID',
            'type' => 'Type',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChangeMemberRequest()
    {
        return $this->hasOne(ChangeMemberRequest::className(), ['id' => 'change_member_request_id']);
    }
}

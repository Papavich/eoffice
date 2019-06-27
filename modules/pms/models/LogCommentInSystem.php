<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "log_comment_in_system".
 *
 * @property int $id
 * @property string $pms_project_sub_prosub_code
 * @property string $comment
 * @property string $person
 * @property string $event_date
 *
 * @property PmsProjectSub $pmsProjectSubProsubCode
 */
class LogCommentInSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_comment_in_system';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pms_project_sub_prosub_code'], 'required'],
            [['event_date'], 'safe'],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
            [['comment', 'person'], 'string', 'max' => 100],
            [['pms_project_sub_prosub_code'], 'exist', 'skipOnError' => true, 'targetClass' => PmsProjectSub::className(), 'targetAttribute' => ['pms_project_sub_prosub_code' => 'prosub_code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
            'comment' => 'Comment',
            'person' => 'Person',
            'event_date' => 'Event Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsProjectSubProsubCode()
    {
        return $this->hasOne(PmsProjectSub::className(), ['prosub_code' => 'pms_project_sub_prosub_code']);
    }
}

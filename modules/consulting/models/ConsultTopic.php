<?php

namespace app\modules\consulting\models;

use Yii;

/**
 * This is the model class for table "consult_topic".
 *
 * @property int $topic_id
 * @property string $topic_name
 *
 * @property ConsultTopicOwner[] $consultTopicOwners
 */
class ConsultTopic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_topic';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_consult');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_name'], 'required'],
            [['topic_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'topic_id' => 'Topic ID',
            'topic_name' => 'Topic Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultTopicOwners()
    {
        return $this->hasMany(ConsultTopicOwner::className(), ['topic_id' => 'topic_id']);
    }
}

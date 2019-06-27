<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_topic".
 *
 * @property int $consult_topic_id
 * @property string $consult_topic_name
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
            [['consult_topic_name'], 'required'],
            [['consult_topic_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_topic_id' => 'Consult Topic ID',
            'consult_topic_name' => 'หัวข้อปัญหา',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultTopicOwners()
    {
        return $this->hasMany(ConsultTopicOwner::className(), ['consult_topic_id' => 'consult_topic_id']);
    }
}

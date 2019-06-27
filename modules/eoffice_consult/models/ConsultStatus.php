<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_status".
 *
 * @property int $status_id
 * @property string $status_name
 *
 * @property ConsultPost[] $consultPosts
 */
class ConsultStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_status';
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
            [['status_id', 'status_name'], 'required'],
            [['status_id'], 'integer'],
            [['status_name'], 'string', 'max' => 45],
            [['status_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_name' => 'Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPosts()
    {
        return $this->hasMany(ConsultPost::className(), ['status_id' => 'status_id']);
    }
}

<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_status".
 *
 * @property int $consult_status_id
 * @property string $consult_status_name
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
            [['consult_status_id', 'consult_status_name'], 'required'],
            [['consult_status_id'], 'integer'],
            [['consult_status_name'], 'string', 'max' => 45],
            [['consult_status_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_status_id' => 'Consult Status ID',
            'consult_status_name' => 'Consult Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPosts()
    {
        return $this->hasMany(ConsultPost::className(), ['consult_status_id' => 'consult_status_id']);
    }
}

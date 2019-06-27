<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_point".
 *
 * @property int $consult_point_id
 * @property string $consult_point_name
 *
 * @property ConsultQuestion[] $consultQuestions
 */
class ConsultPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_point';
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
            [['consult_point_id', 'consult_point_name'], 'required'],
            [['consult_point_id'], 'integer'],
            [['consult_point_name'], 'string', 'max' => 45],
            [['consult_point_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_point_id' => 'Consult Point ID',
            'consult_point_name' => 'Consult Point Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultQuestions()
    {
        return $this->hasMany(ConsultQuestion::className(), ['consult_point_id' => 'consult_point_id']);
    }
}

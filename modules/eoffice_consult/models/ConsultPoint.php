<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_point".
 *
 * @property int $point_id
 * @property string $point_name
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
            [['point_id', 'point_name'], 'required'],
            [['point_id'], 'integer'],
            [['point_name'], 'string', 'max' => 45],
            [['point_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'point_id' => 'Point ID',
            'point_name' => 'Point Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultQuestions()
    {
        return $this->hasMany(ConsultQuestion::className(), ['point_id' => 'point_id']);
    }
}

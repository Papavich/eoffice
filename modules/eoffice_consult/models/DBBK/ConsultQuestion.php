<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_question".
 *
 * @property int $consult_question_id
 * @property string $consult_question_name
 * @property int $consult_satis_id
 * @property int $consult_point_id
 *
 * @property ConsultPoint $consultPoint
 * @property ConsultSatis $consultSatis
 */
class ConsultQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consult_question';
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
            [['consult_question_id', 'consult_question_name', 'consult_satis_id', 'consult_point_id'], 'required'],
            [['consult_question_id', 'consult_satis_id', 'consult_point_id'], 'integer'],
            [['consult_question_name'], 'string', 'max' => 45],
            [['consult_question_id'], 'unique'],
            [['consult_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultPoint::className(), 'targetAttribute' => ['consult_point_id' => 'consult_point_id']],
            [['consult_satis_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultSatis::className(), 'targetAttribute' => ['consult_satis_id' => 'consult_satis_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'consult_question_id' => 'Consult Question ID',
            'consult_question_name' => 'Consult Question Name',
            'consult_satis_id' => 'Consult Satis ID',
            'consult_point_id' => 'Consult Point ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultPoint()
    {
        return $this->hasOne(ConsultPoint::className(), ['consult_point_id' => 'consult_point_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultSatis()
    {
        return $this->hasOne(ConsultSatis::className(), ['consult_satis_id' => 'consult_satis_id']);
    }
}

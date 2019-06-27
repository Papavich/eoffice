<?php

namespace app\modules\eoffice_consult\models;

use Yii;

/**
 * This is the model class for table "consult_question".
 *
 * @property int $question_id
 * @property string $question_name
 * @property int $satis_id
 * @property int $point_id
 *
 * @property ConsultPoint $point
 * @property ConsultSatis $satis
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
            [['question_id', 'question_name', 'satis_id', 'point_id'], 'required'],
            [['question_id', 'satis_id', 'point_id'], 'integer'],
            [['question_name'], 'string', 'max' => 45],
            [['question_id'], 'unique'],
            [['point_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultPoint::className(), 'targetAttribute' => ['point_id' => 'point_id']],
            [['satis_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConsultSatis::className(), 'targetAttribute' => ['satis_id' => 'satis_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'question_id' => 'Question ID',
            'question_name' => 'Question Name',
            'satis_id' => 'Satis ID',
            'point_id' => 'Point ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoint()
    {
        return $this->hasOne(ConsultPoint::className(), ['point_id' => 'point_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatis()
    {
        return $this->hasOne(ConsultSatis::className(), ['satis_id' => 'satis_id']);
    }



}

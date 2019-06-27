<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "ta_type_work".
 *
 * @property string $ta_type_work_id
 * @property string $ta_type_work_name
 * @property string $ta_type_work_fullname
 *
 * @property TaRequest0[] $taRequests
 * @property TaWorkLoad[] $taWorkLoads
 * @property TaRegister[] $people
 */
class TaTypeWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_type_work';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ta_type_work_id'], 'required'],
            [['ta_type_work_id'], 'string', 'max' => 10],
            [['ta_type_work_name'], 'string', 'max' => 20],
            [['ta_type_work_fullname'], 'string', 'max' => 100],
            [['ta_type_work_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_type_work_id' => 'Ta Type Work ID',
            'ta_type_work_name' => 'Ta Type Work Name',
            'ta_type_work_fullname' => 'Ta Type Work Fullname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRequests()
    {
        return $this->hasMany(TaRequest0::className(), ['ta_type_work_id' => 'ta_type_work_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaWorkLoads()
    {
        return $this->hasMany(TaWorkLoad::className(), ['ta_type_work_id' => 'ta_type_work_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(TaRegister::className(), ['person_id' => 'person_id', 'subject_id' => 'subject_id', 'term' => 'term_id', 'year' => 'year_id'])->viaTable('ta_work_load', ['ta_type_work_id' => 'ta_type_work_id']);
    }
}

<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "responsibility".
 *
 * @property int $respon_id
 * @property string $responsibility
 * @property int $person_id
 *
 * @property Person $person
 */
class Responsibility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'responsibility';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['responsibility', 'person_id'], 'required'],
            [['person_id'], 'integer'],
            [['responsibility'], 'string', 'max' => 100],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'respon_id' => 'Respon ID',
            'responsibility' => 'Responsibility',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }
}

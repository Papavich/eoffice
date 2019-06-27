<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $type_id
 * @property string $type_name
 *
 * @property Person[] $people
 * @property TaAssessment[] $taAssessments
 * @property TaInbox[] $taInboxes
 * @property TaNews[] $taNews
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
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
            [['type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'type_name' => 'Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssessments()
    {
        return $this->hasMany(TaAssessment::className(), ['type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaInboxes()
    {
        return $this->hasMany(TaInbox::className(), ['type_user' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaNews()
    {
        return $this->hasMany(TaNews::className(), ['type_id' => 'type_id']);
    }
}

<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string $name_title
 * @property string $last_name
 * @property string $first_name
 * @property string $position
 * @property int $type_person_id
 *
 * @property TypePerson $typePerson
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_person_id'], 'required'],
            [['type_person_id'], 'integer'],
            [['name_title', 'last_name', 'first_name', 'position'], 'string', 'max' => 100],
            [['type_person_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypePerson::className(), 'targetAttribute' => ['type_person_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_title' => 'Name Title',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'position' => 'Position',
            'type_person_id' => 'Type Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypePerson()
    {
        return $this->hasOne(TypePerson::className(), ['id' => 'type_person_id']);
    }
}

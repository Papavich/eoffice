<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property string $department_id
 * @property string $department_name
 *
 * @property Person[] $people
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_id'], 'required'],
            [['department_id'], 'string', 'max' => 2],
            [['department_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['department_id' => 'department_id']);
    }
}

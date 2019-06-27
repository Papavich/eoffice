<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "importsql".
 *
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property integer $age
 */
class Importsql extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'importsql';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age'], 'integer'],
            [['name', 'last_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'age' => 'Age',
        ];
    }
}

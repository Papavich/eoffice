<?php

namespace app\modules\eproject\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }
}

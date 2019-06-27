<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $sortname
 * @property string $name
 * @property int $phonecode
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phonecode'], 'integer'],
            [['sortname'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sortname' => 'Sortname',
            'name' => 'Name',
            'phonecode' => 'Phonecode',
        ];
    }
}

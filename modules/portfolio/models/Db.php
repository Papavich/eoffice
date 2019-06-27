<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "db".
 *
 * @property int $db_id
 * @property string $db_name
 */
class Db extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'db';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['db_id'], 'required'],
            [['db_id'], 'integer'],
            [['db_name'], 'string', 'max' => 12],
            [['db_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'db_id' => 'Db ID',
            'db_name' => 'Db Name',
        ];
    }
}

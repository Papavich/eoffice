<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subj_name".
 *
 * @property integer $ID
 * @property string $name
 */
class SubjName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subj_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Name',
        ];
    }
}

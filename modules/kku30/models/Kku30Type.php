<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_type".
 *
 * @property int $type_id
 * @property string $type_name
 * @property int $type_credit
 * @property int $type_check
 *
 * @property Kku30SubjectCoruse[] $kku30SubjectCoruses
 */
class Kku30Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_type';
    }

    /**
     * @inheritdoc
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    public function rules()
    {
        return [
            [['type_id', 'type_name'], 'required'],
            [['type_id', 'type_credit', 'type_check'], 'integer'],
            [['type_name'], 'string', 'max' => 100],
            [['type_id'], 'unique'],
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
            'type_credit' => 'Type Credit',
            'type_check' => 'Type Check',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectCoruses()
    {
        return $this->hasMany(Kku30SubjectCoruse::className(), ['type_id' => 'type_id']);
    }
}

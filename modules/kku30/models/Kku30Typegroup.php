<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_typegroup".
 *
 * @property int $typegroup_id
 * @property string $typegroup_name
 * @property int $typegroup_credit
 * @property string $typegroup_check
 *
 * @property Kku30SubjectCoruse[] $kku30SubjectCoruses
 */
class Kku30Typegroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_typegroup';
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
            [['typegroup_id', 'typegroup_name'], 'required'],
            [['typegroup_id', 'typegroup_credit'], 'integer'],
            [['typegroup_name'], 'string', 'max' => 100],
            [['typegroup_check'], 'string', 'max' => 45],
            [['typegroup_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'typegroup_id' => 'Typegroup ID',
            'typegroup_name' => 'Typegroup Name',
            'typegroup_credit' => 'Typegroup Credit',
            'typegroup_check' => 'Typegroup Check',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectCoruses()
    {
        return $this->hasMany(Kku30SubjectCoruse::className(), ['typegroup_id' => 'typegroup_id']);
    }
}

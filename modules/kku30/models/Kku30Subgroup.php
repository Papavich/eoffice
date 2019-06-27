<?php

namespace app\modules\kku30\models;

use Yii;

/**
 * This is the model class for table "kku30_subgroup".
 *
 * @property int $subgroup_id
 * @property string $subgroup_name
 *
 * @property Kku30SubjectCoruse[] $kku30SubjectCoruses
 */
class Kku30Subgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kku30_subgroup';
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
            [['subgroup_id', 'subgroup_name'], 'required'],
            [['subgroup_id'], 'integer'],
            [['subgroup_name'], 'string', 'max' => 50],
            [['subgroup_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subgroup_id' => 'Subgroup ID',
            'subgroup_name' => 'Subgroup Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKku30SubjectCoruses()
    {
        return $this->hasMany(Kku30SubjectCoruse::className(), ['subgroup_id' => 'subgroup_id']);
    }
}

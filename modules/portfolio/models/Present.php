<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "present".
 *
 * @property int $present_id
 * @property string $present_name
 *
 * @property Publication[] $publications
 */
class Present extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'present';
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
            [['present_id'], 'required'],
            [['present_id'], 'integer'],
            [['present_name'], 'string', 'max' => 100],
            [['present_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'present_id' => 'Present ID',
            'present_name' => 'Present Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['present_present_id' => 'present_id']);
    }
}

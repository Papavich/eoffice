<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "datacal".
 *
 * @property int $datacal_id
 * @property string $datacal
 *
 * @property Publication[] $publications
 */
class Datacal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datacal';
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
            [['datacal_id'], 'required'],
            [['datacal_id'], 'integer'],
            [['datacal'], 'string', 'max' => 100],
            [['datacal_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'datacal_id' => 'Datacal ID',
            'datacal' => 'Datacal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['datacal_datacal_id' => 'datacal_id']);
    }
}

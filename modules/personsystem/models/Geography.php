<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "geography".
 *
 * @property int $GEO_ID
 * @property string $GEO_NAME
 */
class Geography extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geography';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GEO_NAME'], 'required'],
            [['GEO_NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GEO_ID' => 'Geo  ID',
            'GEO_NAME' => 'Geo  Name',
        ];
    }
}
